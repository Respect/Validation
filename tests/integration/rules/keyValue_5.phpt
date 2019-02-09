--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

$data = [
    'password' => '123',
    'invalid_passwords' => ['123', 'secreta'],
];

try {
    v::not(v::keyValue('password', 'in', 'invalid_passwords'))->assert($data);
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECT--
- Key `{ "password": "123", "invalid_passwords": { "123", "secreta" } }` must not be present
