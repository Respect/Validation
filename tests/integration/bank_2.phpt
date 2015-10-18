--FILE--
<?php

require_once 'vendor/autoload.php';

use malkusch\bav\ConfigurationRegistry;
use Respect\Validation\Exceptions\BankException;
use Respect\Validation\Validator as v;

ConfigurationRegistry::getConfiguration()->setUpdatePlan(null);

try
{
    v::bank('de')->check('wrong bank');
} catch (BankException $e) {
    echo $e->getMainMessage();
}

--EXPECTF--;
"wrong bank" must be a german bank
