--FILE--
<?php

require 'vendor/autoload.php';

$empty = [];
$nonIterable = null;
$inverted = [1, 2, 3];
$default = ['a', 'b', 'c'];

run([
    // Simple
    'Non-iterable' => [v::each(v::intType()), $nonIterable],
    'Empty' => [v::each(v::intType()), $empty],
    'Default' => [v::each(v::intType()), $default],
    'Inverted' => [v::not(v::each(v::intType())), $inverted],

    // With name
    'With name, non-iterable' => [v::each(v::intType()->setName('Wrapped'))->setName('Wrapper'), $nonIterable],
    'With name, empty' => [v::each(v::intType()->setName('Wrapped'))->setName('Wrapper'), $empty],
    'With name, default' => [v::each(v::intType()->setName('Wrapped'))->setName('Wrapper'), $default],
    'With name, inverted' => [
        v::not(v::each(v::intType()->setName('Wrapped'))->setName('Wrapper'))->setName('Not'),
        $inverted,
    ],
    'With wrapper name, default' => [v::each(v::intType())->setName('Wrapper'), $default],
    'With wrapper name, inverted' => [
        v::not(v::each(v::intType())->setName('Wrapper'))->setName('Not'),
        $inverted,
    ],
    'With Not name, inverted' => [
        v::not(v::each(v::intType()))->setName('Not'),
        $inverted,
    ],

    // With template
    'With template, non-iterable' => [v::each(v::intType()), $nonIterable, 'You should have passed an iterable'],
    'With template, empty' => [v::each(v::intType()), $empty, 'You should have passed an non-empty'],
    'With template, default' => [v::each(v::intType()), $default, 'All items should have been integers'],
    'with template, inverted' => [v::not(v::each(v::intType())), $inverted, 'All items should not have been integers'],

    // With array template
    'With array template, default' => [
        v::each(v::intType()),
        $default, [
            'each' => [
                '__root__' => 'Here a sequence of items that did not pass the validation',
                'intType.1' => 'First item should have been an integer',
                'intType.2' => 'Second item should have been an integer',
                'intType.3' => 'Third item should have been an integer',
            ],
        ],
    ],
    'With array template and name, default' => [
        v::each(v::intType()->setName('Wrapped'))->setName('Wrapper'),
        $default, [
            'Wrapped' => [
                '__root__' => 'Here a sequence of items that did not pass the validation',
                'Wrapped.1' => 'First item should have been an integer',
                'Wrapped.2' => 'Second item should have been an integer',
                'Wrapped.3' => 'Third item should have been an integer',
            ],
        ],
    ],
]);
?>
--EXPECT--
Non-iterable
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
`null` must be iterable
- `null` must be iterable
[
    'each' => '`null` must be iterable',
]

Empty
⎺⎺⎺⎺⎺
The value must not be empty
- The value must not be empty
[
    'each' => 'The value must not be empty',
]

Default
⎺⎺⎺⎺⎺⎺⎺
"a" must be an integer
- Each item in `["a", "b", "c"]` must be valid
  - "a" must be an integer
  - "b" must be an integer
  - "c" must be an integer
[
    '__root__' => 'Each item in `["a", "b", "c"]` must be valid',
    'intType.1' => '"a" must be an integer',
    'intType.2' => '"b" must be an integer',
    'intType.3' => '"c" must be an integer',
]

Inverted
⎺⎺⎺⎺⎺⎺⎺⎺
1 must not be an integer
- Each item in `[1, 2, 3]` must be invalid
  - 1 must not be an integer
  - 2 must not be an integer
  - 3 must not be an integer
[
    '__root__' => 'Each item in `[1, 2, 3]` must be invalid',
    'intType.1' => '1 must not be an integer',
    'intType.2' => '2 must not be an integer',
    'intType.3' => '3 must not be an integer',
]

With name, non-iterable
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must be iterable
- Wrapped must be iterable
[
    'Wrapped' => 'Wrapped must be iterable',
]

With name, empty
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not be empty
- Wrapped must not be empty
[
    'Wrapped' => 'Wrapped must not be empty',
]

With name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must be an integer
- Each item in Wrapped must be valid
  - Wrapped must be an integer
  - Wrapped must be an integer
  - Wrapped must be an integer
[
    '__root__' => 'Each item in Wrapped must be valid',
    'intType.1' => 'Wrapped must be an integer',
    'intType.2' => 'Wrapped must be an integer',
    'intType.3' => 'Wrapped must be an integer',
]

With name, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not be an integer
- Each item in Wrapped must be invalid
  - Wrapped must not be an integer
  - Wrapped must not be an integer
  - Wrapped must not be an integer
[
    '__root__' => 'Each item in Wrapped must be invalid',
    'intType.1' => 'Wrapped must not be an integer',
    'intType.2' => 'Wrapped must not be an integer',
    'intType.3' => 'Wrapped must not be an integer',
]

With wrapper name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must be an integer
- Each item in Wrapper must be valid
  - Wrapper must be an integer
  - Wrapper must be an integer
  - Wrapper must be an integer
[
    '__root__' => 'Each item in Wrapper must be valid',
    'intType.1' => 'Wrapper must be an integer',
    'intType.2' => 'Wrapper must be an integer',
    'intType.3' => 'Wrapper must be an integer',
]

With wrapper name, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must not be an integer
- Each item in Wrapper must be invalid
  - Wrapper must not be an integer
  - Wrapper must not be an integer
  - Wrapper must not be an integer
[
    '__root__' => 'Each item in Wrapper must be invalid',
    'intType.1' => 'Wrapper must not be an integer',
    'intType.2' => 'Wrapper must not be an integer',
    'intType.3' => 'Wrapper must not be an integer',
]

With Not name, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not must not be an integer
- Each item in Not must be invalid
  - Not must not be an integer
  - Not must not be an integer
  - Not must not be an integer
[
    '__root__' => 'Each item in Not must be invalid',
    'intType.1' => 'Not must not be an integer',
    'intType.2' => 'Not must not be an integer',
    'intType.3' => 'Not must not be an integer',
]

With template, non-iterable
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
You should have passed an iterable
- You should have passed an iterable
[
    'each' => 'You should have passed an iterable',
]

With template, empty
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
You should have passed an non-empty
- You should have passed an non-empty
[
    'each' => 'You should have passed an non-empty',
]

With template, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
All items should have been integers
- All items should have been integers
[
    'each' => 'All items should have been integers',
]

with template, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
All items should not have been integers
- All items should not have been integers
[
    'notEach' => 'All items should not have been integers',
]

With array template, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
First item should have been an integer
- Here a sequence of items that did not pass the validation
  - First item should have been an integer
  - Second item should have been an integer
  - Third item should have been an integer
[
    '__root__' => 'Here a sequence of items that did not pass the validation',
    'intType.1' => 'First item should have been an integer',
    'intType.2' => 'Second item should have been an integer',
    'intType.3' => 'Third item should have been an integer',
]

With array template and name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must be an integer
- Each item in Wrapped must be valid
  - Wrapped must be an integer
  - Wrapped must be an integer
  - Wrapped must be an integer
[
    '__root__' => 'Each item in Wrapped must be valid',
    'intType.1' => 'Wrapped must be an integer',
    'intType.2' => 'Wrapped must be an integer',
    'intType.3' => 'Wrapped must be an integer',
]
