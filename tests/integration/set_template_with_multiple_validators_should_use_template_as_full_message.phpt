--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator;

exceptionFullMessage(static function (): void {
    Validator::callback('is_string')->between(1, 2)->setTemplate('{{name}} is not tasty')->assert('something');
});
?>
--EXPECT--
- "something" is not tasty
