--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
--FILE--
<?php

declare(strict_types=1);

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
    print_r($exception->getMessages([
        'mysql' => [
            'user' => 'Value should be a MySQL username',
            'host' => '{{input}} should be a MySQL host',
        ],
        'postgresql' => [
            'schema' => 'You must provide a valid PostgreSQL schema',
        ],
    ]));
}
?>
--EXPECT--
Array
(
    [mysql] => Array
        (
            [host] => 42 should be a MySQL host
            [user] => Value should be a MySQL username
            [password] => password must be present
            [schema] => schema must be of type string
        )

    [postgresql] => Array
        (
            [host] => host must be present
            [user] => user must be of type string
            [password] => password must be of type string
            [schema] => You must provide a valid PostgreSQL schema
        )

)
