--FILE--
<?php

require 'vendor/autoload.php';

run([
    'Default' => [v::nullOr(v::alpha()), 1234],
    'Inverted wrapper' => [v::not(v::nullOr(v::alpha())), 'alpha'],
    'Inverted wrapped' => [v::nullOr(v::not(v::alpha())), 'alpha'],
    'Inverted nullined' => [v::not(v::nullOr(v::alpha())), null],
    'Inverted nullined, wrapped name' => [v::not(v::nullOr(v::alpha()->setName('Wrapped'))), null],
    'Inverted nullined, wrapper name' => [v::not(v::nullOr(v::alpha())->setName('Wrapper')), null],
    'Inverted nullined, not name' => [v::not(v::nullOr(v::alpha()))->setName('Not'), null],
    'With template' => [v::nullOr(v::alpha()), 123, 'Nine nimble numismatists near Naples'],
    'With array template' => [v::nullOr(v::alpha()), 123, ['nullOrAlpha' => 'Next to nifty null notations']],
    'Inverted nullined with template' => [
        v::not(v::nullOr(v::alpha())),
        null,
        ['notNullOrAlpha' => 'Next to nifty null notations'],
    ],
    'Not a sibling compatible rule' => [
        v::nullOr(v::alpha()->stringType()),
        1234,
    ],
    'Not a sibling compatible rule with templates' => [
        v::nullOr(v::alpha()->stringType()),
        1234,
        [
            'nullOrAlpha' => 'Should be nul or alpha',
            'nullOrStringType' => 'Should be nul or string type',
        ],
    ],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
1234 must contain only letters (a-z) or must be null
- 1234 must contain only letters (a-z) or must be null
[
    'nullOrAlpha' => '1234 must contain only letters (a-z) or must be null',
]

Inverted wrapper
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z) and must not be null
- "alpha" must not contain letters (a-z) and must not be null
[
    'notNullOrAlpha' => '"alpha" must not contain letters (a-z) and must not be null',
]

Inverted wrapped
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z) or must be null
- "alpha" must not contain letters (a-z) or must be null
[
    'nullOrNotAlpha' => '"alpha" must not contain letters (a-z) or must be null',
]

Inverted nullined
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
`null` must not contain letters (a-z) and must not be null
- `null` must not contain letters (a-z) and must not be null
[
    'notNullOrAlpha' => '`null` must not contain letters (a-z) and must not be null',
]

Inverted nullined, wrapped name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not contain letters (a-z) and must not be null
- Wrapped must not contain letters (a-z) and must not be null
[
    'notNullOrAlpha' => 'Wrapped must not contain letters (a-z) and must not be null',
]

Inverted nullined, wrapper name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must not contain letters (a-z) and must not be null
- Wrapper must not contain letters (a-z) and must not be null
[
    'notNullOrAlpha' => 'Wrapper must not contain letters (a-z) and must not be null',
]

Inverted nullined, not name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not must not contain letters (a-z) and must not be null
- Not must not contain letters (a-z) and must not be null
[
    'notNullOrAlpha' => 'Not must not contain letters (a-z) and must not be null',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Nine nimble numismatists near Naples
- Nine nimble numismatists near Naples
[
    'nullOrAlpha' => 'Nine nimble numismatists near Naples',
]

With array template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Next to nifty null notations
- Next to nifty null notations
[
    'nullOrAlpha' => 'Next to nifty null notations',
]

Inverted nullined with template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Next to nifty null notations
- Next to nifty null notations
[
    'notNullOrAlpha' => 'Next to nifty null notations',
]

Not a sibling compatible rule
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
1234 must contain only letters (a-z) or must be null
- All of the required rules must pass for 1234
  - 1234 must contain only letters (a-z) or must be null
  - 1234 must be of type string or must be null
[
    '__root__' => 'All of the required rules must pass for 1234',
    'nullOrAlpha' => '1234 must contain only letters (a-z) or must be null',
    'nullOrStringType' => '1234 must be of type string or must be null',
]

Not a sibling compatible rule with templates
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Should be nul or alpha
- All of the required rules must pass for 1234
  - Should be nul or alpha
  - Should be nul or string type
[
    '__root__' => 'All of the required rules must pass for 1234',
    'nullOrAlpha' => 'Should be nul or alpha',
    'nullOrStringType' => 'Should be nul or string type',
]
