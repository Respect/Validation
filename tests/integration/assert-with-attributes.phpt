--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Jonathan Stewmon <jstewmon@rmn.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionFullMessage(static function () {
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
        ->attribute(
            'mysql',
            v::create()
                ->attribute('host', v::stringType(), true)
                ->attribute('user', v::stringType(), true)
                ->attribute('password', v::stringType(), true)
                ->attribute('schema', v::stringType(), true),
            true
        )
        ->attribute(
            'postgresql',
            v::create()
                ->attribute('host', v::stringType(), true)
                ->attribute('user', v::stringType(), true)
                ->attribute('password', v::stringType(), true)
                ->attribute('schema', v::stringType(), true),
            true
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
