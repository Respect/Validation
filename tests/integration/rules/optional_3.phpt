--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\OptionalException;
use Respect\Validation\Validator as v;

try {
    v::not(v::optional(v::equals('foo'))->setName('My field'))->check(null);
} catch (OptionalException $e) {
    echo $e->getMessage().PHP_EOL;
}
?>
--EXPECT--
My field must not be optional
