--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

if (v::alnum()->notEmpty()->validate('')) {
    echo 'error';
}

?>
--EXPECTF--