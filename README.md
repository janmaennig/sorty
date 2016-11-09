# Sorty

[![Latest Stable Version](https://poser.pugx.org/jan-maennig/sorty/v/stable)](https://packagist.org/packages/jan-maennig/sorty)
[![Total Downloads](https://poser.pugx.org/jan-maennig/sorty/downloads)](https://packagist.org/packages/jan-maennig/sorty)
[![License](https://poser.pugx.org/jan-maennig/sorty/license)](https://packagist.org/packages/jan-maennig/sorty)
[![Test Coverage](https://codeclimate.com/github/janmaennig/sorty/badges/coverage.svg)](https://codeclimate.com/github/janmaennig/sorty/coverage)

Sorty provided a library to sort arrays by multiple properties and directions

## Installation
```
composer require jan-maennig/sorty
```
## How to use
[examples/example_array.php](examples/example_array.php)

## Checks

```
./vendor/bin/phpcs --standard=PSR2 ./src -v
./vendor/bin/phpcpd ./src
./vendor/bin/phpunit ./tests/ --coverage-clover build/logs/clover.xml
./vendor/bin/phpmd ./src text ./phpmd.xml
./vendor/bin/security-checker security:check ./composer.lock
```
