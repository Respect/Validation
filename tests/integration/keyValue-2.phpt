--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\EqualsException;

$data = array(
	'password' => 'shuberry',
	'password_confirmation' => '_shuberry_'
);

try {
	v::keyValue('password', 'equals', 'password_confirmation')->check($data);
} catch (EqualsException $e) {
	echo $e->getMainMessage();
}
?>
--EXPECTF--
password must be equals "password_confirmation"
