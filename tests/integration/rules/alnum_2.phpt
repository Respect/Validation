--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AlnumException;
use Respect\Validation\Validator as v;

try {
    v::alnum()->check('Bla %123');
} catch (AlnumException $exception) {
    echo $exception->getMainMessage();
}

?>
--EXPECTF--
"Bla %123" must contain only letters (a-z) and digits (0-9)