# HexRgbColor

- `v::hexRgbColor()`

Validates a hex RGB color

```php
v::hexRgbColor()->validate('#FFFAAA'); // true
v::hexRgbColor()->validate('123123'); // true
v::hexRgbColor()->validate('FCD'); // true
```
See also:

  * [Xdigit](Xdigit.md)
