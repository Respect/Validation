--FILE--
<?php
require 'vendor/autoload.php';

use org\bovigo\vfs\content\LargeFileContent;
use org\bovigo\vfs\vfsStream;
use Respect\Validation\Exceptions\ExistsException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$root = vfsStream::setup();

$file = vfsStream::newFile('2kb.txt')->withContent(LargeFileContent::withKilobytes(2))->at($root);

try {
    v::exists()->check('/path/of/a/non-existent/file');
} catch (ExistsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::exists())->check($file->url());
} catch (ExistsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::exists()->assert('/path/of/a/non-existent/file');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::exists())->assert($file->url());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"/path/of/a/non-existent/file" must exists
"vfs://root/2kb.txt" must not exists
- "/path/of/a/non-existent/file" must exists
- "vfs://root/2kb.txt" must not exists
