--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$data = [
    'password' => 'shuberry',
    'password_confirmation' => 'shuberry',
    'valid_passwords' => ['shuberry', 'monty-python'],
];

v::keyValue('password', 'equals', 'password_confirmation')->check($data);
v::keyValue('password', 'in', 'valid_passwords')->assert($data);
?>
--EXPECT--
