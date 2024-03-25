--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessages(
    static function (): void {
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
            ->setTemplates([
                'mysql' => [
                    'user' => 'Value should be a MySQL username',
                    'host' => '`{{name}}` should be a MySQL host',
                ],
                'postgresql' => [
                    'schema' => 'You must provide a valid PostgreSQL schema',
                ],
            ])
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
    }
);
?>
--EXPECT--
[
    '__root__' => 'All of the required rules must pass for `["mysql": ["host": 42, "schema": 42], "postgresql": ["user": 42, "password": 42]]`',
    'mysql' => [
        '__root__' => 'All of the required rules must pass for mysql',
        'host' => '`host` should be a MySQL host',
        'user' => 'Value should be a MySQL username',
        'password' => 'password must be present',
        'schema' => 'schema must be of type string',
    ],
    'postgresql' => [
        '__root__' => 'All of the required rules must pass for postgresql',
        'host' => 'host must be present',
        'user' => 'user must be of type string',
        'password' => 'password must be of type string',
        'schema' => 'You must provide a valid PostgreSQL schema',
    ],
]
