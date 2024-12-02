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
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
1234 must contain only letters (a-z)
- 1234 must contain only letters (a-z)
[
    'nullOrAlpha' => '1234 must contain only letters (a-z)',
]

Inverted wrapper
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z)
- "alpha" must not contain letters (a-z)
[
    'notNullOrAlpha' => '"alpha" must not contain letters (a-z)',
]

Inverted wrapped
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z)
- "alpha" must not contain letters (a-z)
[
    'nullOrNotAlpha' => '"alpha" must not contain letters (a-z)',
]

Inverted nullined
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The value must not be null
- The value must not be null
[
    'notNullOr' => 'The value must not be null',
]

Inverted nullined, wrapped name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not be null
- Wrapped must not be null
[
    'notNullOr' => 'Wrapped must not be null',
]

Inverted nullined, wrapper name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must not be null
- Wrapper must not be null
[
    'notNullOr' => 'Wrapper must not be null',
]

Inverted nullined, not name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not must not be null
- Not must not be null
[
    'notNullOr' => 'Not must not be null',
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
