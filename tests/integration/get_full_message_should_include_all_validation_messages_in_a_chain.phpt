--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator;

exceptionFullMessage(static fn() => Validator::stringType()->lengthBetween(2, 15)->assert(0));
?>
--EXPECT--
- All of the required rules must pass for 0
  - 0 must be of type string
  - The length of 0 must be between 2 and 15
