#!/bin/sh

issue=$1

composer install || exit $?

vendor/bin/phpunit tests/Issues/GH${issue}Test.php

if [ $? -gt 0 ]
then
    echo "It seems the issue is still relevant: https://github.com/symfony/symfony/issues/${issue}"
    exit 1
else
    echo "The issue seems to be solved. Tested with the latest symfony version. https://github.com/symfony/symfony/issues/${issue}"
    exit 0
fi

