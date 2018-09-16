--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\MacAddressException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::macAddress()->check('00-11222:33:44:55');
} catch (MacAddressException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::macAddress())->check('00:11:22:33:44:55');
} catch (MacAddressException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::macAddress()->assert('90-bc-nk:1a-dd-cc');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::macAddress())->assert('AF:0F:bd:12:44:ba');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"00-11222:33:44:55" must be a valid MAC address
"00:11:22:33:44:55" must not be a valid MAC address
- "90-bc-nk:1a-dd-cc" must be a valid MAC address
- "AF:0F:bd:12:44:ba" must not be a valid MAC address
