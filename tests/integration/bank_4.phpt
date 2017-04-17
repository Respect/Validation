--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\BankException;

try
{
    v::not(v::bank('de'))->check('70169464');
} catch (BankException $e) {
    echo $e->getMainMessage();
}

--EXPECTF--;
"70169464" must not be a bank