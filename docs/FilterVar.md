# FilterVar

- `FilterVar(int $filter)`
- `FilterVar(int $filter, mixed $options)`

A wrapper for PHP's [filter_var()](http://php.net/filter_var) function.

```php
v::filterVar(FILTER_VALIDATE_EMAIL)->validate('bob@example.com'); // true
v::filterVar(FILTER_VALIDATE_URL)->validate('http://example.com'); // true
v::filterVar(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)->validate('http://example.com'); // false
v::filterVar(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)->validate('http://example.com/path'); // true
```

## Changelog

Version | Description
--------|-------------
  0.8.0 | Created

***
See also:

- [Callback](Callback.md)
