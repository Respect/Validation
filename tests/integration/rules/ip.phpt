--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\IpException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::ip('127.0.1.*')->check('127.0.0.1');
} catch (IpException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::not(v::ip('127.0.1.*'))->check('127.0.1.1');
} catch (IpException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::ip('127.0.1.*')->assert('127.0.0.1');
} catch (NestedValidationException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

try {
    v::not(v::ip('127.0.1.*'))->assert('127.0.1.1');
} catch (NestedValidationException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

try {
    v::ip('192.168');
} catch (ComponentException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::ip('192.168.0.1/32');
} catch (ComponentException $e) {
    echo $e->getMessage().PHP_EOL;
}
?>
--EXPECTF--
"127.0.0.1" must be an IP address in the "127.0.1.0-127.0.1.255" range
"127.0.1.1" must not be an IP address in the "127.0.1.0-127.0.1.255" range
- "127.0.0.1" must be an IP address in the "127.0.1.0-127.0.1.255" range
- "127.0.1.1" must not be an IP address in the "127.0.1.0-127.0.1.255" range
Invalid network range
Invalid network mask
