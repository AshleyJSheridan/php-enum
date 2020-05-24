#!/usr/bin/env php
<?php
require_once("./php-enum.php");

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
$day = new Weekend(Weekend::Saturday);

echo $month . PHP_EOL;
echo $day . PHP_EOL;
