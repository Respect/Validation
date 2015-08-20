# Zend

- `v::zend(mixed $validator)`

Use Zend validators inside Respect\Validation flow. Messages
are preserved.

```php
v::zend('Hostname')->validate('google.com');
```

You must add `"zendframework/zend-validator": "~2.3"` to your `require` property on composer.json file.

***
See also:

  * [Sf](Sf.md)
