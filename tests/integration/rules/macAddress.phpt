--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::macAddress()->check('00-11222:33:44:55'));
exceptionMessage(static fn() => v::not(v::macAddress())->check('00:11:22:33:44:55'));
exceptionFullMessage(static fn() => v::macAddress()->assert('90-bc-nk:1a-dd-cc'));
exceptionFullMessage(static fn() => v::not(v::macAddress())->assert('AF:0F:bd:12:44:ba'));
?>
--EXPECT--
"00-11222:33:44:55" must be a valid MAC address
"00:11:22:33:44:55" must not be a valid MAC address
- "90-bc-nk:1a-dd-cc" must be a valid MAC address
- "AF:0F:bd:12:44:ba" must not be a valid MAC address
