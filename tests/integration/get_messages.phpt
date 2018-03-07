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
    print_r($exception->getMessages());
}
?>
--EXPECTF--
Array
(
    [mysql] => Array
        (
            [host] => host must be of type string
            [user] => Key user must be present
            [password] => Key password must be present
            [schema] => schema must be of type string
        )

    [postgresql] => Array
        (
            [host] => Key host must be present
            [user] => user must be of type string
            [password] => password must be of type string
            [schema] => Key schema must be present
        )

)
