--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$validator = v::length(0, 10);

$validator->isValid('phpsp');
v::not($validator)->isValid('phpsp');
$validator->assert('nickolas');
$validator->check('nawarian');
?>
--EXPECTF--