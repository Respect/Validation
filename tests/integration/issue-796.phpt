--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Jonathan Stewmon <jstewmon@rmn.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionFullMessage(static function () {
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
    - host must be of type string
  - These rules must pass for postgresql
    - user must be of type string
