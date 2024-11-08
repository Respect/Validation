--FILE--
<?php

require 'vendor/autoload.php';

run([
    'optional' => [v::optional(v::scalarVal()), []],
]);
?>
--EXPECT--
optional
⎺⎺⎺⎺⎺⎺⎺⎺
`[]` must be a scalar value or must be undefined
- `[]` must be a scalar value or must be undefined
[
    'undefOrScalarVal' => '`[]` must be a scalar value or must be undefined',
]
