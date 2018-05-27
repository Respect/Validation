--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\PhoneException;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;



$data = [
    'firstname' => 'charles',
    'age' => -8,
    'colour' => "",
];


$rules = v::key('firstname', v::notEmpty()->alnum())->
        key('age', v::intVal()->odd()->positive())->
        key('colour', v::notEmpty()) ;

try {
    $rules->assert($data);
}
catch (NestedValidationException $e) {
    print_r( $e->getMessagesIndexedByName());
}
?>
--EXPECTF--
Array
(
    [age] => Array
        (
            [0] => age must be an odd number
            [1] => age must be positive
        )

    [colour] => Array
        (
            [0] => colour must not be empty
        )

)