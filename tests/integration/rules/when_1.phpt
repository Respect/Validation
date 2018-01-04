--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Rules\Between;
use Respect\Validation\Rules\IntVal;
use Respect\Validation\Rules\NotEmpty;
use Respect\Validation\Validator as v;

var_dump(
    v::when(new IntVal(), new Between(1, 5), new NotEmpty())->isValid(3),
    v::when(new IntVal(), new Between(1, 5), new NotEmpty())->isValid('aaa'),
    v::when(new IntVal(), new Between(1, 5))->isValid(3),
    v::when(new IntVal(), new Between(1, 5), new NotEmpty())->isValid(''),
    v::when(new IntVal(), new Between(1, 5))->isValid(15)
);

?>
--EXPECTF--
bool(true)
bool(true)
bool(true)
bool(false)
bool(false)