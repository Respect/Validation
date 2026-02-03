<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
-->

# Format

- `Format(Formatter $formatter)`

Validates whether an input is already formatted as the result of applying a provided
[Respect\StringFormatter][] `Formatter` to it. You can build formatters using
`Respect\StringFormatter\FormatterBuilder` (commonly aliased as `f`).

```php
v::format(f::pattern('00-00'))->assert('42-33');
// Validation passes successfully

v::format(f::pattern('00-00'))->assert('42.33');
// → "42.33" must be formatted as "42-33"

v::format(f::mask('1-@'))->assert('alganet@gmail.com');
// → "alganet@gmail.com" must be formatted as "*******@gmail.com"

v::not(v::format(f::pattern('00-00')))->assert('42-33');
// → "42-33" must not be formatted as "42-33"

v::named('Vanity plate', v::format(f::pattern('AAA-0000')))->assert('DAD8008');
// → Vanity plate must be formatted as "DAD-8008"
```

This validator is useful when you need to assert that data is already in a desired
presentation (for example, ensuring that a masking tool was already applied or that
stored data follows a required display format).

## Templates

### `Format::TEMPLATE_STANDARD`

|       Mode | Template                                           |
| ---------: | :------------------------------------------------- |
|  `default` | {{subject}} must be formatted as {{formatted}}     |
| `inverted` | {{subject}} must not be formatted as {{formatted}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `formatted` | The value resulting from applying the provided formatter to the input |
| `subject`   | The validated input or the custom validator name (if specified).     |

## Categorization

- Display
- Strings

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [Masked](Masked.md)
- [Templated](Templated.md)

[Respect\StringFormatter]: https://github.com/Respect/StringFormatter
