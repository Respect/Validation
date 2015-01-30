# NoWhitespace

- `v::noWhitespace()`

Validates if a string contains no whitespace (spaces, tabs and line breaks);

```php
v::noWhitespace()->validate('foo bar');  //false
v::noWhitespace()->validate("foo\nbar"); //false
```

Like other rules the input is still optional.

```php
v::string()->noWhitespace()->validate('');  //true
v::string()->noWhitespace()->validate(' '); //false
```

This is most useful when chaining with other validators such as `v::alnum()`
