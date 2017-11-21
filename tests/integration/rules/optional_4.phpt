--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::optional(v::alpha())->isValid('');
v::optional(v::alpha())->isValid(null);

?>
--EXPECTF--