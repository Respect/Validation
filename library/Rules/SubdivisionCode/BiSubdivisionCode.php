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
 * Validates whether an input is subdivision code of Burundi or not.
 *
 * ISO 3166-1 alpha-2: BI
 *
 * @see http://www.geonames.org/BI/administrative-division-burundi.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BiSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BB', // Bubanza
           'BL', // Bujumbura Rural
           'BM', // Bujumbura Mairie
           'BR', // Bururi
           'CA', // Cankuzo
           'CI', // Cibitoke
           'GI', // Gitega
           'KI', // Kirundo
           'KR', // Karuzi
           'KY', // Kayanza
           'MA', // Makamba
           'MU', // Muramvya
           'MW', // Mwaro
           'MY', // Muyinga
           'NG', // Ngozi
           'RM', // Rumonge
           'RT', // Rutana
           'RY', // Ruyigi
       ];
    }
}
