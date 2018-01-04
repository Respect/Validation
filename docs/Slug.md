# Slug

- `Slug()`

Validates slug-like strings:

```php
v::slug()->isValid('my-wordpress-title'); // true
v::slug()->isValid('my-wordpress--title'); // false
v::slug()->isValid('my-wordpress-title-'); // false
```

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Url](Url.md)
- [VideoUrl](VideoUrl.md)
