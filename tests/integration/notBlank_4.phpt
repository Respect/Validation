--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NotBlankException;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::not(v::notBlank())->check(1);
} catch (NotBlankException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::not(v::notBlank())->assert(array(1));
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
1 must be blank
\-{ 1 } must be blank
