--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessages(static function (): void {
    v::key('email', v::email()->setTemplate('WRONG EMAIL!!!!!!'))->assert(['email' => 'qwe']);
});
?>
--EXPECT--
[
    'email' => 'WRONG EMAIL!!!!!!',
]
