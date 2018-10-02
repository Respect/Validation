--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IsbnException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::isbn()->check('ISBN-12: 978-0-596-52068-7');
} catch (IsbnException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::isbn())->check('ISBN-13: 978-0-596-52068-7');
} catch (IsbnException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::isbn()->assert('978 10 596 52068 7');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::isbn())->assert('978 0 596 52068 7');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"ISBN-12: 978-0-596-52068-7" must be a ISBN
"ISBN-13: 978-0-596-52068-7" must not be a ISBN
- "978 10 596 52068 7" must be a ISBN
- "978 0 596 52068 7" must not be a ISBN
