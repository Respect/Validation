--CREDITS--
Emmerson Siqueira <emmersonsiqueira@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\IpException;
use Respect\Validation\Validator as v;

try {
    v::not(v::ip())->check('10.0.0.1');
} catch (IpException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::not(v::ip())->assert('10.0.0.1');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"10.0.0.1" must not be an IP address
- "10.0.0.1" must not be an IP address