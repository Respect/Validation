--SKIPIF--
<?php
if (!extension_loaded('uopz')) {
    echo 'skip: Extension "uopz" is required to test "Uploaded" rule';
}
?>
--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\UploadedException;
use Respect\Validation\Validator as v;

uopz_set_return('is_uploaded_file', false);
try {
    v::uploaded()->check('filename');
} catch (UploadedException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

uopz_set_return('is_uploaded_file', true);
try {
    v::not(v::uploaded())->check('filename');
} catch (UploadedException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

uopz_set_return('is_uploaded_file', false);
try {
    v::uploaded()->assert('filename');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

uopz_set_return('is_uploaded_file', true);
try {
    v::not(v::uploaded())->assert('filename');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"filename" must be an uploaded file
"filename" must not be an uploaded file
- "filename" must be an uploaded file
- "filename" must not be an uploaded file
