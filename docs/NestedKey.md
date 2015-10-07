# NestedKey

- `v::nestedKey(string $name)`
- `v::nestedKey(string $name, v $validator)`
- `v::nestedKey(string $name, v $validator, boolean $mandatory = true)`

Inspired by Yii2 [ArrayHelper](https://github.com/yiisoft/yii2/blob/master/framework/helpers/BaseArrayHelper.php)

Validates an array key...

```php
$dict = array(
    'foo' => array(
        'baz' => 123,
    ),
);

v::key('foo.baz')->validate($dict); // true
```

...or an object property!


```php
$dict = array(
    'foo' => new \stdClass(
        'baz' => 123,
    ),
);

v::key('foo.baz')->validate($dict); // true
```

***
See also:

  * [Attribute](Attribute.md)
  * [Key](Key.md)