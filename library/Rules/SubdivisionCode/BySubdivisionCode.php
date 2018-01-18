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

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validates whether an input is subdivision code of Belarus or not.
 *
 * ISO 3166-1 alpha-2: BY
 *
 * @see http://www.geonames.org/BY/administrative-division-belarus.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BySubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BR', // Brest voblast
           'HM', // Horad Minsk
           'HO', // Homyel voblast
           'HR', // Hrodna voblast
           'MA', // Mahilyow voblast
           'MI', // Minsk voblast
           'VI', // Vitsebsk voblast
       ];
    }
}
