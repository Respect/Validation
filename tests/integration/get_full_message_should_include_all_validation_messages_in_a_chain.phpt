--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator;

exceptionFullMessage(
    static fn() => Validator::stringType()->length(Validator::between(2, 15))->assert(0)
);
?>
--EXPECT--
- All of the required rules must pass for 0
  - 0 must be of type string
  - The length of 0 must be between 2 and 15
