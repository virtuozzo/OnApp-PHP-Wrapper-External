#!/usr/bin/bash

#!/usr/bin/sh

## VARIABLES:
USE_QUIET=true
USE_NO_LOGGING=false
DATE=`date +"%s"`

## DIRS:
SCRIPT_DIR=`pwd`/`dirname $0`
TESTS_DIR="$SCRIPT_DIR/../tests"
BASE_DIR="/tmp/onapp/PHP/wrapper"

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

unpack_php_documentator() {

    message "Initialize documentator directory"

    if [ $FORCE ]; then
        rm -rf $BASE_DIR
    fi

    local php_doc=`ls -la $SCRIPT_DIR/../src | grep PhpDocumentor | sed 's/^.* //'`

    export php_doc_name=`echo $php_doc | sed 's/\.[^.]*$//'`

    if ! [ -d $BASE_DIR/$php_doc_name ]; then
        message "Create directory $BASE_DIR"

        mkdir -p $BASE_DIR

        message "Unpack PHPDocumentator"


        cd $BASE_DIR
        tar -xf $SCRIPT_DIR/../src/$php_doc $php_doc_name/
        cd -

        cp -r $SCRIPT_DIR/../doc/templates/*  $BASE_DIR/$php_doc_name/phpDocumentor/Converters/HTML/frames/templates
    fi
}

generate() {
    message "Generate documentation"

    if ! [ -d "$SCRIPT_DIR/../ONAPP" ]; then
        error "Directory $SCRIPT_DIR/../ONAPP not found"
    fi

    if [ ! -z $TARGET ] &&  [ -d $TARGET ]; then
        php $BASE_DIR/$php_doc_name/phpdoc -d $SCRIPT_DIR/../ONAPP -o  HTML:frames:onappcustom -t $TARGET
    else
        error "target directory $TARGET not found"
    fi

    message "Documentation was saved in $TARGET"
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
        -h|--help)
         show_help
         exit 0
        ;;

        -t|--target)
         shift
         TARGET="$1"
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

if [ ! "$TARGET"  ]; then
    TARGET="$SCRIPT_DIR/../doc/html/"
fi

if [ ! -d $TARGET ]; then
    echo "Target directory $TARGET  not found"
    exit 1
fi

message  "PHPDocumentator for ONAPP API Wrapper initialized."

unpack_php_documentator

generate 
