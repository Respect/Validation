--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\CnpjException;
use Respect\Validation\Validator as v;

try {
    v::cnpj()->check('não cnpj');
} catch (CnpjException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--;
"não cnpj" must be a valid CNPJ number
