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
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
1234 must contain only letters (a-z)
- 1234 must contain only letters (a-z)
[
    'undefOrAlpha' => '1234 must contain only letters (a-z)',
]

Inverted wrapper
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z)
- "alpha" must not contain letters (a-z)
[
    'notUndefOrAlpha' => '"alpha" must not contain letters (a-z)',
]

Inverted wrapped
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z)
- "alpha" must not contain letters (a-z)
[
    'undefOrNotAlpha' => '"alpha" must not contain letters (a-z)',
]

Inverted undefined
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The value must not be undefined
- The value must not be undefined
[
    'notUndefOr' => 'The value must not be undefined',
]

Inverted undefined, wrapped name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not be undefined
- Wrapped must not be undefined
[
    'notUndefOr' => 'Wrapped must not be undefined',
]

Inverted undefined, wrapper name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must not be undefined
- Wrapper must not be undefined
[
    'notUndefOr' => 'Wrapper must not be undefined',
]

Inverted undefined, not name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not must not be undefined
- Not must not be undefined
[
    'notUndefOr' => 'Not must not be undefined',
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
