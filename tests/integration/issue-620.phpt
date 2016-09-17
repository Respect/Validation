--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$object = new \stdClass;
$object->email = 'Not an email';
$object->password = 'Ale xandre';

try {
    v::create()
        ->attribute('email', v::email()->setName('Email Field'))
        ->attribute('password', v::noWhitespace()->setName('Password Field'))
        ->assert($object);
} catch (NestedValidationException $exception) {
    print_r($exception->getMessages());
    print_r($exception->findMessages([
        'email' => 'Error: {{name}}',
        'noWhitespace' => 'Error: {{name}}'
    ]));
}
?>
--EXPECTF--
Array
(
    [0] => Email Field must be valid email
    [1] => Password Field must not contain whitespace
)
Array
(
    [email] => Error: Email Field
    [noWhitespace] => Error: Password Field
)
