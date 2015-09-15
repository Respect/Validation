# Video

- `v::video()`

Validates if the input is a video value:

```php
v::video()->validate('https://www.youtube.com/watch?v=netHLn9TScY'); //true
v::video()->validate('https://youtu.be/netHLn9TScY'); //true
v::video()->validate('https://www.youtube.com/embed/netHLn9TScY'); //true
v::video()->validate('https://vimeo.com/71787467'); //true
v::video()->validate('https://player.vimeo.com/video/71787467'); //true
```