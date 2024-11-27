--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

run([
    'Default' => [v::undefOr(v::alpha()), 1234],
    'Negative wrapper' => [v::not(v::undefOr(v::alpha())), 'alpha'],
    'Negative wrapped' => [v::undefOr(v::not(v::alpha())), 'alpha'],
    'Negative undefined' => [v::not(v::undefOr(v::alpha())), null],
    'Negative undefined, wrapped name' => [v::not(v::undefOr(v::alpha()->setName('Wrapped'))), null],
    'Negative undefined, wrapped name' => [v::not(v::undefOr(v::alpha())->setName('Wrapper')), null],
    'Negative undefined, not name' => [v::not(v::undefOr(v::alpha()))->setName('Not'), null],
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

Negative wrapper
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z)
- "alpha" must not contain letters (a-z)
[
    'notUndefOrAlpha' => '"alpha" must not contain letters (a-z)',
]

Negative wrapped
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z)
- "alpha" must not contain letters (a-z)
[
    'undefOrNotAlpha' => '"alpha" must not contain letters (a-z)',
]

Negative undefined
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The value must not be undefined
- The value must not be undefined
[
    'notUndefOr' => 'The value must not be undefined',
]

Negative undefined, wrapped name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must not be undefined
- Wrapper must not be undefined
[
    'notUndefOr' => 'Wrapper must not be undefined',
]

Negative undefined, not name
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
