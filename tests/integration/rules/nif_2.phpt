--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Julián Gutiérrez <juliangut@gmail.com>
--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NifException;
use Respect\Validation\Validator as v;

try {
    v::nif()->check('06357771Q');
} catch (NifException $e) {
    echo $e->getMessage();
}
?>
--EXPECTF--
"06357771Q" must be a NIF
