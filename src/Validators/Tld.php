<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Bogus <g.predl@edis.at>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Lucas Kauz <lucaskauz@gmail.com>
 * SPDX-FileContributor: Marcel Voigt <mv@noch.so>
 * SPDX-FileContributor: Mehmet Tolga Avcioglu <mehmet@activecom.net>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Paul Karikari <paulkarikari1@gmail.com>
 * SPDX-FileContributor: Radoslaw Wesolowski <lame@o2.pl>
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
