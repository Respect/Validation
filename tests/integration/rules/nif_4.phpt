--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Julián Gutiérrez <juliangut@gmail.com>
--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NifException;
use Respect\Validation\Validator as v;

try {
    v::not(v::nif())->check('71110316C');
} catch (NifException $e) {
    echo $e->getMessage();
}
?>
--EXPECTF--
"71110316C" must not be a NIF
