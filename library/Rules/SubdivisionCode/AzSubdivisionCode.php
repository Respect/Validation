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
 * Validates whether an input is subdivision code of Azerbaijan or not.
 *
 * ISO 3166-1 alpha-2: AZ
 *
 * @see http://www.geonames.org/AZ/administrative-division-azerbaijan.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AzSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'ABS', // Abseron
           'AGA', // Agstafa
           'AGC', // AgcabAdi
           'AGM', // Agdam
           'AGS', // Agdas
           'AGU', // Agsu
           'AST', // Astara
           'BA', // Baki
           'BAB', // Babek
           'BAL', // BalakAn
           'BAR', // Barda
           'BEY', // Beylaqan
           'BIL', // Bilasuvar
           'CAB', // Cabrayil
           'CAL', // Calilabab
           'CUL', // Culfa
           'DAS', // Daskasan
           'FUZ', // Fuzuli
           'GA', // Ganca
           'GAD', // Gadabay
           'GOR', // Goranboy
           'GOY', // Goycay
           'GYG', // Göygöl
           'HAC', // Haciqabul
           'IMI', // Imisli
           'ISM', // Ismayilli
           'KAL', // Kalbacar
           'KAN', // Kangarli
           'KUR', // Kurdamir
           'LA', // Lankaran
           'LAC', // Lacin
           'LAN', // Lankaran Sahari
           'LER', // Lerik
           'MAS', // Masalli
           'MI', // Mingəçevir
           'NA', // Naftalan
           'NEF', // Neftcala
           'NV', // Naxçivan
           'NX', // Naxcivan
           'OGU', // Oguz
           'ORD', // Ordubad
           'QAB', // Qabala
           'QAX', // Qax
           'QAZ', // Qazax
           'QBA', // Quba
           'QBI', // Qubadli
           'QOB', // Qobustan
           'QUS', // Qusar
           'SA', // Saki
           'SAB', // Sabirabad
           'SAD', // Sadarak
           'SAH', // Sahbuz
           'SAK', // Saki Sahari
           'SAL', // Salyan
           'SAR', // Sarur
           'SAT', // Saatli
           'SBN', // Şabran
           'SIY', // Siyazan
           'SKR', // Samkir
           'SM', // Sumqayit
           'SMI', // Samaxi
           'SMX', // Samux
           'SR', // Şirvan
           'SUS', // Susa
           'TAR', // Tartar
           'TOV', // Tovuz
           'UCA', // Ucar
           'XA', // Xankandi
           'XAC', // Xacmaz
           'XCI', // Xocali
           'XIZ', // Xizi
           'XVD', // Xocavand
           'YAR', // Yardimli
           'YE', // Yevlax Sahari
           'YEV', // Yevlax
           'ZAN', // Zangilan
           'ZAQ', // Zaqatala
           'ZAR', // Zardab
       ];
    }
}
