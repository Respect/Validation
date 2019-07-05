--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

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

try {
    $validator->assert($config);
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
- These rules must pass for Settings
  - host must be of type string
  - user must be present
