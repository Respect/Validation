--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NotBlankException;
use Respect\Validation\Validator as v;

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
The value must not be blank
- The value must not be blank
