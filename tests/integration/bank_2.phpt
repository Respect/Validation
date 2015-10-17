--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\BankException;

try
{
    v::bank('de')->check('wrong bank');
} catch (BankException $e) {
    echo $e->getMainMessage();
}

--EXPECTF--;
"wrong bank" must be a german bank