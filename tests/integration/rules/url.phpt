--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\UrlException;
use Respect\Validation\Validator as v;

try {
    v::url()->check('example.com');
} catch (UrlException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::url())->check('http://example.com');
} catch (UrlException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::url()->assert('example.com');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::url())->assert('http://example.com');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"example.com" must be a URL
"http://example.com" must not be a URL
- "example.com" must be a URL
- "http://example.com" must not be a URL
