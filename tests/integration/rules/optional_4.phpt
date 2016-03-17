--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::optional(v::alpha())->validate('');
v::optional(v::alpha())->validate(null);

?>
--EXPECTF--