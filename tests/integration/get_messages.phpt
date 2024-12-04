--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessages(static function (): void {
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
[
    '__root__' => 'All of the required rules must pass for `["mysql": ["host": 42, "schema": 42], "postgresql": ["user": 42, "password": 42]]`',
    'mysql' => [
        '__root__' => 'All of the required rules must pass for mysql',
        'host' => 'host must be a string',
        'user' => 'user must be present',
        'password' => 'password must be present',
        'schema' => 'schema must be a string',
    ],
    'postgresql' => [
        '__root__' => 'All of the required rules must pass for postgresql',
        'host' => 'host must be present',
        'user' => 'user must be a string',
        'password' => 'password must be a string',
        'schema' => 'schema must be present',
    ],
]