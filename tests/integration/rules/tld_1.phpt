--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::tld()->assertAll('com');
v::tld()->assert('br');
?>
--EXPECTF--
