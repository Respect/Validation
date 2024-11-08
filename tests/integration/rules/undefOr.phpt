--FILE--
<?php

require 'vendor/autoload.php';

run([
    'Default' => [v::undefOr(v::alpha()), 1234],
    'Inverted wrapper' => [v::not(v::undefOr(v::alpha())), 'alpha'],
    'Inverted wrapped' => [v::undefOr(v::not(v::alpha())), 'alpha'],
    'Inverted undefined' => [v::not(v::undefOr(v::alpha())), null],
    'Inverted undefined, wrapped name' => [v::not(v::undefOr(v::alpha()->setName('Wrapped'))), null],
    'Inverted undefined, wrapper name' => [v::not(v::undefOr(v::alpha())->setName('Wrapper')), null],
    'Inverted undefined, not name' => [v::not(v::undefOr(v::alpha()))->setName('Not'), null],
    'With template' => [v::undefOr(v::alpha()), 123, 'Underneath the undulating umbrella'],
    'With array template' => [v::undefOr(v::alpha()), 123, ['undefOrAlpha' => 'Undefined number of unique unicorns']],
    'Inverted undefined with template' => [
        v::not(v::undefOr(v::alpha())),
        '',
        ['notUndefOrAlpha' => 'Should not be undefined or alpha'],
    ],
    'Not a sibling compatible rule' => [
        v::undefOr(v::alpha()->stringType()),
        1234,
    ],
    'Not a sibling compatible rule with templates' => [
        v::undefOr(v::alpha()->stringType()),
        1234,
        [
            'undefOrAlpha' => 'Should be nul or alpha',
            'undefOrStringType' => 'Should be nul or string type',
        ],
    ],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
1234 must contain only letters (a-z) or must be undefined
- 1234 must contain only letters (a-z) or must be undefined
[
    'undefOrAlpha' => '1234 must contain only letters (a-z) or must be undefined',
]

Inverted wrapper
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z) and must not be undefined
- "alpha" must not contain letters (a-z) and must not be undefined
[
    'notUndefOrAlpha' => '"alpha" must not contain letters (a-z) and must not be undefined',
]

Inverted wrapped
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z) or must be undefined
- "alpha" must not contain letters (a-z) or must be undefined
[
    'undefOrNotAlpha' => '"alpha" must not contain letters (a-z) or must be undefined',
]

Inverted undefined
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
`null` must not contain letters (a-z) and must not be undefined
- `null` must not contain letters (a-z) and must not be undefined
[
    'notUndefOrAlpha' => '`null` must not contain letters (a-z) and must not be undefined',
]

Inverted undefined, wrapped name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not contain letters (a-z) and must not be undefined
- Wrapped must not contain letters (a-z) and must not be undefined
[
    'notUndefOrAlpha' => 'Wrapped must not contain letters (a-z) and must not be undefined',
]

Inverted undefined, wrapper name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must not contain letters (a-z) and must not be undefined
- Wrapper must not contain letters (a-z) and must not be undefined
[
    'notUndefOrAlpha' => 'Wrapper must not contain letters (a-z) and must not be undefined',
]

Inverted undefined, not name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not must not contain letters (a-z) and must not be undefined
- Not must not contain letters (a-z) and must not be undefined
[
    'notUndefOrAlpha' => 'Not must not contain letters (a-z) and must not be undefined',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Underneath the undulating umbrella
- Underneath the undulating umbrella
[
    'undefOrAlpha' => 'Underneath the undulating umbrella',
]

With array template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Undefined number of unique unicorns
- Undefined number of unique unicorns
[
    'undefOrAlpha' => 'Undefined number of unique unicorns',
]

Inverted undefined with template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Should not be undefined or alpha
- Should not be undefined or alpha
[
    'notUndefOrAlpha' => 'Should not be undefined or alpha',
]

Not a sibling compatible rule
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
1234 must contain only letters (a-z) or must be undefined
- All of the required rules must pass for 1234
  - 1234 must contain only letters (a-z) or must be undefined
  - 1234 must be of type string or must be undefined
[
    '__root__' => 'All of the required rules must pass for 1234',
    'undefOrAlpha' => '1234 must contain only letters (a-z) or must be undefined',
    'undefOrStringType' => '1234 must be of type string or must be undefined',
]

Not a sibling compatible rule with templates
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Should be nul or alpha
- All of the required rules must pass for 1234
  - Should be nul or alpha
  - Should be nul or string type
[
    '__root__' => 'All of the required rules must pass for 1234',
    'undefOrAlpha' => 'Should be nul or alpha',
    'undefOrStringType' => 'Should be nul or string type',
]
