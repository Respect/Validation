--FILE--
<?php

declare(strict_types=1);

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

exceptionFullMessage(static fn() => $validator->assert($config));
?>
--EXPECT--
- host must be of type string
- user must be present
