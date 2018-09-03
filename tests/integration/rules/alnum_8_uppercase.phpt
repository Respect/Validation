--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

if (!v::alnum()->uppercase()->isValid('ASDF')) {
    echo 'ok';
}

?>
--EXPECTF--