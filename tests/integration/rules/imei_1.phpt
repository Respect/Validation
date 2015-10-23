--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Rules\Imei;

$imei = new Imei();

var_dump(
    $imei->validate('490154203237518'),
    $imei->validate('490154203237512'),
    $imei->assert('490154203237518'),
    $imei->validate(null)
);

?>
--EXPECTF--
bool(true)
bool(false)
bool(true)
bool(false)