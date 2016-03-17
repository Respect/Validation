--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

$config = [
    'host' => 'my_host',
    'password' => 'my_password',
    'schema' => 'my_schema',
];

$validator = v::arrayType()
    ->setName('Settings')
    ->key('host', v::stringType())
    ->key('user', v::stringType())
    ->key('password', v::stringType())
    ->key('schema', v::stringType());

try {
    $validator->assert($config);
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
- Key user must be present
