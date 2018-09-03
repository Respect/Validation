--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

if (!v::alnum('-')->isValid('bla - bla')) {
    echo 'ok';
}

?>
--EXPECTF--