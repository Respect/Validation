--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\CnpjException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::cnpj()->check('não cnpj');
} catch (CnpjException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::cnpj())->check('65.150.175/0001-20');
} catch (CnpjException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::cnpj()->assert('test');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::cnpj())->assert('65.150.175/0001-20');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"não cnpj" must be a valid CNPJ number
"65.150.175/0001-20" must not be a valid CNPJ number
- "test" must be a valid CNPJ number
- "65.150.175/0001-20" must not be a valid CNPJ number
