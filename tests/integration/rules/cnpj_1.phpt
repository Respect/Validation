--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::cnpj()->check('53969447000130');
v::cnpj()->assert('53969447000130');
?>
--EXPECTF--;
