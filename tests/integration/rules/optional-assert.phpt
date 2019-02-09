--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::optional(v::alpha())->assert('');
v::optional(v::alpha())->assert(null);
?>
===DONE===
--EXPECT--
===DONE===
