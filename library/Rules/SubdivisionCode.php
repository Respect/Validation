<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * Validates country subdivision codes according to ISO 3166-2.
 *
 * @see http://en.wikipedia.org/wiki/ISO_3166-2
 * @see http://www.geonames.org/countries/
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SubdivisionCode extends AbstractLocaleWrapper
{
    /**
     * {@inheritdoc}
     */
    protected function getSuffix(): string
    {
        return 'SubdivisionCode';
    }
}
