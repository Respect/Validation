--FILE--
<?php
require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use Respect\Validation\Validator as v;

v::MinimumAge(12)->assert(new DateTime('1999-10-12'));
v::MinimumAge(12)->check(new DateTime('1999-10-12'));

?>
--EXPECTF--
