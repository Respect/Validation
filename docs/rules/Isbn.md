# Isbn

- `v::isbn()`

Validates whether the input is a valid [ISBN][] or not.

```php
v::isbn()->isValid('ISBN-13: 978-0-596-52068-7'); // true
v::isbn()->isValid('978 0 596 52068 7'); // true
v::isbn()->isValid('ISBN-12: 978-0-596-52068-7'); // false
v::isbn()->isValid('978 10 596 52068 7'); // false
```

## Categorization

- Identifications

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Imei](Imei.md)
- [Luhn](Luhn.md)

[ISBN]: https://www.isbn-international.org/content/what-isbn "International Standard Book Number"
