# Vimeo

- `v::vimeo()`

Validates if the input is a Vimeo value:

```php
v::vimeo()->validate('https://vimeo.com/71787467'); //true
v::vimeo()->validate('https://player.vimeo.com/video/71787467'); //true
```