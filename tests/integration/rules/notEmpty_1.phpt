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
    v::notEmpty()->assert($value);
    v::notEmpty()->check($value);
}

//Check a not empty array
v::notEmpty()->assert([1]);
v::notEmpty()->check([1]);

?>
--EXPECTF--