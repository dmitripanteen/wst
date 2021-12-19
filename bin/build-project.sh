#!/usr/bin/env bash


BASEDIR="$(dirname $0)/.."

cd ${BASEDIR}

echo ""
echo "Install Composer dependencies:"
composer install

echo ""
echo "Install NPM dependencies:"
npm install
npm install -g gulp

echo ""
echo "Build assets:"
gulp build

echo ""
echo "Build database:"
vendor/bin/phinx migrate
