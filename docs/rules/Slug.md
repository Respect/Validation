# Slug

- `Slug()`

Validates whether the input is a valid slug.

```php
v::slug()->validate('my-wordpress-title'); // true
v::slug()->validate('my-wordpress--title'); // false
v::slug()->validate('my-wordpress-title-'); // false
```

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [PhpLabel](PhpLabel.md)
- [Url](Url.md)
- [VideoUrl](VideoUrl.md)
