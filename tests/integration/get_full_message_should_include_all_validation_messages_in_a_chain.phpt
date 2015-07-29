--TEST--
getFullMessage() should include all validation messages in a chain
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationExceptionInterface;
use Respect\Validation\Validator;

try {
    Validator::string()->length(2, 15)->assert(0);
} catch (NestedValidationExceptionInterface $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
\-These rules must pass for "0"
  |-"0" must be a string
  \-"0" must have a length between 2 and 15
