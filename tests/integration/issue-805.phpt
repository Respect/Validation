--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Wojciech Frącz <fraczwojciech@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::key('email', v::email()->setTemplate('WRONG EMAIL!!!!!!'))->assert(['email' => 'qwe']);
} catch (NestedValidationException $exception) {
    print_r($exception->getMessages());
}
?>
--EXPECT--
Array
(
    [email] => WRONG EMAIL!!!!!!
)
