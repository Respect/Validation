--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::key('email', v::email()->setTemplate('WRONG EMAIL!!!!!!'))->assert(['email' => 'qwe']);
} catch (NestedValidationException $exception) {
    print_r($exception->getMessages());
}
?>
--EXPECTF--
Array
(
    [0] => WRONG EMAIL!!!!!!
)
