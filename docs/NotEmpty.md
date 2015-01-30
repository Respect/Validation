# NotEmpty

- `v::notEmpty()`

Validates if the given input is not empty or in other words is input mandatory and
required. This function also takes whitespace into account, use `noWhitespace()`
if no spaces or linebreaks and other whitespace anywhere in the input is desired.

```php
v::string()->notEmpty()->validate(''); //false
```

Null values are empty:

```php
v::notEmpty()->validate(null); //false
```

Numbers:

```php
v::int()->notEmpty()->validate(0); //false
```

Empty arrays:

```php
v::arr()->notEmpty()->validate(array()); //false
```

Whitespace:

```php
v::string()->notEmpty()->validate('        ');  //false
v::string()->notEmpty()->validate("\t \n \r");  //false
```

See also:

  * [NoWhitespace](NoWhitespace.md)
  * [NullValue](NullValue.md)
