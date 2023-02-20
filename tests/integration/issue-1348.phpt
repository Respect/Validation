--CREDITS--
Alexandre Gomes Gaigalas <alganet@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

$cars = [
    ['manufacturer' => 'Honda', 'model' => 'Accord'],
    ['manufacturer' => 'Toyota', 'model' => 'Rav4'],
    ['manufacturer' => 'Ford', 'model' => 'notarealcar'],
    ['manufacturer' => 'Honda', 'model' => 'not valid'],
];

try {
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
} catch (NestedValidationException $e) {
    var_dump($e->getMessages());
}


?>
--EXPECT--
array(1) {
  ["each"]=>
  array(2) {
    ["validator.0"]=>
    string(92) "All of the required rules must pass for `{ "manufacturer": "Ford", "model": "notarealcar" }`"
    ["validator.1"]=>
    string(91) "All of the required rules must pass for `{ "manufacturer": "Honda", "model": "not valid" }`"
  }
}
