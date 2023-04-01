--CREDITS--
Moritz Fromm <moritzgitfromm@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::isbn()->check('ISBN-12: 978-0-596-52068-7'));
exceptionMessage(static fn() => v::not(v::isbn())->check('ISBN-13: 978-0-596-52068-7'));
exceptionFullMessage(static fn() => v::isbn()->assert('978 10 596 52068 7'));
exceptionFullMessage(static fn() => v::not(v::isbn())->assert('978 0 596 52068 7'));
?>
--EXPECT--
"ISBN-12: 978-0-596-52068-7" must be a ISBN
"ISBN-13: 978-0-596-52068-7" must not be a ISBN
- "978 10 596 52068 7" must be a ISBN
- "978 0 596 52068 7" must not be a ISBN
