# ResourceType

- `v::resourceType()`

Validates if the input is a resource.

```php
v::resourceType()->validate(fopen('/path/to/file.txt', 'w')); //true
```

***
See also:

  * [Type](Type.md)
  * [Digit](Digit.md)
