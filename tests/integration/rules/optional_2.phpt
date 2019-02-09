--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\OptionalException;
use Respect\Validation\Validator as v;

try {
    v::not(v::optional(v::equals('foo')))->check(null);
} catch (OptionalException $e) {
    echo $e->getMessage().PHP_EOL;
}
?>
--EXPECT--
The value must not be optional
