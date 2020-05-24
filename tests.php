#!/usr/bin/env php
<?php
require_once("./php-enum.php");

// tests
// ensure that zend.assertions = 1 in php.ini
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);
assert_options(ASSERT_CALLBACK, "assert_handler");

function assert_handler($file, $line, $code, $desc = null)
{
	echo "Assertion failed at $file:$line: $code";
	if ($desc) 
	{
		echo ": $desc";
	}
	echo "\n";
}

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

class Weekend extends EnumType
{
	const Saturday = 1;
	const Sunday = 2;
}

$month = new Month(Month::June);



assert("$month" === "6");
assert($month->__toInt() === 6);
assert($month->getConstList(true) === [
	"__default" => 1,
	"January" => 1,
	"February" => 2,
	"March" => 3,
	"April" => 4,
	"May" => 5,
	"June" => 6,
	"July" => 7,
	"August" => 8,
	"September" => 9,
	"October" => 10,
	"November" => 11,
	"December" => 12,
]);
assert($month->getConstList() === [
	"January" => 1,
	"February" => 2,
	"March" => 3,
	"April" => 4,
	"May" => 5,
	"June" => 6,
	"July" => 7,
	"August" => 8,
	"September" => 9,
	"October" => 10,
	"November" => 11,
	"December" => 12,
]);
assert($month->getConstList(false) === [
	"January" => 1,
	"February" => 2,
	"March" => 3,
	"April" => 4,
	"May" => 5,
	"June" => 6,
	"July" => 7,
	"August" => 8,
	"September" => 9,
	"October" => 10,
	"November" => 11,
	"December" => 12,
]);

try {
	$month = new Month(13);
	assert(false, "Exception thrown for initialisation outside of constants range");
	
} catch (UnexpectedValueException $e) {
	assert(true);
}

try {
	$day = new Weekend();
	assert(false, "Exception thrown for empty initialisation value without default enum constant");
} catch (UnexpectedValueException $e) {
	assert(true);
}
