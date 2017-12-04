# Sorty

[![Latest Stable Version](https://poser.pugx.org/jan-maennig/sorty/v/stable)](https://packagist.org/packages/jan-maennig/sorty)
[![Build Status](https://travis-ci.org/janmaennig/sorty.svg?branch=master)](https://travis-ci.org/janmaennig/sorty)
[![Total Downloads](https://poser.pugx.org/jan-maennig/sorty/downloads)](https://packagist.org/packages/jan-maennig/sorty)
[![License](https://poser.pugx.org/jan-maennig/sorty/license)](https://packagist.org/packages/jan-maennig/sorty)
[![Test Coverage](https://codeclimate.com/github/janmaennig/sorty/badges/coverage.svg)](https://codeclimate.com/github/janmaennig/sorty/coverage)

Sorty provided a library to sort arrays and object storages by multiple properties and directions. Object storages must be implement "\Iterator" and "\ArrayAccess" interfaces.

## Installation
```
composer require jan-maennig/sorty
```
## How to use

### Sort array collection

[examples/example_array.php](examples/example_array.php)

### Sort a storage of objects

[examples/example_object_storage.php](examples/example_object_storage.php)

## Checks

```
./vendor/bin/phpcs --standard=PSR2 ./src -v
./vendor/bin/phpcpd ./src
./vendor/bin/phpunit ./tests/ --coverage-clover build/logs/clover.xml
./vendor/bin/phpmd ./src text ./phpmd.xml
./vendor/bin/security-checker security:check ./composer.lock
```

## Changelog

2017-12-04 Jan Maennig <janmaennig@gmail.com>

	* Add functionality to sort object storages

2016-11-09 Jan Maennig <janmaennig@gmail.com>

	* Bugfixes
	* Add code checks 

2016-11-01 Jan Maennig <janmaennig@gmail.com>

	* Initial add array value sorter
