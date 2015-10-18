--FILE--
<?php

require_once 'vendor/autoload.php';

use malkusch\bav\ConfigurationRegistry;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

ConfigurationRegistry::getConfiguration()->setUpdatePlan(null);

try
{
    v::bank('de')->assert('test');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}

--EXPECTF--;
\-"test" must be a german bank
