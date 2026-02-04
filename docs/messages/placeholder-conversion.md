<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
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

See [PlaceholderFormatter][] documentation for more information on creating custom modifiers and the [configuration](../configuration.md) section for more details on container setup.

[PlaceholderFormatter]: https://github.com/Respect/StringFormatter/blob/main/docs/PlaceholderFormatter.md
[Respect\StringFormatter]: https://github.com/Respect/StringFormatter
[Respect\Stringifier]: https://github.com/Respect/Stringifier
