--TEST--
setTemplate() with multiple validators should use template as full message
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

try {
    Validator::callback('is_string')->setTemplate('{{name}} is not tasty')->between(1, 2)->assert('something');
} catch (NestedValidationException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
- "something" is not tasty
  - "something" must be greater than or equal to 1
