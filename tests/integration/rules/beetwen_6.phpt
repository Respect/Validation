--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionFullMessage(static fn() => v::not(v::intType()->between(1, 42))->assert(41));
?>
--EXPECT--
- 41 must not be between 1 and 42
