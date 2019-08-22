# FilterVar

- `FilterVar(int $filter)`
- `FilterVar(int $filter, mixed $options)`

Validates the input with the PHP's [filter_var()](http://php.net/filter_var) function.

```php
v::filterVar(FILTER_VALIDATE_EMAIL)->validate('bob@example.com'); // true
v::filterVar(FILTER_VALIDATE_URL)->validate('http://example.com'); // true
v::filterVar(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)->validate('http://example.com'); // false
v::filterVar(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)->validate('http://example.com/path'); // true
v::filterVar(FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)->validate('webserver.local'); // true
v::filterVar(FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)->validate('@local'); // false
```

## Categorization

- Miscellaneous

## Changelog

Version  | Description
---------|-------------
  2.0.15 | Allow validating domains
   0.8.0 | Created

***
See also:

- [Callback](Callback.md)
- [Json](Json.md)
- [Url](Url.md)
