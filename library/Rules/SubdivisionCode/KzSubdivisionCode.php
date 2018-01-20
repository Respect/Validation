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
 * Validates whether an input is subdivision code of Kazakhstan or not.
 *
 * ISO 3166-1 alpha-2: KZ
 *
 * @see http://www.geonames.org/KZ/administrative-division-kazakhstan.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class KzSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AKM', // Aqmola
           'AKT', // Aqtobe
           'ALA', // Almaty
           'ALM', // Almaty
           'AST', // Astana
           'ATY', // Atyrau
           'BAY', // Baykonyr
           'KAR', // Qaraghandy
           'KUS', // Qustanay
           'KZY', // Qyzylorda
           'MAN', // Mangghystau
           'PAV', // Paylodar
           'SEV', // Soltustik Qazaqstan
           'VOS', // Shyghys Qazaqstan
           'YUZ', // Ongtustik Qazaqstan
           'ZAP', // Baty Qazaqstan
           'ZHA', // Zhambyl
       ];
    }
}
