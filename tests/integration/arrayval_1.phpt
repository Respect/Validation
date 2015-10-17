--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::arrayval()->assert(array('asdf', 'lkjh'));
v::arrayval()->check(array(2, 3));
?>
--EXPECTF--