--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    'Password confirmation' => [
        v::lazyConsecutive(
            static fn() => v::key('password', v::stringType()),
            static fn($input) => v::key('password_confirmation', v::equals($input['password']))
        ),
        [
            'password' => '123456',
            'password_confirmation' => '1234s56',
        ],
    ],
    'Localization confirmation' => [
        v::lazyConsecutive(
            static fn() => v::key('countyCode', v::countryCode()),
            static fn($input) => v::key('subdivisionCode', v::subdivisionCode($input['countyCode'])),
        ),
        [
            'countyCode' => 'BR',
            'subdivisionCode' => 'CA',
        ],
    ],
]);
?>
--EXPECT--
Password confirmation
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
password_confirmation must equal "123456"
- password_confirmation must equal "123456"
[
    'password_confirmation' => 'password_confirmation must equal "123456"',
]

Localization confirmation
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
subdivisionCode must be a subdivision code of Brazil
- subdivisionCode must be a subdivision code of Brazil
[
    'subdivisionCode' => 'subdivisionCode must be a subdivision code of Brazil',
]
