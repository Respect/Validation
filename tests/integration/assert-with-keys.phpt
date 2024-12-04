--FILE--
<?php

require 'vendor/autoload.php';

exceptionFullMessage(static function (): void {
    v::create()
        ->key(
            'mysql',
            v::create()
                ->key('host', v::stringType())
                ->key('user', v::stringType())
                ->key('password', v::stringType())
                ->key('schema', v::stringType())
        )
        ->key(
            'postgresql',
            v::create()
                ->key('host', v::stringType())
                ->key('user', v::stringType())
                ->key('password', v::stringType())
                ->key('schema', v::stringType())
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
});
?>
--EXPECT--
- All of the required rules must pass for the given data
  - All of the required rules must pass for mysql
    - host must be a string
    - user must be present
    - password must be present
    - schema must be a string
  - All of the required rules must pass for postgresql
    - host must be present
    - user must be a string
    - password must be a string
    - schema must be present