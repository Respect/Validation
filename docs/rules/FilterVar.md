# FilterVar

- `FilterVar(int $filter)`
- `FilterVar(int $filter, mixed $options)`

Validates the input with the PHP's [filter_var()](http://php.net/filter_var) function.

```php
v::filterVar(FILTER_VALIDATE_EMAIL)->isValid('bob@example.com'); // true
v::filterVar(FILTER_VALIDATE_URL)->isValid('http://example.com'); // true
v::filterVar(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)->isValid('http://example.com'); // false
v::filterVar(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)->isValid('http://example.com/path'); // true
v::filterVar(FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)->isValid('webserver.local'); // true
v::filterVar(FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)->isValid('@local'); // false
```

## Categorization

- Miscellaneous

## Changelog

Version  | Description
---------|-------------
  2.3.0  | `v::filterVar(FILTER_VALIDATE_INT)->isValid(0)` is no longer false
  2.0.15 | Allow validating domains
   0.8.0 | Created

***
See also:

- [Callback](Callback.md)
- [Json](Json.md)
- [Url](Url.md)
