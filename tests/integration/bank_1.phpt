--FILE--
<?php

require_once 'vendor/autoload.php';

use malkusch\bav\ConfigurationRegistry;
use Respect\Validation\Validator as v;

ConfigurationRegistry::getConfiguration()->setUpdatePlan(null);

v::bank('de')->check('70169464');
v::bank('de')->assert('70169464');

--EXPECTF--;
