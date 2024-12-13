--FILE--
<?php

use Respect\Validation\Rules\Core\Simple;

require 'vendor/autoload.php';

exceptionAll('https://github.com/Respect/Validation/issues/1477', static function (): void {
    v::key(
        'Address',
        (new class extends Simple {
            protected function isValid(mixed $input): bool
            {
                return false;
            }
        })->setTemplate('{{name}} is not good!')
    )->assert(['Address' => 'cvejvn']);
});

?>
--EXPECT--
https://github.com/Respect/Validation/issues/1477
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Address is not good!
- Address is not good!
[
    'Address' => 'Address is not good!',
]
