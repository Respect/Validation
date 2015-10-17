--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AlnumException;

try {
    v::not(v::alnum())->check('adsfASDF123');
} catch (AlnumException $exception) {
    echo $exception->getMainMessage();
}

?>
--EXPECTF--
"adsfASDF123" must not contain letters (a-z) or digits (0-9)