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
                'user' => 'user',
                'password' => 'password',
                'schema' => 'schema',
            ],
            'postgresql' => [
                'host' => 'host',
                'user' => 42,
                'password' => 'password',
                'schema' => 'schema',
            ],
        ]);
});
?>
--EXPECT--
- All of the required rules must pass for the given data
  - These rules must pass for mysql
    - host must be a string
  - These rules must pass for postgresql
    - user must be a string