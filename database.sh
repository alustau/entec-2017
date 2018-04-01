#!/bin/bash

php artisan migrate

exec "$@"