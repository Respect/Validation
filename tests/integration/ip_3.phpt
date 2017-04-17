--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\IpException;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::ip()->check('foo');
} catch (IpException $e) {
    echo $e->getMainMessage() . PHP_EOL;
}

try {
    v::ip()->assert('foo');
} catch (AllOfException $e) {
    echo $e->getFullMessage() . PHP_EOL;
}
?>
--EXPECTF--
"foo" must be an IP address
\-"foo" must be an IP address