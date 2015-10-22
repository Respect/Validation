--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::cpf()->check('68786265440');
v::cpf()->assert('485.764.121-60');
?>
--EXPECTF--
