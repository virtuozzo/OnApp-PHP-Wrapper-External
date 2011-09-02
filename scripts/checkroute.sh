#!/usr/bin/bash

#!/usr/bin/sh

## VARIABLES:
DATE=`date +"%s"`

## DIRS:
SCRIPT_DIR=`pwd`/`dirname $0`
TMP_DIR='/tmp';

#########################################################################################
##
##  Functions
##
#########################################################################################

show_help() {
    cat <<EOF
  TODO: help message
  -t    --target                  path where to save the generated files
EOF

}

#
# message() and error() functions are used throughout a script for debug output
#
# Usage:
# message "<message text>"
# error "<error message text>"
#

message() {
    local message="$1"

    echo "`date +%b\ %e\ %R\:%S` INFO ${message}"
}

error() {
    local error="$1"

    echo "`date +%b\ %e\ %R\:%S` INFO ${message}"

    exit 1
}

get_routes() {
    ssh root@$ONAPPHOSTNAME 'cd /onapp/interface; rake routes' | sed "s/  */ /g" | sed "s/^ //" > $ROUTEFILE

    message "OnApp route information saved in $ROUTEFILE"
}

get_wrapper_routes() {
    for file in `find $SCRIPT_DIR/../ONAPP -type f`; do
        while read doc_line; do
            route=`echo "$doc_line" | grep "* ROUTE :"`

            if [ "$route" != "" ]; then
                is_route="true";
            elif [ "$is_route" == "true" ] && [ "$name" == "" ]; then
                name=`echo "$doc_line" | grep "@name"`
            elif [ "$name" != "" ] && [ "$method" == "" ] ; then
                method=`echo "$doc_line" | grep "@method"`
            elif [ "$method" != "" ] && [ "$alias" == "" ]; then
                alias=`echo "$doc_line" | grep "@alias"`
            elif [ "$alias" != "" ] && [ "$format" == "" ]; then
                format=`echo "$doc_line" | grep "@format"`

                # hook for wrong format values
                action=`echo $format | sed 's#^.*action=>"##'     | sed 's#".*$##'`
                controller=`echo $format | sed 's#^.*controller=>"##' | sed 's#".*$##'`
                format=`echo "{:action=>\"$action\", :controller=>\"$controller\"}"`

                echo "$name $method $alias $format" | sed 's/\* *@name//g' | sed 's/\* *@method//g'| sed 's/\* *@alias//g' | sed 's/\* *@format//g' | sed 's/  */ /g' | sed 's/^ //' >> $WRAPPER_ROUTEFILE
            else
                unset is_route
                unset name
                unset method
                unset alias
                unset format
            fi
        done < "$file"
    done;

    message "OnApp PHP wrapper route information saved in $WRAPPER_ROUTEFILE"
}

merge_routes() {
    diff $WRAPPER_ROUTEFILE.sort $ROUTEFILE.sort
}

clean_all() {
    rm $WRAPPER_ROUTEFILE
    rm $WRAPPER_ROUTEFILE.sort
    rm $ROUTEFILE
    rm $ROUTEFILE.sort
}

#########################################################################################
##
##  Main
##
#########################################################################################

#
# Arguments retrieval
#
while [ $# -gt 0 ]
do
    case "$1" in
        --help)
         show_help
         exit 0
        ;;
        
        -h|--host)
         shift
         ONAPPHOSTNAME="$1"
         shift
        ;;
        
        --force)
         shift
         FORCE=true
        ;;
        
        -*)
         echo "Unknown option: $1"
         exit 1
        ;;
        
        *)
         show_help
         exit;
        ;;
    esac
done

message "START"

message  "Checker OnApp routes and ONAPP PHP Wrapper routes initialized."

if [ ! $ONAPPHOSTNAME ]; then
    echo "OnApp hostname not defined"
    exit 1
fi

ROUTEFILE="$TMP_DIR/checkroute_$DATE.tmp"

message  "OnApp routes file $ROUTEFILE"

if [ -f $ROUTEFILE ]; then
    echo "File $ROUTEFILE exist";
    exit 1;
fi

WRAPPER_ROUTEFILE="$TMP_DIR/checkroute_$DATE.tmp.orig"

if [ -f $WRAPPER_ROUTEFILE ]; then
    echo "File $WRAPPER_ROUTEFILE= exist";
    exit 1;
fi

message "OnApp PHP wrapper routes file $WRAPPER_ROUTEFILE"

get_routes
get_wrapper_routes

cat $ROUTEFILE         | sort > $ROUTEFILE.sort
cat $WRAPPER_ROUTEFILE | sort > $WRAPPER_ROUTEFILE.sort

merge_routes

clean_all

message "END"
