--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$validator = v::length(0, 10);

$validator->validate('phpsp');
v::not($validator)->validate('phpsp');
$validator->assert('nickolas');
$validator->check('nawarian');
?>
--EXPECTF--