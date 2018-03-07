--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$usernameValidator = v::alnum()->noWhitespace()->length(1, 15);
try {
    $usernameValidator->assert('really messed up screen#name');
} catch (NestedValidationException $exception) {
    print_r(
        $exception->getMessages([
            'alnum' => '{{name}} must contain only letters and digits',
            'noWhitespace' => '{{name}} cannot contain spaces',
            'length' => '{{name}} must not have more than 15 chars',
        ])
    );
}
?>
--EXPECTF--
Array
(
    [alnum] => "really messed up screen#name" must contain only letters and digits
    [noWhitespace] => "really messed up screen#name" cannot contain spaces
    [length] => "really messed up screen#name" must not have more than 15 chars
)
