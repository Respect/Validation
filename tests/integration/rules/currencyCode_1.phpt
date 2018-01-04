--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::currencyCode()->assertAll('usd');
v::currencyCode()->assert('BRL');
?>
--EXPECTF--
