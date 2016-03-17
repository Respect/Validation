--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::tld()->assert('com');
v::tld()->check('br');
?>
--EXPECTF--
