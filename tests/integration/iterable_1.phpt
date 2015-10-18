--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::iterable()->assert(array(1, 2, 3));
v::iterable()->check(array(1, 2, 3));

v::iterable()->assert(new ArrayObject);
v::iterable()->check(new ArrayObject);
?>
--EXPECTF--