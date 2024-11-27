--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

run([
    'optional' => [v::optional(v::scalarVal()), []],
]);
?>
--EXPECT--
optional
⎺⎺⎺⎺⎺⎺⎺⎺
`[]` must be a scalar value
- `[]` must be a scalar value
[
    'undefOrScalarVal' => '`[]` must be a scalar value',
]
