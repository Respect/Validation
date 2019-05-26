<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Azerbaijan subdivision code.
 *
 * ISO 3166-1 alpha-2: AZ
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class AzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'ABS', // Abşeron
        'AGA', // Ağstafa
        'AGC', // Ağcabədi
        'AGM', // Ağdam
        'AGS', // Ağdaş
        'AGU', // Ağsu
        'AST', // Astara
        'BA', // Bakı
        'BAB', // Babək
        'BAL', // Balakən
        'BAR', // Bərdə
        'BEY', // Beyləqan
        'BIL', // Biləsuvar
        'CAB', // Cəbrayıl
        'CAL', // Cəlilabab
        'CUL', // Culfa
        'DAS', // Daşkəsən
        'FUZ', // Füzuli
        'GA', // Gəncə
        'GAD', // Gədəbəy
        'GOR', // Goranboy
        'GOY', // Göyçay
        'GYG', // Göygöl
        'HAC', // Hacıqabul
        'IMI', // İmişli
        'ISM', // İsmayıllı
        'KAL', // Kəlbəcər
        'KAN', // Kǝngǝrli
        'KUR', // Kürdəmir
        'LA', // Lənkəran
        'LAC', // Laçın
        'LAN', // Lənkəran
        'LER', // Lerik
        'MAS', // Masallı
        'MI', // Mingəçevir
        'NA', // Naftalan
        'NEF', // Neftçala
        'NV', // Naxçıvan
        'NX', // Naxçıvan
        'OGU', // Oğuz
        'ORD', // Ordubad
        'QAB', // Qəbələ
        'QAX', // Qax
        'QAZ', // Qazax
        'QBA', // Quba
        'QBI', // Qubadlı
        'QOB', // Qobustan
        'QUS', // Qusar
        'SA', // Şəki
        'SAB', // Sabirabad
        'SAD', // Sədərək
        'SAH', // Şahbuz
        'SAK', // Şəki
        'SAL', // Salyan
        'SAR', // Şərur
        'SAT', // Saatlı
        'SBN', // Şabran
        'SIY', // Siyəzən
        'SKR', // Şəmkir
        'SM', // Sumqayıt
        'SMI', // Şamaxı
        'SMX', // Samux
        'SR', // Şirvan
        'SUS', // Şuşa
        'TAR', // Tərtər
        'TOV', // Tovuz
        'UCA', // Ucar
        'XA', // Xankəndi
        'XAC', // Xaçmaz
        'XCI', // Xocalı
        'XIZ', // Xızı
        'XVD', // Xocavənd
        'YAR', // Yardımlı
        'YE', // Yevlax
        'YEV', // Yevlax
        'ZAN', // Zəngilan
        'ZAQ', // Zaqatala
        'ZAR', // Zərdab
    ];

    public $compareIdentical = true;
}
