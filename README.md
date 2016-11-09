# Sorty

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
