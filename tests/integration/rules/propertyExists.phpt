--FILE--
<?php

require 'vendor/autoload.php';

run([
    'Default mode' => [v::propertyExists('foo'), (object) ['bar' => 'baz']],
    'Negative mode' => [v::not(v::propertyExists('foo')), (object) ['foo' => 'baz']],
    'Custom name' => [v::propertyExists('foo')->setName('Custom name'), (object) ['bar' => 'baz']],
    'Custom template' => [v::propertyExists('foo'), (object) ['bar' => 'baz'], 'Custom template for `{{name}}`'],
]);
?>
--EXPECT--
Default mode
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- foo must be present
[
    'foo' => 'foo must be present',
]

Negative mode
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must not be present
- foo must not be present
[
    'foo' => 'foo must not be present',
]

Custom name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Custom name must be present
- Custom name must be present
[
    'foo' => 'Custom name must be present',
]

Custom template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Custom template for `foo`
- Custom template for `foo`
[
    'foo' => 'Custom template for `foo`',
]
