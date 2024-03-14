#!/bin/sh

issue=$1

composer install && vendor/bin/phpunit tests/Issues/${issue}Test.php

