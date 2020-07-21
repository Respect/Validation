--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::domain()->check('batman');
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::domain())->check('r--w.com');
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::domain()->assert('p-éz-.kk');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::domain())->assert('github.com');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"batman" must contain the value "."
"r--w.com" must not be a valid domain
- "p-éz-.kk" must be a valid domain
  - "kk" must be a valid top-level domain name
  - "p-éz-" must contain only letters (a-z), digits (0-9) and "-"
  - "p-éz-" must not end with "-"
- "github.com" must not be a valid domain
