## Message placeholder conversion

Messages in Validation usually have placeholders that are in between "{{" and
"}}" characters. To replace those placeholders with the real parameters, we need
to convert them to string.

We use the `ParameterStringifier` to convert those parameters into a string.
Our default implementation will convert all parameters with
[Respect\Stringifier](https://github.com/Respect/Stringifier) unless the
parameter is called `name` and it is already a string.

It is possible to overwrite that behavior by creating a custom implementation of
the `ParameterStringifier` and passing it to the `Factory`:

```php
Factory::setDefaultInstance(
    (new Factory())->withParameterStringifier(new MyCustomStringifier())
);
```
