--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::ip()->assert('192.168.1.150');
v::ip()->check('10.0.0.1');
v::ip('192.168.0.0-192.168.255.255')->check('192.168.2.6');
?>
--EXPECTF--
