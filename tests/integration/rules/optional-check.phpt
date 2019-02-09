--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::optional(v::alpha())->check('');
v::optional(v::alpha())->check(null);
?>
===DONE===
--EXPECT--
===DONE===
