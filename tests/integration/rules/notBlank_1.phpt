--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$notBlankValues = [
    'a',
    1,
    1.0,
];

//Check the "pure" value
foreach ($notBlankValues as $value) {
    v::notBlank()->assert($value);
    v::notBlank()->check($value);
}

//Check the value inside an array
foreach ($notBlankValues as $value) {
    v::notBlank()->assert([$value]);
    v::notBlank()->check([$value]);
}

//Check the value inside an object
foreach ($notBlankValues as $value) {
    $obj = new stdClass();
    $obj->testProp = $value;

    v::notBlank()->assert($obj);
    v::notBlank()->check($obj);
}

?>
--EXPECTF--