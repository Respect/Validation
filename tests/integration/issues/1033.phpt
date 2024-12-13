--FILE--
<?php

require 'vendor/autoload.php';

exceptionAll(
    'https://github.com/Respect/Validation/issues/1033',
    static fn() => v::each(v::equals(1))->assert(['A', 'B', 'B'])
);
?>
--EXPECT--
https://github.com/Respect/Validation/issues/1033
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"A" must be equal to 1
- Each item in `["A", "B", "B"]` must be valid
  - "A" must be equal to 1
  - "B" must be equal to 1
  - "B" must be equal to 1
[
    '__root__' => 'Each item in `["A", "B", "B"]` must be valid',
    'equals.1' => '"A" must be equal to 1',
    'equals.2' => '"B" must be equal to 1',
    'equals.3' => '"B" must be equal to 1',
]
