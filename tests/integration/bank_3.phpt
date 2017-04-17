--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try
{
    v::bank('de')->assert('test');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}

--EXPECTF--;
\-"test" must be a german bank