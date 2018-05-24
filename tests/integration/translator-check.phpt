--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Factory;
use Respect\Validation\Validator;

Factory::setDefaultInstance(new Factory([], [], function (string $message): string {
    $messages = [
        '{{name}} must be of type string' => '{{name}} deve ser do tipo string',
    ];

    return $messages[$message];
}));

try {
    Validator::stringType()->length(2, 15)->check(0);
} catch (ValidationException $exception) {
    echo $exception->getMessage();
}
?>
--EXPECTF--
0 deve ser do tipo string
