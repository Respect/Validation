# AllOf

- `v::allOf(v $v1, v $v2, v $v3...)`

Will validate if all inner validators validates.

```php
v::allOf(
    v::intVal(),
    v::positive()
)->validate(15); // true
```

This is similar to the chain (which is an allOf already), but
its syntax allows you to set custom names for every node:

```php
v::allOf(
    v::intVal()->setName('Account Number'),
    v::positive()->setName('Higher Than Zero')
)->setName('Positive integer')
 ->validate(15); // true
```

***
See also:

  * [OneOf](OneOf.md)
  * [NoneOf](NoneOf.md)
  * [When](When.md)
