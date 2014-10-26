<?php
use JoeFallon\KissTest\UnitTest;

require_once('config/main.php');

new \tests\JoeFallon\PhpLog\LogTests();

UnitTest::getAllUnitTestsSummary();
