--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Rules\Ip;

$ip = new Ip();

var_dump(
    $ip->isValid('10.0.0.1'),
    $ip->isValid('192.168.1.150'),
    $ip->isValid('127.0.0.1'),
    $ip->isValid('10,0.0.1'),
    $ip->isValid(null)
);

?>
--EXPECTF--
bool(true)
bool(true)
bool(true)
bool(false)
bool(false)
