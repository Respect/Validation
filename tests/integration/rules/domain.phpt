--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::domain()->check('batman'));
exceptionMessage(static fn() => v::not(v::domain())->check('r--w.com'));
exceptionFullMessage(static fn() => v::domain()->assert('p-éz-.kk'));
exceptionFullMessage(static fn() => v::not(v::domain())->assert('github.com'));
?>
--EXPECT--
"batman" must contain the value "."
"r--w.com" must not be a valid domain
- "p-éz-.kk" must be a valid domain
  - "kk" must be a valid top-level domain name
  - "p-éz-" must contain only letters (a-z), digits (0-9) and "-"
  - "p-éz-" must not end with "-"
- "github.com" must not be a valid domain
