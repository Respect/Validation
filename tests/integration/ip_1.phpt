--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Rules\Ip;

$ip = new Ip();

var_dump(
    $ip->validate('10.0.0.1'),
    $ip->validate('192.168.1.150'),
    $ip->assert('127.0.0.1'),
    $ip->validate('10,0.0.1'),
    $ip->validate(null)
);

?>
--EXPECTF--
bool(true)
bool(true)
bool(true)
bool(false)
bool(false)