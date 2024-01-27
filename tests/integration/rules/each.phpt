--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::each(v::dateTime())->check(null));
exceptionMessage(static fn() => v::not(v::each(v::dateTime()))->check(['2018-10-10']));
exceptionFullMessage(static fn() => v::each(v::dateTime())->assert(null));
exceptionFullMessage(static fn() => v::not(v::each(v::dateTime()))->assert(['2018-10-10']));
?>
--EXPECT--
Each item in `NULL` must be valid
Each item in `{ "2018-10-10" }` must not validate
- Each item in `NULL` must be valid
- Each item in `{ "2018-10-10" }` must not validate
