--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\UrlException;
use Respect\Validation\Validator as v;

try {
    v::url()->check('example.com');
} catch (UrlException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::url())->check('http://example.com');
} catch (UrlException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::url()->assert('example.com');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::url())->assert('http://example.com');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
"example.com" must be a URL
"http://example.com" must not be a URL
- "example.com" must be a URL
- "http://example.com" must not be a URL
