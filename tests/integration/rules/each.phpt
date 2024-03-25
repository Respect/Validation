--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$empty = [];
$nonIterable = null;
$negative = [1, 2, 3];
$default = ['a', 'b', 'c'];

run([
    // Simple
    'Non-iterable' => [v::each(v::intType()), $nonIterable],
    'Empty' => [v::each(v::intType()), $empty],
    'Default' => [v::each(v::intType()), $default],
    'Negative' => [v::not(v::each(v::intType())), $negative],

    // With name
    'With name, non-iterable' => [v::each(v::intType()->setName('Wrapped'))->setName('Wrapper'), $nonIterable],
    'With name, empty' => [v::each(v::intType()->setName('Wrapped'))->setName('Wrapper'), $empty],
    'With name, default' => [v::each(v::intType()->setName('Wrapped'))->setName('Wrapper'), $default],
    'With name, negative' => [
        v::not(v::each(v::intType()->setName('Wrapped'))->setName('Wrapper'))->setName('Not'),
        $negative,
    ],
    'With wrapper name, default' => [v::each(v::intType())->setName('Wrapper'), $default],
    'With wrapper name, negative' => [
        v::not(v::each(v::intType())->setName('Wrapper'))->setName('Not'),
        $negative,
    ],
    'With Not name, negative' => [
        v::not(v::each(v::intType()))->setName('Not'),
        $negative,
    ],

    // With template
    'With template, non-iterable' => [v::each(v::intType()), $nonIterable, 'You should have passed an iterable'],
    'With template, empty' => [v::each(v::intType()), $empty, 'You should have passed an non-empty'],
    'With template, default' => [v::each(v::intType()), $default, 'All items should have been integers'],
    'with template, negative' => [v::not(v::each(v::intType())), $negative, 'All items should not have been integers'],

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
`null` must be of type iterable
- `null` must be of type iterable
[
    'each' => '`null` must be of type iterable',
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
"a" must be of type integer
- Each item in `["a", "b", "c"]` must be valid
  - "a" must be of type integer
  - "b" must be of type integer
  - "c" must be of type integer
[
    '__root__' => 'Each item in `["a", "b", "c"]` must be valid',
    'intType.1' => '"a" must be of type integer',
    'intType.2' => '"b" must be of type integer',
    'intType.3' => '"c" must be of type integer',
]

Negative
⎺⎺⎺⎺⎺⎺⎺⎺
1 must not be of type integer
- Each item in `[1, 2, 3]` must not validate
  - 1 must not be of type integer
  - 2 must not be of type integer
  - 3 must not be of type integer
[
    '__root__' => 'Each item in `[1, 2, 3]` must not validate',
    'intType.1' => '1 must not be of type integer',
    'intType.2' => '2 must not be of type integer',
    'intType.3' => '3 must not be of type integer',
]

With name, non-iterable
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must be of type iterable
- Wrapped must be of type iterable
[
    'Wrapped' => 'Wrapped must be of type iterable',
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
Wrapped must be of type integer
- Each item in Wrapped must be valid
  - Wrapped must be of type integer
  - Wrapped must be of type integer
  - Wrapped must be of type integer
[
    '__root__' => 'Each item in Wrapped must be valid',
    'Wrapped.1' => 'Wrapped must be of type integer',
    'Wrapped.2' => 'Wrapped must be of type integer',
    'Wrapped.3' => 'Wrapped must be of type integer',
]

With name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not be of type integer
- Each item in Wrapped must not validate
  - Wrapped must not be of type integer
  - Wrapped must not be of type integer
  - Wrapped must not be of type integer
[
    '__root__' => 'Each item in Wrapped must not validate',
    'Wrapped.1' => 'Wrapped must not be of type integer',
    'Wrapped.2' => 'Wrapped must not be of type integer',
    'Wrapped.3' => 'Wrapped must not be of type integer',
]

With wrapper name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must be of type integer
- Each item in Wrapper must be valid
  - Wrapper must be of type integer
  - Wrapper must be of type integer
  - Wrapper must be of type integer
[
    '__root__' => 'Each item in Wrapper must be valid',
    'Wrapper.1' => 'Wrapper must be of type integer',
    'Wrapper.2' => 'Wrapper must be of type integer',
    'Wrapper.3' => 'Wrapper must be of type integer',
]

With wrapper name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must not be of type integer
- Each item in Wrapper must not validate
  - Wrapper must not be of type integer
  - Wrapper must not be of type integer
  - Wrapper must not be of type integer
[
    '__root__' => 'Each item in Wrapper must not validate',
    'Wrapper.1' => 'Wrapper must not be of type integer',
    'Wrapper.2' => 'Wrapper must not be of type integer',
    'Wrapper.3' => 'Wrapper must not be of type integer',
]

With Not name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not must not be of type integer
- Each item in Not must not validate
  - Not must not be of type integer
  - Not must not be of type integer
  - Not must not be of type integer
[
    '__root__' => 'Each item in Not must not validate',
    'Not.1' => 'Not must not be of type integer',
    'Not.2' => 'Not must not be of type integer',
    'Not.3' => 'Not must not be of type integer',
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

with template, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
All items should not have been integers
- All items should not have been integers
[
    'each' => 'All items should not have been integers',
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
First item should have been an integer
- Here a sequence of items that did not pass the validation
  - First item should have been an integer
  - Second item should have been an integer
  - Third item should have been an integer
[
    '__root__' => 'Here a sequence of items that did not pass the validation',
    'Wrapped.1' => 'First item should have been an integer',
    'Wrapped.2' => 'Second item should have been an integer',
    'Wrapped.3' => 'Third item should have been an integer',
]

