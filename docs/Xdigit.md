# Xdigit

- `v::xdigit()`

Accepts an hexadecimal number:

```php
v::xdigit()->validate('abc123'); // true
```

Notice, however, that it doesn't accept strings starting with 0x:

```php
v::xdigit()->validate('0x1f'); // false
```

***
See also:

  * [Digit](Digit.md)
  * [Alnum](Alnum.md)
  * [HexRgbColor](HexRgbColor.md)
