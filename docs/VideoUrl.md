# VideoUrl

- `v::videoUrl(mixed $provider)`
- `v::videoUrl()`

Validates if the input is a video url value:

```php
v::videoUrl('youtube')->validate('https://www.youtube.com/watch?v=netHLn9TScY'); // Validate video url using youtube provider
v::videoUrl('youtube')->validate('https://youtu.be/netHLn9TScY'); // Validate video url using youtube provider
v::videoUrl('youtube')->validate('https://www.youtube.com/embed/netHLn9TScY'); // Validate video url using youtube provider
v::videoUrl('vimeo')->validate('https://vimeo.com/71787467'); // Validate video url using vimeo provider
v::videoUrl('vimeo')->validate('https://player.vimeo.com/video/71787467'); // Validate video url using vimeo provider
v::videoUrl('youtube', 'vimeo')->validate('https://www.youtube.com/watch?v=netHLn9TScY'); // Validate video url using (youtube, vimeo) providers
v::videoUrl('vimeo', 'youtube')->validate('https://vimeo.com/71787467'); // Validate video url using (vimeo, youtube) providers
v::videoUrl()->validate('https://www.youtube.com/watch?v=netHLn9TScY'); // Validate video url using all providers
v::videoUrl()->validate('https://youtu.be/netHLn9TScY'); // Validate video url using all providers
v::videoUrl()->validate('https://www.youtube.com/embed/netHLn9TScY'); // Validate video url using all providers
v::videoUrl()->validate('https://vimeo.com/71787467'); // Validate video url using all providers
v::videoUrl()->validate('https://player.vimeo.com/video/71787467'); // Validate video url using all providers
```

The providers accepted are:

- youtube
- vimeo

Message template for this validator includes `{{provider}}`.


***
See also:

  * [Url](Url.md)
