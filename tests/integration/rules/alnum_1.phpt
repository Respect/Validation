--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::alnum()->assert('Bla 123');
v::alnum()->check('Bla 123');
?>
--EXPECTF--