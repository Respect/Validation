--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

if (!v::alnum('-')->validate('bla - bla')) {
    echo 'ok';
}

?>
--EXPECTF--