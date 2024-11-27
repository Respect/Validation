--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::videoUrl()->assert('example.com'));
exceptionMessage(static fn() => v::videoUrl('YouTube')->assert('example.com'));
exceptionMessage(static fn() => v::not(v::videoUrl())->assert('https://player.vimeo.com/video/7178746722'));
exceptionMessage(static fn() => v::not(v::videoUrl('YouTube'))->assert('https://www.youtube.com/embed/netHLn9TScY'));
exceptionFullMessage(static fn() => v::videoUrl()->assert('example.com'));
exceptionFullMessage(static fn() => v::videoUrl('Vimeo')->assert('example.com'));
exceptionFullMessage(static fn() => v::not(v::videoUrl())->assert('https://youtu.be/netHLn9TScY'));
exceptionFullMessage(static fn() => v::not(v::videoUrl('Vimeo'))->assert('https://vimeo.com/71787467'));
?>
--EXPECT--
"example.com" must be a valid video URL
"example.com" must be a valid YouTube video URL
"https://player.vimeo.com/video/7178746722" must not be a valid video URL
"https://www.youtube.com/embed/netHLn9TScY" must not be a valid YouTube video URL
- "example.com" must be a valid video URL
- "example.com" must be a valid Vimeo video URL
- "https://youtu.be/netHLn9TScY" must not be a valid video URL
- "https://vimeo.com/71787467" must not be a valid Vimeo video URL
