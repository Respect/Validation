--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::currencyCode()->assert('usd');
v::currencyCode()->check('BRL');
?>
--EXPECTF--
