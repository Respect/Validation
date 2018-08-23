# PhpLabel

- `PhpLabel()`

Validates if a value is considered a valid PHP Label,
so that it can be used as a *variable*, *function* or *class* name, for example.

Reference:
http://php.net/manual/en/language.variables.basics.php

```php
v::phpLabel()->validate('person'); //true
v::phpLabel()->validate('foo'); //true
v::phpLabel()->validate('4ccess'); //false
```

## Changelog

Version | Description
--------|-------------
  1.1.0 | Created

***
See also:

- [Regex](Regex.md)
- [ResourceType](ResourceType.md)
- [Slug](Slug.md)
- [Charset](Charset.md)

