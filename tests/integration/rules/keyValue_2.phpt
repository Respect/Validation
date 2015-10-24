--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EqualsException;
use Respect\Validation\Validator as v;

$data = [
    'password' => 'shuberry',
    'password_confirmation' => '_shuberry_',
];

try {
    v::keyValue('password', 'equals', 'password_confirmation')->check($data);
} catch (EqualsException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
password must be equals "password_confirmation"
