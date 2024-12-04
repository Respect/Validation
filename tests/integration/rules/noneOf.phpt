--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::noneOf(v::intType(), v::positive())->assert(42));
exceptionMessage(static fn() => v::not(v::noneOf(v::intType(), v::positive()))->assert('-1'));
exceptionFullMessage(static fn() => v::noneOf(v::intType(), v::positive())->assert(42));
exceptionFullMessage(static fn() => v::not(v::noneOf(v::intType(), v::positive()))->assert('-1'));
?>
--EXPECT--
42 must not be an integer
"-1" must be an integer
- None of these rules must pass for 42
  - 42 must not be an integer
  - 42 must not be a positive number
- All of these rules must pass for "-1"
  - "-1" must be an integer
  - "-1" must be a positive number