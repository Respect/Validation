--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\IpException;

try {
    v::not(v::ip())->check('10.0.0.1');
} catch (IpException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"10.0.0.1" must not be an IP address