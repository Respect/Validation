--FILE--
<?php

require 'vendor/autoload.php';

$config = [
    'host' => 1,
    'password' => 'my_password',
    'schema' => 'my_schema',
];

$validator = v::arrayType();
$validator->setName('Settings');
$validator->key('host', v::stringType());
$validator->key('user', v::stringType());
$validator->key('password', v::stringType());
$validator->key('schema', v::stringType());

exceptionAll('https://github.com/Respect/Validation/issues/179', static fn() => $validator->assert($config));
?>
--EXPECT--
https://github.com/Respect/Validation/issues/179
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
host must be a string
- These rules must pass for Settings
  - host must be a string
  - user must be present
[
    '__root__' => 'These rules must pass for Settings',
    'host' => 'host must be a string',
    'user' => 'user must be present',
]
