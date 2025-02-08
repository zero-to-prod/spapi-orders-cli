#!/usr/bin/env bash
set -e

PHP_VERSIONS=("8.2")

for PHP_VERSION in "${PHP_VERSIONS[@]}"; do

  sh dock "composer${PHP_VERSION}" composer update

  if ! sh dock "php${PHP_VERSION}" ./vendor/bin/phpunit
  then
    exit 1
  fi
done