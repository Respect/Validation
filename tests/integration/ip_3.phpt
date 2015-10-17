--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\IpException;

try {
    v::ip()->check('foo');
} catch (IpException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"foo" must be an IP address