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
 * Validates whether an input is subdivision code of Belgium or not.
 *
 * ISO 3166-1 alpha-2: BE
 *
 * @see http://www.geonames.org/BE/administrative-division-belgium.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BeSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BRU', // Brussels
           'VAN', // Antwerpen
           'VBR', // Vlaams Brabant
           'VLG', // Flanders
           'VLI', // Limburg
           'VOV', // Oost-Vlaanderen
           'VWV', // West-Vlaanderen
           'WAL', // Wallonia
           'WBR', // Brabant Wallon
           'WHT', // Hainaut
           'WLG', // Liege
           'WLX', // Luxembourg
           'WNA', // Namur
       ];
    }
}
