--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

try {
    Validator::key('email', Validator::email()->setTemplate('WRONG EMAIL!!!!!!'))->assert(['email' => 'qwe']);
} catch (NestedValidationException $exception) {
    print_r($exception->getMessages());
}
?>
--EXPECTF--
Array
(
    [0] => WRONG EMAIL!!!!!!
)
