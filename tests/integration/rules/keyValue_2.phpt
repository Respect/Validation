--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
Ian Nisbet <ian@glutenite.co.uk>
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
    echo $e->getMessage();
}
?>
--EXPECT--
password must equal "password_confirmation"
