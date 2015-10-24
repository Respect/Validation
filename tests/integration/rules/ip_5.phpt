--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\IpException;
use Respect\Validation\Validator as v;

try {
    v::ip('127.0.1.*')->check('127.0.0.1');
} catch (IpException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::ip('127.0.1.*')->assert('127.0.0.1');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"127.0.0.1" must be an IP address in the "127.0.1.0-127.0.1.255" range
- "127.0.0.1" must be an IP address in the "127.0.1.0-127.0.1.255" range