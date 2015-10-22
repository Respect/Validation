--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

$data = array(
	'password' => '123',
	'invalid_passwords' => array('123', 'secreta')
);

try {
	v::not(v::keyValue('password', 'in', 'invalid_passwords'))->assert($data);
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}
--EXPECTF--
- Key { "password": "123", "invalid_passwords": { "123", "secreta" } } must not be present
