--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::noneOf(v::intType(), v::positive())->assert(42));
exceptionMessage(static fn() => v::not(v::noneOf(v::intType(), v::positive()))->assert('-1'));
exceptionFullMessage(static fn() => v::noneOf(v::intType(), v::positive())->assert(42));
exceptionFullMessage(static fn() => v::not(v::noneOf(v::intType(), v::positive()))->assert('-1'));
?>
--EXPECT--
42 must not be of type integer
"-1" must be of type integer
- None of these rules must pass for 42
  - 42 must not be of type integer
  - 42 must not be positive
- All of these rules must pass for "-1"
  - "-1" must be of type integer
  - "-1" must be positive
