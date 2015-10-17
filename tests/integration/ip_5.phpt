--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\IpException;

try {
    v::ip('127.0.1.*')->check('127.0.0.1');
} catch (IpException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"127.0.0.1" must be an IP address in the "127.0.1.0-127.0.1.255" range