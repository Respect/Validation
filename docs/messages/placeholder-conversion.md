<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Message placeholder conversion

Messages in Validation have placeholders between `{{` and `}}` characters. To replace these placeholders with real parameter values, we need to convert them to strings.

This conversion is handled by [PlaceholderFormatter][] from [Respect\StringFormatter][], which uses [Respect\Stringifier][] to convert values into their string representations.

## Custom modifiers

You can add custom modifiers by providing a custom `PlaceholderFormatter` to the
`ContainerRegistry`:

```php
use DI\Container;
use Respect\StringFormatter\Modifier;
use Respect\StringFormatter\PlaceholderFormatter;
use Respect\Validation\ContainerRegistry;

use function DI\factory;

ContainerRegistry::setContainer(
    ContainerRegistry::createContainer([
        PlaceholderFormatter::class => factory(
            fn(Container $container) => new PlaceholderFormatter(
                [],
                new MyCustomModifier($container->get(Modifier::class)),
            ),
        ),
    ])
);
```

See [PlaceholderFormatter][] documentation for more information on creating custom modifiers.

## Container configuration

The `ContainerRegistry::createContainer()` returns a PSR-11 compatible container.

If you prefer to use a different container, `ContainerRegistry::setContainer()` accepts any [PSR-11](https://www.php-fig.org/psr/psr-11/) compatible container:

```php
use Respect\Validation\ContainerRegistry;

ContainerRegistry::setContainer($yourPsr11Container);
```

[PlaceholderFormatter]: https://github.com/Respect/StringFormatter/blob/main/docs/PlaceholderFormatter.md
[Respect\StringFormatter]: https://github.com/Respect/StringFormatter
[Respect\Stringifier]: https://github.com/Respect/Stringifier
