--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

var_dump(
    v::alpha()->validate(''),
    v::alpha()->validate(null),
    v::optional(v::alpha())->validate(''),
    v::optional(v::alpha())->validate(null)
);
?>
--EXPECT--
bool(false)
bool(false)
bool(true)
bool(true)
