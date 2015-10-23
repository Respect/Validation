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
    - host must be a string
    - Key user must be present
    - Key password must be present
    - schema must be a string
  - All of the required rules must pass for postgresql
    - Key host must be present
    - user must be a string
    - password must be a string
    - Key schema must be present
