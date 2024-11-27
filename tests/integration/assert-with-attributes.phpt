--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionFullMessage(static function (): void {
    $array = [
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
    ];
    $object = json_decode((string) json_encode($array));
    v::create()
        ->property(
            'mysql',
            v::create()
                ->property('host', v::stringType())
                ->property('user', v::stringType())
                ->property('password', v::stringType())
                ->property('schema', v::stringType())
        )
        ->property(
            'postgresql',
            v::create()
                ->property('host', v::stringType())
                ->property('user', v::stringType())
                ->property('password', v::stringType())
                ->property('schema', v::stringType())
        )
        ->setName('the given data')
        ->assert($object);
});
?>
--EXPECT--
- All of the required rules must pass for the given data
  - These rules must pass for mysql
    - host must be of type string
  - These rules must pass for postgresql
    - user must be of type string
