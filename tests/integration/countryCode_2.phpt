--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::countryCode()->assert('BR');
v::countryCode()->assert('DE');
v::countryCode()->check('BR');
v::countryCode()->check('DE');
?>
--EXPECTF--
