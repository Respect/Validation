--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\PeselException;
use Respect\Validation\Validator as v;

try {
    v::pesel()->check('21120209251');
} catch (PeselException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--;
"21120209251" must be a valid PESEL
