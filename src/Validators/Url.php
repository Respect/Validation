<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function filter_var;
use function trim;

use const FILTER_VALIDATE_URL;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a URL',
    '{{subject}} must not be a URL',
)]
final class Url implements Validator
{
    private readonly Validator $validator;

    public function __construct()
    {
        $this->validator = new After(
            'parse_url',
            new Circuit(
                new ArrayType(),
                new OneOf(
                    new Circuit(
                        new Key('scheme', new In(['http', 'https', 'ftp', 'telnet', 'gopher', 'ldap'])),
                        new Key('host', new OneOf(
                            new Domain(),
                            new After([self::class, 'formatIp'], new Ip()),
                        )),
                    ),
                    new Circuit(
                        new Key('scheme', new Equals('mailto')),
                        new Key('path', new Email()),
                    ),
                ),
            ),
        );
    }

    public function evaluate(mixed $input): Result
    {
        if (!filter_var($input, FILTER_VALIDATE_URL)) {
            return Result::failed($input, $this);
        }

        return Result::of($this->validator->evaluate($input)->hasPassed, $input, $this, []);
    }

    /** @internal public so it can be accessed by unserialized instance */
    public static function formatIp(string $ip): string
    {
        return trim($ip, '[]');
    }
}
