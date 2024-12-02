# VideoUrl

- `VideoUrl()`
- `VideoUrl(string $service)`

Validates if the input is a video URL value.

```php
v::videoUrl()->isValid('https://player.vimeo.com/video/71787467'); // true
v::videoUrl()->isValid('https://vimeo.com/71787467'); // true
v::videoUrl()->isValid('https://www.youtube.com/embed/netHLn9TScY'); // true
v::videoUrl()->isValid('https://www.youtube.com/watch?v=netHLn9TScY'); // true
v::videoUrl()->isValid('https://youtu.be/netHLn9TScY'); // true
v::videoUrl()->isValid('https://www.twitch.tv/videos/320689092'); // true
v::videoUrl()->isValid('https://clips.twitch.tv/BitterLazyMangetoutHumbleLife'); // true

v::videoUrl('youtube')->isValid('https://www.youtube.com/watch?v=netHLn9TScY'); // true
v::videoUrl('vimeo')->isValid('https://vimeo.com/71787467'); // true
v::videoUrl('twitch')->isValid('https://www.twitch.tv/videos/320689092'); // true
v::videoUrl('twitch')->isValid('https://clips.twitch.tv/BitterLazyMangetoutHumbleLife'); // true

v::videoUrl()->isValid('https://youtube.com'); // false
v::videoUrl('youtube')->isValid('https://vimeo.com/71787467'); // false
v::videoUrl('twitch')->isValid('https://clips.twitch.tv/videos/90210'); // false
v::videoUrl('twitch')->isValid('https://twitch.tv/TakeTeaAndNoTea'); // false
```

The services accepted are:

- YouTube
- Vimeo
- Twitch (videos and clips)

The `$service` value is not case-sensitive.

Message template for this validator includes `{{service}}`.

## Categorization

- Internet

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [Email](Email.md)
- [Json](Json.md)
- [Phone](Phone.md)
- [Slug](Slug.md)
- [Url](Url.md)
