--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NotBlankException;
use Respect\Validation\Validator as v;

try {
    v::notBlank()->setName('Field')->check(null);
} catch (NotBlankException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::notBlank()->setName('Field')->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
Field must not be blank
- Field must not be blank
