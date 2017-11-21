--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::cpf()->assert('68786265440');
v::cpf()->assertAll('485.764.121-60');
?>
--EXPECTF--
