--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::countryCode()->assertAll('BR');
v::countryCode()->assertAll('DE');
v::countryCode()->assert('BR');
v::countryCode()->assert('DE');
?>
--EXPECTF--
