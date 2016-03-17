--TEST--
setTemplate() with multiple validators should use template as main message
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

try {
    Validator::callback('is_int')->between(1, 2)->setTemplate('{{name}} is not tasty')->assert('something');
} catch (NestedValidationException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"something" is not tasty
