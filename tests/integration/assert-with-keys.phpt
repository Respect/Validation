--FILE--
<?php
require 'vendor/autoload.php';
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::create()
        ->key(
            'mysql',
            v::create()
                ->key('host', v::stringType(), true)
                ->key('user', v::stringType(), true)
                ->key('password', v::stringType(), true)
                ->key('schema', v::stringType(), true),
            true
        )
        ->key(
            'postgresql',
            v::create()
                ->key('host', v::stringType(), true)
                ->key('user', v::stringType(), true)
                ->key('password', v::stringType(), true)
                ->key('schema', v::stringType(), true),
            true
        )
        ->setName('the given data')
        ->assert([
            'mysql' => [
                'host' => 42,
                'schema' => 42,
            ],
            'postgresql' => [
                'user' => 42,
                'password' => 42,
            ],
        ]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
- All of the required rules must pass for the given data
  - All of the required rules must pass for mysql
    - host must be of type string
    - Key user must be present
    - Key password must be present
    - schema must be of type string
  - All of the required rules must pass for postgresql
    - Key host must be present
    - user must be of type string
    - password must be of type string
    - Key schema must be present
