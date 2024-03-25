--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    'Default' => [v::consecutive(v::alwaysValid(), v::trueVal()), false],
    'Negative' => [v::not(v::consecutive(v::alwaysValid(), v::trueVal())), true],
    'Default with inverted failing rule' => [v::consecutive(v::alwaysValid(), v::not(v::trueVal())), true],
    'With wrapped name, default' => [
        v::consecutive(v::alwaysValid(), v::trueVal()->setName('Wrapped'))->setName('Wrapper'),
        false,
    ],
    'With wrapper name, default' => [
        v::consecutive(v::alwaysValid(), v::trueVal())->setName('Wrapper'),
        false,
    ],
    'With the name set in the wrapped rule of an inverted failing rule' => [
        v::consecutive(v::alwaysValid(), v::not(v::trueVal()->setName('Wrapped'))->setName('Not'))->setName('Wrapper'),
        true,
    ],
    'With the name set in an inverted failing rule' => [
        v::consecutive(v::alwaysValid(), v::not(v::trueVal())->setName('Not'))->setName('Wrapper'),
        true,
    ],
    'With the name set in the "consecutive" that has an inverted failing rule' => [
        v::consecutive(v::alwaysValid(), v::not(v::trueVal()))->setName('Wrapper'),
        true,
    ],
    'With template' => [
        v::consecutive(v::alwaysValid(), v::trueVal()),
        false,
        'Consecutive cool cats cunningly continuous cookies',
    ],
    'With multiple templates' => [
        v::consecutive(v::alwaysValid(), v::trueVal()),
        false,
        ['trueVal' => 'Clever clowns craft consecutive clever clocks'],
    ],
    'Real example' => [
        v::consecutive(
            v::key('countyCode', v::countryCode()),
            v::lazy(static fn($input) => v::key('subdivisionCode', v::subdivisionCode($input['countyCode']))),
        ),
        [
            'countyCode' => 'BR',
            'subdivisionCode' => 'CA',
        ],
    ],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
`false` must evaluate to `true`
- `false` must evaluate to `true`
[
    'trueVal' => '`false` must evaluate to `true`',
]

Negative
⎺⎺⎺⎺⎺⎺⎺⎺
`true` must not evaluate to `true`
- `true` must not evaluate to `true`
[
    'trueVal' => '`true` must not evaluate to `true`',
]

Default with inverted failing rule
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
`true` must not evaluate to `true`
- `true` must not evaluate to `true`
[
    'trueVal' => '`true` must not evaluate to `true`',
]

With wrapped name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must evaluate to `true`
- Wrapped must evaluate to `true`
[
    'trueVal' => 'Wrapped must evaluate to `true`',
]

With wrapper name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must evaluate to `true`
- Wrapper must evaluate to `true`
[
    'trueVal' => 'Wrapper must evaluate to `true`',
]

With the name set in the wrapped rule of an inverted failing rule
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not evaluate to `true`
- Wrapped must not evaluate to `true`
[
    'trueVal' => 'Wrapped must not evaluate to `true`',
]

With the name set in an inverted failing rule
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not must not evaluate to `true`
- Not must not evaluate to `true`
[
    'trueVal' => 'Not must not evaluate to `true`',
]

With the name set in the "consecutive" that has an inverted failing rule
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must not evaluate to `true`
- Wrapper must not evaluate to `true`
[
    'trueVal' => 'Wrapper must not evaluate to `true`',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Consecutive cool cats cunningly continuous cookies
- Consecutive cool cats cunningly continuous cookies
[
    'trueVal' => 'Consecutive cool cats cunningly continuous cookies',
]

With multiple templates
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Clever clowns craft consecutive clever clocks
- Clever clowns craft consecutive clever clocks
[
    'trueVal' => 'Clever clowns craft consecutive clever clocks',
]

Real example
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
subdivisionCode must be a subdivision code of Brazil
- subdivisionCode must be a subdivision code of Brazil
[
    'subdivisionCode' => 'subdivisionCode must be a subdivision code of Brazil',
]

