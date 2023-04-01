--CREDITS--
Alexandre Gomes Gaigalas <alganet@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator;

$cars = [
    ['manufacturer' => 'Honda', 'model' => 'Accord'],
    ['manufacturer' => 'Toyota', 'model' => 'Rav4'],
    ['manufacturer' => 'Ford', 'model' => 'not real'],
    ['manufacturer' => 'Honda', 'model' => 'not valid'],
];

exceptionMessages(static function () use ($cars) {
    Validator::arrayType()->each(
        Validator::oneOf(
            Validator::key('manufacturer', Validator::equals('Honda'))
                ->key('model', Validator::in(['Accord', 'Fit'])),
            Validator::key('manufacturer', Validator::equals('Toyota'))
                ->key('model', Validator::in(['Rav4', 'Camry'])),
            Validator::key('manufacturer', Validator::equals('Ford'))
                ->key('model', Validator::in(['F150', 'Bronco']))
        )
    )->assert($cars);
});
?>
--EXPECT--
Array
(
    [each] => Array
        (
            [validator.0] => All of the required rules must pass for `{ "manufacturer": "Ford", "model": "not real" }`
            [validator.1] => All of the required rules must pass for `{ "manufacturer": "Honda", "model": "not valid" }`
        )

)
