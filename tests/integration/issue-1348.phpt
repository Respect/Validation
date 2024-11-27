--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator;

$cars = [
    ['manufacturer' => 'Honda', 'model' => 'Accord'],
    ['manufacturer' => 'Toyota', 'model' => 'Rav4'],
    ['manufacturer' => 'Ford', 'model' => 'not real'],
    ['manufacturer' => 'Honda', 'model' => 'not valid'],
];

exceptionMessages(static function () use ($cars): void {
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
[
    'each' => [
        '__root__' => 'Each item in `[["manufacturer": "Honda", "model": "Accord"], ["manufacturer": "Toyota", "model": "Rav4"], ["manufacturer": "Fo ... ]` must be valid',
        'oneOf.3' => [
            '__root__' => 'Only one of these rules must pass for `["manufacturer": "Ford", "model": "not real"]`',
            'allOf.1' => [
                '__root__' => 'All of the required rules must pass for `["manufacturer": "Ford", "model": "not real"]`',
                'manufacturer' => 'manufacturer must equal "Honda"',
                'model' => 'model must be in `["Accord", "Fit"]`',
            ],
            'allOf.2' => [
                '__root__' => 'All of the required rules must pass for `["manufacturer": "Ford", "model": "not real"]`',
                'manufacturer' => 'manufacturer must equal "Toyota"',
                'model' => 'model must be in `["Rav4", "Camry"]`',
            ],
            'allOf.3' => 'model must be in `["F150", "Bronco"]`',
        ],
        'oneOf.4' => [
            '__root__' => 'Only one of these rules must pass for `["manufacturer": "Honda", "model": "not valid"]`',
            'allOf.1' => 'model must be in `["Accord", "Fit"]`',
            'allOf.2' => [
                '__root__' => 'All of the required rules must pass for `["manufacturer": "Honda", "model": "not valid"]`',
                'manufacturer' => 'manufacturer must equal "Toyota"',
                'model' => 'model must be in `["Rav4", "Camry"]`',
            ],
            'allOf.3' => [
                '__root__' => 'All of the required rules must pass for `["manufacturer": "Honda", "model": "not valid"]`',
                'manufacturer' => 'manufacturer must equal "Ford"',
                'model' => 'model must be in `["F150", "Bronco"]`',
            ],
        ],
    ],
]
