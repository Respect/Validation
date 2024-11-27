--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessages(static function (): void {
    v::key('email', v::email()->setTemplate('WRONG EMAIL!!!!!!'))->assert(['email' => 'qwe']);
});
?>
--EXPECT--
[
    'email' => 'WRONG EMAIL!!!!!!',
]
