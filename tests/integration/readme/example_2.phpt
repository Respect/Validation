--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionFullMessage(
    static fn() => v::alnum()->noWhitespace()->length(v::between(1, 15))->assert('really messed up screen#name')
);
?>
--EXPECT--
- All of the required rules must pass for "really messed up screen#name"
  - "really messed up screen#name" must contain only letters (a-z) and digits (0-9)
  - "really messed up screen#name" must not contain whitespace
  - The length of "really messed up screen#name" must be between 1 and 15
