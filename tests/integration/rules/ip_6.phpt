--CREDITS--
Emmerson Siqueira <emmersonsiqueira@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rules\Ip;

try {
    $ip = new Ip('192.168');
} catch (ComponentException $e) {
    echo $e->getMessage();
}
?>
--EXPECTF--
Invalid network range