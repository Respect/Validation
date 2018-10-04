--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\VideoUrlException;
use Respect\Validation\Validator as v;

try {
    v::videoUrl()->check('example.com');
} catch (VideoUrlException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::videoUrl('youtube')->check('example.com');
} catch (VideoUrlException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::videoUrl())->check('https://player.vimeo.com/video/71787467');
} catch (VideoUrlException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::videoUrl('youtube'))->check('https://www.youtube.com/embed/netHLn9TScY');
} catch (VideoUrlException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::videoUrl()->assert('example.com');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::videoUrl('vimeo')->assert('example.com');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::videoUrl())->assert('https://youtu.be/netHLn9TScY');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::videoUrl('vimeo'))->assert('https://vimeo.com/71787467');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"example.com" must be a valid video URL
"example.com" must be a valid "youtube" video URL
"https://player.vimeo.com/video/71787467" must not be a valid video URL
"https://www.youtube.com/embed/netHLn9TScY" must not be a valid "youtube" video URL
- "example.com" must be a valid video URL
- "example.com" must be a valid "vimeo" video URL
- "https://youtu.be/netHLn9TScY" must not be a valid video URL
- "https://vimeo.com/71787467" must not be a valid "vimeo" video URL
