--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    'Default' => [v::phone(), '123'],
    'Country-specific' => [v::phone('BR'), '+1 650 253 00 00'],
    'Negative' => [v::not(v::phone()), '+55 11 91111 1111'],
    'Default with name' => [v::phone()->setName('Phone'), '123'],
    'Country-specific with name' => [v::phone('US')->setName('Phone'), '123'],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
"123" must be a valid telephone number
- "123" must be a valid telephone number
[
    'phone' => '"123" must be a valid telephone number',
]

Country-specific
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"+1 650 253 00 00" must be a valid telephone number for country Brazil
- "+1 650 253 00 00" must be a valid telephone number for country Brazil
[
    'phone' => '"+1 650 253 00 00" must be a valid telephone number for country Brazil',
]

Negative
⎺⎺⎺⎺⎺⎺⎺⎺
"+55 11 91111 1111" must not be a valid telephone number
- "+55 11 91111 1111" must not be a valid telephone number
[
    'phone' => '"+55 11 91111 1111" must not be a valid telephone number',
]

Default with name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Phone must be a valid telephone number
- Phone must be a valid telephone number
[
    'phone' => 'Phone must be a valid telephone number',
]

Country-specific with name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Phone must be a valid telephone number for country United States
- Phone must be a valid telephone number for country United States
[
    'phone' => 'Phone must be a valid telephone number for country United States',
]
