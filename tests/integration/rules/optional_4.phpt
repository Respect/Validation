--CREDITS--
Rafael Bartalotti <rafael_bartalotti@hotmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::optional(v::alpha())->validate('');
v::optional(v::alpha())->validate(null);

?>
--EXPECT--
