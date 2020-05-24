# PHP EnumType: an Alternative to SplEnum

This is a replacement class for <abbr title="PHP Hypertext Preprocessor">PHP</abbr> installations that don't have access to [SplEnum](https://www.php.net/manual/en/class.splenum.php). This is mostly a complete drop-in replacement, with the exception of the return type when used within numerical contexts.

## Usage

Using this class is just the same as if you were using SplEnum, you just extend from the new class instead:

```php
<?php
class Month extends EnumType
{
    const __default = self::January;

    const January = 1;
    const February = 2;
    const March = 3;
    const April = 4;
    const May = 5;
    const June = 6;
    const July = 7;
    const August = 8;
    const September = 9;
    const October = 10;
    const November = 11;
    const December = 12;
}

$month = new Month(Month::June);

echo $month . PHP_EOL;
```

Like the original, the constructor will throw a `UnexpectedValueException` if you try to initialise a class instance with a constant value that doesn't exist in your enum, or if you try to initialise without a value and your enum doesn't have a default value. The following examples would both throw the `UnexpectedValueException` exception:

```php
<?php
class Weekend extends EnumType
{
	const Saturday = 1;
	const Sunday = 2;
}

$day1 = new Weekend(3);
$day2 = new Weekend();
```

## Running the Tests

To run the tests, you can either call the `tests.php` file directly as an argument to <abbr>PHP</abbr> or make the file executable and run it directly (as it uses a [shebang](https://en.wikipedia.org/wiki/Shebang_(Unix) line):

```shell
php ./tests.php

# the chmod line is only needed once on this file
# Bash on Windows won't need this step
chmod +x tests.php
./tests.php
```