--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::when(v::alwaysInvalid(), v::alwaysValid())->check('foo'));
?>
--EXPECT--
"foo" is not valid
