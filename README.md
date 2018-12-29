# php-test
PHP tests and playground

## Introduction

This repository contains test codes I'v written for learning and researching purposes. I've organized the project using a semi-micro-framework I'v written long time ago.

## Framework

Don't expect anything from this framework, it is super small and primitive and cannot be compared to frameworks like Laravel (or even Slim). Important folders and their purpose are listed down below:

* **controllers**: Contains the controllers
* **layout**: It's a possible target for refactoring (ignore it for now)
* **lib**: Contains the framework code and project wide libraries
* **models**: Contains the models
* **public**: Contains the index.php and static assets (*.js, *.css etc)
* **vendor**: Composer packages are located here
* **views**: Views are placed here

## CLI

Apart from web-based tests there are also PHP-CLI sources. These files are placed in the cli directory.

## TODO

Following are possible changes/imporvements for the future:

* Merge /layout/ into /views/
* Useful sources should be migrated to phplib module system to be able to reuse it in other projects