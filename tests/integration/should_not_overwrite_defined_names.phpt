--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

$input = ['email' => 'not an email'];

try {
    v::key('email', v::email()->setName('Email'))->setName('Foo')->check($input);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    // This is a trick thing: the call to `setName()` here seems to be the one
    // from the `Key` rule but it's actually from the `Validator`.
    v::key('email', v::email())->setName('Email')->check($input);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::key('email', v::email())->check($input);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
?>
--EXPECT--
Email must be valid email
email must be valid email
email must be valid email
