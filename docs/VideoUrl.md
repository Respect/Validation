# VideoUrl

- `VideoUrl()`
- `VideoUrl(string $service)`

Validates if the input is a video URL value:

```php
v::videoUrl()->validate('https://player.vimeo.com/video/71787467'); // true
v::videoUrl()->validate('https://vimeo.com/71787467'); // true
v::videoUrl()->validate('https://www.youtube.com/embed/netHLn9TScY'); // true
v::videoUrl()->validate('https://www.youtube.com/watch?v=netHLn9TScY'); // true
v::videoUrl()->validate('https://youtu.be/netHLn9TScY'); // true

v::videoUrl('youtube')->validate('https://www.youtube.com/watch?v=netHLn9TScY'); // true
v::videoUrl('vimeo')->validate('https://vimeo.com/71787467'); // true

v::videoUrl()->validate('https://youtube.com'); // false
v::videoUrl('youtube')->validate('https://vimeo.com/71787467'); // false
```

The services accepted are:

- YouTube
- Vimeo

The `$service` value is not case-sensitive.

Message template for this validator includes `{{service}}`.

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [Url](Url.md)
