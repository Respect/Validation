--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NotBlankException;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::notBlank()->check(null);
} catch (NotBlankException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::notBlank()->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
null must not be blank
\-"" must not be blank
