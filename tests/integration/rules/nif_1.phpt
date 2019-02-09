--CREDITS--
Julián Gutiérrez <juliangut@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::nif()->check('43333207B');
?>
--EXPECT--
