# Base64

- `Base64()`

Validate if a string is Base64-encoded.

```php
v::base64()->validate('cmVzcGVjdCE='); // true
v::base64()->validate('respect!'); // false
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Base](Base.md)
