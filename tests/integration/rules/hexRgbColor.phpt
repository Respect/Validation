--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::hexRgbColor()->check('invalid'));
exceptionMessage(static fn() => v::not(v::hexRgbColor())->check('#808080'));
exceptionFullMessage(static fn() => v::hexRgbColor()->assert('invalid'));
exceptionFullMessage(static fn() => v::not(v::hexRgbColor())->assert('#808080'));
?>
--EXPECT--
"invalid" must be a hex RGB color
"#808080" must not be a hex RGB color
- "invalid" must be a hex RGB color
- "#808080" must not be a hex RGB color
