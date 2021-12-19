@ECHO OFF
SETLOCAL

SET BASEDIR=%~dp0..

cd %BASEDIR%

echo:
echo Install Composer dependencies:
call composer install

echo:
echo Install NPM dependencies:
call npm install
call npm install -g gulp

echo:
echo Build assets:
call gulp build

echo:
echo Build database:
call vendor\bin\phinx migrate

rem TODO: COPY configuration.php
