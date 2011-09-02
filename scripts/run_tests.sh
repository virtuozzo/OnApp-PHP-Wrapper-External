#!/bin/sh

usage() {
cat << EOF
usage: $0 options

This script runs the OnApp's PHPUnit tests

OPTIONS:
   -h      Show this message
   -t      Data type, can be 'json' or 'xml'
           json is default value
   -d      Show debug info
EOF
}

## VARIABLES:
DATE=`date +"%s"`

## DIRS:

if [ -r "`dirname $0 | sed 's/\/.*$//'`" ]; then
    SCRIPT_DIR=`pwd`/`dirname $0`
else
    SCRIPT_DIR=`dirname $0`
fi
TESTS_DIR="$SCRIPT_DIR/../tests"
BASE_DIR="/tmp/onapp/PHP/wrapper/tests"

#########################################################################################
##
##  Functions
##
#########################################################################################

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

    echo "`date +%b\ %e\ %R\:%S` ERROR ${error}"

    exit 1
}

init_base_dir() {
    message "Initialize test directory"

    if [ ! -z "$FORCE" ]; then
        rm -rf $BASE_DIR
    fi

    if [ -d $BASE_DIR ]; then
        error "mkdir: cannot create directory $BASE_DIR': Directory exists"
    else
        message "Create directory $BASE_DIR"

        mkdir -p $BASE_DIR
    fi
}

copy_tests() {
    message "Copy all test cases"

    if [ -d $BASE_DIR ]; then
        cp -r $TESTS_DIR/* $BASE_DIR
    else
        error "cp: cannot create directory $BASE_DIR': Directory not found"
    fi
}

unpack_test_framework() {
    message "Unpack PHPUnit lib into test directory"

    local php_unit=`ls -la $SCRIPT_DIR/../src | grep PHPUnit | sed 's/^.* //'`

    local php_unit_name=`echo $php_unit | sed 's/\.[^.]*$//'`

    cd $BASE_DIR

    tar -xf $SCRIPT_DIR/../src/$php_unit $php_unit_name/PHPUnit/

    cd - > /dev/null

    mv $BASE_DIR/$php_unit_name/PHPUnit/ $BASE_DIR

    rm -rf $BASE_DIR/$php_unit_name
}

copy_ONAPP_wrapper() {
    message "Copy PHP ONAPP API Wrapper into $BASE_DIR/libs"

    if [ -d "$SCRIPT_DIR/../wrapper" ]; then
        cp -r $SCRIPT_DIR/../wrapper $BASE_DIR
    else
        error "Directory $SCRIPT_DIR/../wrapper not found"
    fi
}

run_tests() {
    message "Run tests"

    if [ -f "$BASE_DIR/AllTests.php" ]; then
		#echo "$BASE_DIR/AllTests.php ${DEBUG} ${TYPE}"
		#exit 0
        php $BASE_DIR/AllTests.php ${DEBUG}  ${TYPE}
    else
        error "File $BASE_DIR/AllTests.php not found"
    fi
}

#########################################################################################
##
##  Main
##
#########################################################################################

#
# Arguments retrieval
#
FORCE=true
TYPE='json'
DEBUG='false'
while getopts “hdt:” OPTION
do
     case $OPTION in
         h)
             usage
             exit 1
             ;;
         t)
             TYPE=$OPTARG
             ;;
         d)
             DEBUG="true"
             ;;
         ?)
             usage
             exit
             ;;
     esac
done

: '
if [[ -z $TEST ]] || [[ -z $SERVER ]] || [[ -z $PASSWD ]]
then
     usage
     exit 1
fi
'

message  "PHPUnit test for ONAPP API Wrapper started."

init_base_dir

copy_tests

unpack_test_framework

copy_ONAPP_wrapper

run_tests
