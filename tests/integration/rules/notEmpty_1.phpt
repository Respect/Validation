--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$notEmptyValues = [
    'a',
    1,
    1.0,
];

//Check not empty values
foreach ($notEmptyValues as $value) {
    v::notEmpty()->assertAll($value);
    v::notEmpty()->assert($value);
}

//Check a not empty array
v::notEmpty()->assertAll([1]);
v::notEmpty()->assert([1]);

?>
--EXPECTF--