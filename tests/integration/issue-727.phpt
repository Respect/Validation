--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\PhoneException;
use Respect\Validation\Validator as v;

$work = new stdClass();
$work->number = "+61.(03) 4546 5498";
$work->countryCode = 61;
$work->primary = true;

$personal = new stdClass();
$personal->number = "+61.0406 464 890";
$personal->country = 61;
$personal->primary = false;

$phoneNumbers = new stdClass();
$phoneNumbers->personal = $personal;
$phoneNumbers->work = $work;

$validateThis = ['phoneNumbers' => $phoneNumbers];

try {
    v::create()
        ->keyNested('phoneNumbers.personal.country', v::intType(), false)
        ->keyNested('phoneNumbers.personal.number', v::phone(), false)
        ->keyNested('phoneNumbers.personal.primary', v::boolType(), false)
        ->keyNested('phoneNumbers.work.country', v::intType(), false)
        ->keyNested('phoneNumbers.work.number', v::phone(), false)
        ->keyNested('phoneNumbers.work.primary', v::boolType(), false)
        ->check($validateThis);

} catch (PhoneException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
phoneNumbers.personal.number must be a valid telephone number
