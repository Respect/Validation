--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$user = new \stdClass;
$user->email = 'email';
$user->password = '123456 78';

try {
    v::attribute('email', v::notEmpty()->email()->setName('Email Field'))
        ->attribute('password', v::notEmpty()->noWhitespace()->setName('Password Field'))
        ->assert($user);
} catch (NestedValidationException $e) {
    print_r($e->findMessages([
        'email' => 'Error: {{name}}',
        'notEmpty' => 'Error: {{name}}',
        'noWhitespace' => 'Error: {{name}}',
    ]));
}
?>
--EXPECTF--
Array
(
    [email] => Error: Email Field
    [notEmpty] => 
    [noWhitespace] => Error: Password Field,
)
