--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;

function translatorCallback($message)
{
    $messages = [
        '{{name}} must be a string' => '{{name}} deve ser uma string',
    ];

    return $messages[$message];
}

try {
    Validator::stringType()->length(2, 15)->check(0);
} catch (ValidationException $exception) {
    $exception->setParam('translator', 'translatorCallback');

    echo $exception->getMainMessage();
}
?>
--EXPECTF--
0 deve ser uma string
