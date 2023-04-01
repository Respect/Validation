--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$work = new stdClass();
$work->number = '+61.(03) 4546 5498';
$work->countryCode = 61;
$work->primary = true;

$personal = new stdClass();
$personal->number = '123';
$personal->country = 61;
$personal->primary = false;

$phoneNumbers = new stdClass();
$phoneNumbers->personal = $personal;
$phoneNumbers->work = $work;

$validateThis = ['phoneNumbers' => $phoneNumbers];

exceptionMessage(static function () use ($validateThis) {
    v::create()
        ->keyNested('phoneNumbers.personal.country', v::intType(), false)
        ->keyNested('phoneNumbers.personal.number', v::phone(), false)
        ->keyNested('phoneNumbers.personal.primary', v::boolType(), false)
        ->keyNested('phoneNumbers.work.country', v::intType(), false)
        ->keyNested('phoneNumbers.work.number', v::phone(), false)
        ->keyNested('phoneNumbers.work.primary', v::boolType(), false)
        ->check($validateThis);
});
?>
--EXPECT--
phoneNumbers.personal.number must be a valid telephone number
