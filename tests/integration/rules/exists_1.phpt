--FILE--
<?php
require 'vendor/autoload.php';

use org\bovigo\vfs\content\LargeFileContent;
use org\bovigo\vfs\vfsStream;
use Respect\Validation\Validator as v;

$root = vfsStream::setup();

$file = vfsStream::newFile('2kb.txt')->withContent(LargeFileContent::withKilobytes(2))->at($root);
v::exists()->check($file->url());

$splFile = new SplFileInfo($file->url());
v::exists()->assert($splFile);
?>
--EXPECTF--
