#!/bin/bash

php-fpm #2>1 | sed -u 's/^\(?:PHP Deprecated: \)?\(.*\)$/CHANGED: \1/' 1>2