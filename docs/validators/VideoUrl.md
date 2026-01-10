# VideoUrl

- `VideoUrl()`
- `VideoUrl(string $service)`

Validates if the input is a video URL value.

```php
v::videoUrl()->assert('https://player.vimeo.com/video/71787467');
// Validation passes successfully

v::videoUrl()->assert('https://vimeo.com/71787467');
// Validation passes successfully

v::videoUrl()->assert('https://www.youtube.com/embed/netHLn9TScY');
// Validation passes successfully

v::videoUrl()->assert('https://www.youtube.com/watch?v=netHLn9TScY');
// Validation passes successfully

v::videoUrl()->assert('https://youtu.be/netHLn9TScY');
// Validation passes successfully

v::videoUrl()->assert('https://www.twitch.tv/videos/320689092');
// Validation passes successfully

v::videoUrl()->assert('https://clips.twitch.tv/BitterLazyMangetoutHumbleLife');
// Validation passes successfully

v::videoUrl('youtube')->assert('https://www.youtube.com/watch?v=netHLn9TScY');
// Validation passes successfully

v::videoUrl('vimeo')->assert('https://vimeo.com/71787467');
// Validation passes successfully

v::videoUrl('twitch')->assert('https://www.twitch.tv/videos/320689092');
// Validation passes successfully

v::videoUrl('twitch')->assert('https://clips.twitch.tv/BitterLazyMangetoutHumbleLife');
// Validation passes successfully

v::videoUrl()->assert('https://youtube.com');
// → "https://youtube.com" must be a valid video URL

v::videoUrl('youtube')->assert('https://vimeo.com/71787467');
// → "https://vimeo.com/71787467" must be a valid youtube video URL

v::videoUrl('twitch')->assert('https://clips.twitch.tv/videos/90210');
// → "https://clips.twitch.tv/videos/90210" must be a valid twitch video URL

v::videoUrl('twitch')->assert('https://twitch.tv/TakeTeaAndNoTea');
// → "https://twitch.tv/TakeTeaAndNoTea" must be a valid twitch video URL
```

The services accepted are:

- YouTube
- Vimeo
- Twitch (videos and clips)

The `$service` value is not case-sensitive.

Message template for this validator includes `{{service}}`.

## Templates

### `VideoUrl::TEMPLATE_STANDARD`

| Mode       | Template                                  |
| ---------- | ----------------------------------------- |
| `default`  | {{subject}} must be a valid video URL     |
| `inverted` | {{subject}} must not be a valid video URL |

### `VideoUrl::TEMPLATE_SERVICE`

| Mode       | Template                                                       |
| ---------- | -------------------------------------------------------------- |
| `default`  | {{subject}} must be a valid {{service&#124;raw}} video URL     |
| `inverted` | {{subject}} must not be a valid {{service&#124;raw}} video URL |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `service`   |                                                                  |

## Categorization

- Internet

## Changelog

| Version | Description |
| ------: | ----------- |
|   1.0.0 | Created     |

---

See also:

- [Email](Email.md)
- [Json](Json.md)
- [Phone](Phone.md)
- [Slug](Slug.md)
- [Url](Url.md)
