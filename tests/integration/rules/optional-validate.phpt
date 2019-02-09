--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

var_dump(v::alpha()->validate(''));
var_dump(v::alpha()->validate(null));

var_dump(v::optional(v::alpha())->validate(''));
var_dump(v::optional(v::alpha())->validate(null));
?>
--EXPECT--
bool(false)
bool(false)
bool(true)
bool(true)
