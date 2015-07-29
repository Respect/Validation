--TEST--
findMessages() should return composite validation messages flattened
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationExceptionInterface;
use Respect\Validation\Validator as v;

$stringMax256 = v::string()->length(5, 256);
$alnumDot = v::alnum('.');
$stringMin8 = v::string()->length(8, null);
$validator = v::allOf(
    v::attribute('first_name', $stringMax256)->setName('First Name'),
    v::attribute('last_name', $stringMax256)->setName('Last Name'),
    v::attribute('desired_login', $alnumDot)->setName('Desired Login'),
    v::attribute('password', $stringMin8)->setName('Password'),
    v::attribute('password_confirmation', $stringMin8)->setName('Password Confirmation'),
    v::attribute('stay_signedin', v::notEmpty())->setName('Stay signed in'),
    v::attribute('enable_webhistory', v::notEmpty())->setName('Enabled Web History'),
    v::attribute('security_question', $stringMax256)->setName('Security Question')
)->setName('Validation Form');
try {
    $validator->assert(
        (object) array(
            'first_name' => 'fiif',
            'last_name' => null,
            'desired_login' => null,
            'password' => null,
            'password_confirmation' => null,
            'stay_signedin' => null,
            'enable_webhistory' => null,
            'security_question' => null,
        )
    );
} catch (NestedValidationExceptionInterface $e) {
    print_r($e->findMessages(array('allOf', 'first_name.length')));
}
?>
--EXPECTF--
Array
(
    [allOf] => These rules must pass for Validation Form
    [first_name_length] => security_question must have a length between 5 and 256
)
