<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Helpers\DataLoader;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Envelope;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a top-level domain name',
    '{{subject}} must not be a top-level domain name',
)]
final class Tld extends Envelope
{
    public function __construct()
    {
        parent::__construct(new Circuit(
            new StringType(),
            new After('mb_strtoupper', new In(DataLoader::load('domain/tld.php'))),
        ));
    }
}
