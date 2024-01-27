--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionFullMessage(static fn() => v::not(v::between('a', 'b'))->assert('a'));
?>
--EXPECT--
- "a" must not be between "a" and "b"
