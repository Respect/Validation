--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationExceptionInterface;

$usernameValidator = v::alnum()->noWhitespace()->length(1, 15);
try {
    $usernameValidator->assert('really messed up screen#name');
} catch(NestedValidationExceptionInterface $exception) {
    print_r($exception->findMessages(['alnum', 'noWhitespace']));
}
?>
--EXPECTF--
Array
(
    [alnum] => "really messed up screen#name" must contain only letters (a-z) and digits (0-9)
    [noWhitespace] => "really messed up screen#name" must not contain whitespace
)
