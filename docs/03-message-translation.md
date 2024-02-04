# Message translation

You're also able to translate your message to another language with Validation.
The only thing one must do is to define the param `translator` as a callable that
will handle the translation overwriting the default factory:

```php
Factory::setDefaultInstance(
    (new Factory())->withTranslator('gettext')
);
```

The example above uses `gettext()` but you can use any other callable value, like
`[$translator, 'trans']` or `you_custom_function()`.

After that, if you call `getMessage()`, `getMessages()`, or `getFullMessage()`,
the message will be translated.
