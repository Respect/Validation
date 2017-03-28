# Slug

- `Slug()`

Validates slug-like strings:

```php
v::slug()->validate('my-wordpress-title'); // true
v::slug()->validate('my-wordpress--title'); // false
v::slug()->validate('my-wordpress-title-'); // false
```

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Url](Url.md)
- [VideoUrl](VideoUrl.md)
