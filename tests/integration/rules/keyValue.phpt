--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
Danilo Correa <danilosilva87@gmail.com>
Ian Nisbet <ian@glutenite.co.uk>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EqualsException;
use Respect\Validation\Exceptions\KeyValueException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::keyValue('password', 'equals', 'password_confirmation')
        ->check([
            'password' => 'shuberry',
            'password_confirmation' => '_shuberry_',
        ]);
} catch (EqualsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::keyValue('foo', 'equals', 'bar')->check(['bar' => 42]);
} catch (KeyValueException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::keyValue('foo', 'equals', 'bar')->check(['foo' => 42]);
} catch (KeyValueException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::keyValue('foo', 'json', 'bar')->check(['foo' => 42, 'bar' => 43]);
} catch (KeyValueException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::keyValue('password', 'equals', 'password_confirmation'))
        ->check([
            'password' => 'shuberry',
            'password_confirmation' => 'shuberry',
        ]);
} catch (EqualsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::keyValue('password', 'equals', 'password_confirmation')
        ->assert([
            'password' => 'shuberry',
            'password_confirmation' => '_shuberry_',
        ]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}




?>
--EXPECT--
password must equal "password_confirmation"
Key "foo" must be present
Key "bar" must be present
"bar" must be valid to validate "foo"
password must not equal "password_confirmation"
- password must equal "password_confirmation"