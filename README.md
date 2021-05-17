# Introduction

Hello, this is my attempt at the GildedRose-Refactoring-Kata, I have reformatted the code to be more readable,
easier to modify and add new features to. I was not sure if I was allowed to change the GildedRose class from final to normal and then extend it with new item type classes, so
I have used an interface that is implemented by all the different
types of items. Now the updateQuality method just checks the item name and then calls the updateItemQuality
method specifically from that item type class. I added 14 tests, all of them still pass, and the code complies to [Gilded Rose Requirements](GildedRoseRequirements.txt)

## Installation

The kata uses:

- [PHP 7.3 or 7.4 or 8.0+](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org)

Recommended:

- [Git](https://git-scm.com/downloads)

Clone the repository

```sh
git clone https://github.com/lukosss/gildedRoseTest.git
```

Install all the dependencies using composer

```shell script
cd ./gildedRoseTest
composer install
```

## Dependencies

The project uses composer to install:

- [PHPUnit](https://phpunit.de/)
- [ApprovalTests.PHP](https://github.com/approvals/ApprovalTests.php)
- [PHPStan](https://github.com/phpstan/phpstan)
- [Easy Coding Standard (ECS)](https://github.com/symplify/easy-coding-standard)
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/wiki)

## Folders

- `src` - contains the two classes:
    - `Item.php` - this class was not changed as specified in the requirements
    - `GildedRose.php` - this class has been refactored, and added a new feature
- `tests` - contains the tests
    - `GildedRoseTest.php` - added 14 tests in here
- `Fixture`
    - `texttest_fixture.php` this test is set to simulate the tavern's stock for 30 days, but You can change test parameters inside this file.

## Testing

PHPUnit is configured for testing, a composer script has been provided. To run the unit tests, from the root of the PHP
project run:

```shell script
composer test
```

To test a 30-day simulation of the tavern you can run script that I added (it runs texttest_fixture.php file):

```shell script
composer simulate
```