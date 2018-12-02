--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$usernameValidator = v::alnum()->noWhitespace()->length(1, 15);
try {
    $usernameValidator->assert('really messed up screen#name');
} catch (NestedValidationException $exception) {
    print_r($exception->getMessages());
}
?>
--EXPECTF--
Array
(
    [alnum] => "really messed up screen#name" must contain only letters (a-z) and digits (0-9)
    [noWhitespace] => "really messed up screen#name" must not contain whitespace
    [length] => "really messed up screen#name" must have a length between 1 and 15
)
