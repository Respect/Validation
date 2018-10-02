--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\VersionException;
use Respect\Validation\Validator as v;

try {
    v::version()->check('1.3.7--');
} catch (VersionException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    V::not(v::version())->check('1.0.0-alpha');
} catch (VersionException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::version()->assert('1.2.3.4-beta');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::version())->assert('1.3.7-rc.1');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"1.3.7--" must be a version
"1.0.0-alpha" must not be a version
- "1.2.3.4-beta" must be a version
- "1.3.7-rc.1" must not be a version
