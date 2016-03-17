--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::image()->assert('tests/fixtures/valid-image.png');
v::image()->check(new SplFileInfo('tests/fixtures/valid-image.gif'));
?>
--EXPECTF--
