<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Test\SmokeTestProvider;

use function serialize;
use function unserialize;

#[Group('core')]
final class SerializableTest extends TestCase
{
    use SmokeTestProvider;

    #[DataProvider('provideValidatorInput')]
    public function testValidatorSerialization(Validator $v, mixed $input): void
    {
        $vSerial = serialize($v);
        $v = unserialize($vSerial);
        $this->assertTrue($v->validate($input)->isValid());
    }
}
