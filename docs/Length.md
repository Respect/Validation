# Length

- `Length(int $min, int $max)`
- `Length(int $min, null)`
- `Length(null, int $max)`
- `Length(int $min, int $max, bool $inclusive)`

Validates lengths. Most simple example:

```php
v::stringType()->length(1, 5)->isValid('abc'); // true
```

You can also validate only minimum length:

```php
v::stringType()->length(5, null)->isValid('abcdef'); // true
```

Only maximum length:

```php
v::stringType()->length(null, 5)->isValid('abc'); // true
```

The type as the first validator in a chain is a good practice,
since length accepts many types:

```php
v::arrayVal()->length(1, 5)->isValid(['foo', 'bar']); // true
```

A third parameter may be passed to validate the passed values inclusive:

```php
v::stringType()->length(1, 5, true)->isValid('a'); // true
```

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Between](Between.md)
