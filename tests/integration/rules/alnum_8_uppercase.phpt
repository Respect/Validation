--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

if (!v::alnum()->uppercase()->validate('ASDF')) {
    echo 'ok';
}

?>
--EXPECTF--