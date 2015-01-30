# Length

- `v::length(int $min, int $max)`
- `v::length(int $min, null)`
- `v::length(null, int $max)`
- `v::length(int $min, int $max, boolean $inclusive = true)`

Validates lengths. Most simple example:

```php
v::string()->length(1, 5)->validate('abc'); //true
```

You can also validate only minimum length:

```php
v::string()->length(5, null)->validate('abcdef'); // true
```

Only maximum length:

```php
v::string()->length(null, 5)->validate('abc'); // true
```

The type as the first validator in a chain is a good practice,
since length accepts many types:

```php
v::arr()->length(1, 5)->validate(array('foo', 'bar')); //true
```

A third parameter may be passed to validate the passed values inclusive:

```php
v::string()->length(1, 5, true)->validate('a'); //true
```

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

See also:

  * [Between](Between.md)
