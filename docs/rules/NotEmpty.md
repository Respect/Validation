# NotEmpty

- `v::notEmpty()`

Validates if the given input is not empty or in other words is input mandatory and
required. This function also takes whitespace into account, use `noWhitespace()`
if no spaces or linebreaks and other whitespace anywhere in the input is desired.

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

***
See also:

  * [NoWhitespace](NoWhitespace.md)
  * [NotBlank](NotBlank.md)
  * [NotOptional](NotOptional.md)
  * [NullType](NullType.md)
  * [Optional](Optional.md)
