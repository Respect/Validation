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

exceptionAll(
    'https://github.com/Respect/Validation/issues/1289',
    static fn () => Validator::arrayType()->each(
        Validator::oneOf(
            Validator::key('manufacturer', Validator::equals('Honda'))
                ->key('model', Validator::in(['Accord', 'Fit'])),
            Validator::key('manufacturer', Validator::equals('Toyota'))
                ->key('model', Validator::in(['Rav4', 'Camry'])),
            Validator::key('manufacturer', Validator::equals('Ford'))
                ->key('model', Validator::in(['F150', 'Bronco']))
        )
    )->assert($cars)
);
?>
--EXPECT--
https://github.com/Respect/Validation/issues/1289
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
manufacturer must be equal to "Honda"
- Each item in `[["manufacturer": "Honda", "model": "Accord"], ["manufacturer": "Toyota", "model": "Rav4"], ["manufacturer": "Fo ... ]` must be valid
  - Only one of these rules must pass for `["manufacturer": "Ford", "model": "not real"]`
    - All of the required rules must pass for `["manufacturer": "Ford", "model": "not real"]`
      - manufacturer must be equal to "Honda"
      - model must be in `["Accord", "Fit"]`
    - All of the required rules must pass for `["manufacturer": "Ford", "model": "not real"]`
      - manufacturer must be equal to "Toyota"
      - model must be in `["Rav4", "Camry"]`
    - These rules must pass for `["manufacturer": "Ford", "model": "not real"]`
      - model must be in `["F150", "Bronco"]`
  - Only one of these rules must pass for `["manufacturer": "Honda", "model": "not valid"]`
    - These rules must pass for `["manufacturer": "Honda", "model": "not valid"]`
      - model must be in `["Accord", "Fit"]`
    - All of the required rules must pass for `["manufacturer": "Honda", "model": "not valid"]`
      - manufacturer must be equal to "Toyota"
      - model must be in `["Rav4", "Camry"]`
    - All of the required rules must pass for `["manufacturer": "Honda", "model": "not valid"]`
      - manufacturer must be equal to "Ford"
      - model must be in `["F150", "Bronco"]`
[
    'each' => [
        '__root__' => 'Each item in `[["manufacturer": "Honda", "model": "Accord"], ["manufacturer": "Toyota", "model": "Rav4"], ["manufacturer": "Fo ... ]` must be valid',
        'oneOf.3' => [
            '__root__' => 'Only one of these rules must pass for `["manufacturer": "Ford", "model": "not real"]`',
            'allOf.1' => [
                '__root__' => 'All of the required rules must pass for `["manufacturer": "Ford", "model": "not real"]`',
                'manufacturer' => 'manufacturer must be equal to "Honda"',
                'model' => 'model must be in `["Accord", "Fit"]`',
            ],
            'allOf.2' => [
                '__root__' => 'All of the required rules must pass for `["manufacturer": "Ford", "model": "not real"]`',
                'manufacturer' => 'manufacturer must be equal to "Toyota"',
                'model' => 'model must be in `["Rav4", "Camry"]`',
            ],
            'allOf.3' => 'model must be in `["F150", "Bronco"]`',
        ],
        'oneOf.4' => [
            '__root__' => 'Only one of these rules must pass for `["manufacturer": "Honda", "model": "not valid"]`',
            'allOf.1' => 'model must be in `["Accord", "Fit"]`',
            'allOf.2' => [
                '__root__' => 'All of the required rules must pass for `["manufacturer": "Honda", "model": "not valid"]`',
                'manufacturer' => 'manufacturer must be equal to "Toyota"',
                'model' => 'model must be in `["Rav4", "Camry"]`',
            ],
            'allOf.3' => [
                '__root__' => 'All of the required rules must pass for `["manufacturer": "Honda", "model": "not valid"]`',
                'manufacturer' => 'manufacturer must be equal to "Ford"',
                'model' => 'model must be in `["F150", "Bronco"]`',
            ],
        ],
    ],
]
