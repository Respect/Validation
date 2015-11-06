--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$usernameValidator = v::alnum()->noWhitespace()->length(1, 15);
try {
    $usernameValidator->assert('really messed up screen#name');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--
- All of the required rules must pass for "really messed up screen#name"
  - "really messed up screen#name" must contain only letters (a-z) and digits (0-9)
  - "really messed up screen#name" must not contain whitespace
  - "really messed up screen#name" must have a length between 1 and 15
