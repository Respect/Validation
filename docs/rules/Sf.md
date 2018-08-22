# Sf

- `v::sf(string $validator)`

Use Symfony2 validators inside Respect\Validation flow. Messages
are preserved.

```php
v::sf('Time')->validate('15:00:00');
```


You must add `"symfony/validator": "~2.6"` to your `require` property on composer.json file.


***
See also:

  * [Zend](Zend.md)
