--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::consonant()->check('bcd');
v::consonant()->assert('ddd');
v::not(v::consonant())->check('uou');
v::not(v::consonant())->assert('aaaaa');
?>
--EXPECT--
