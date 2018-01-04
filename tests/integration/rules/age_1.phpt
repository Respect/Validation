--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::age(18)->assertAll('18 years ago');
v::age(18)->assert('18 years ago');
?>
--EXPECTF--
