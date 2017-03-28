# NotEmpty

- `NotEmpty()`

Validates if the given input is not empty. This function also takes whitespace
into account, use `noWhitespace()` if no spaces or linebreaks and other
whitespace anywhere in the input is desired.

```php
v::stringType()->notEmpty()->validate(''); // false
```

Null values are empty:

```php
v::notEmpty()->validate(null); // false
```

Numbers:

```php
v::intVal()->notEmpty()->validate(0); // false
```

Empty arrays:

```php
v::arrayVal()->notEmpty()->validate([]); // false
```

Whitespace:

```php
v::stringType()->notEmpty()->validate('        ');  //false
v::stringType()->notEmpty()->validate("\t \n \r");  //false
```

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [NoWhitespace](NoWhitespace.md)
- [NullType](NullType.md)
