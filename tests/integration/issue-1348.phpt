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
        'oneOf.3' => [
            'allOf.1' => [
                'manufacturer' => 'manufacturer must equal "Honda"',
                'model' => 'model must be in `["Accord", "Fit"]`',
            ],
            'allOf.2' => [
                'manufacturer' => 'manufacturer must equal "Toyota"',
                'model' => 'model must be in `["Rav4", "Camry"]`',
            ],
            'allOf.3' => 'model must be in `["F150", "Bronco"]`',
        ],
        'oneOf.4' => [
            'allOf.1' => 'model must be in `["Accord", "Fit"]`',
            'allOf.2' => [
                'manufacturer' => 'manufacturer must equal "Toyota"',
                'model' => 'model must be in `["Rav4", "Camry"]`',
            ],
            'allOf.3' => [
                'manufacturer' => 'manufacturer must equal "Ford"',
                'model' => 'model must be in `["F150", "Bronco"]`',
            ],
        ],
    ],
]
