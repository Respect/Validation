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
 * Validates whether an input is subdivision code of Latvia or not.
 *
 * ISO 3166-1 alpha-2: LV
 *
 * @see http://www.geonames.org/LV/administrative-division-latvia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LvSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '001', // Aglonas Novads
           '002', // Aizkraukles Novads
           '003', // Aizputes Novads
           '004', // Aknīstes Novads
           '005', // Alojas Novads
           '006', // Alsungas Novads
           '007', // Alūksnes Novads
           '008', // Amatas Novads
           '009', // Apes Novads
           '010', // Auces Novads
           '011', // Ādažu Novads
           '012', // Babītes Novads
           '013', // Baldones Novads
           '014', // Baltinavas Novads
           '015', // Balvu Novads
           '016', // Bauskas Novads
           '017', // Beverīnas Novads
           '018', // Brocēnu Novads
           '019', // Burtnieku Novads
           '020', // Carnikavas Novads
           '021', // Cesvaines Novads
           '022', // Cēsu Novads
           '023', // Ciblas Novads
           '024', // Dagdas Novads
           '025', // Daugavpils Novads
           '026', // Dobeles Novads
           '027', // Dundagas Novads
           '028', // Durbes Novads
           '029', // Engures Novads
           '030', // Ērgļu Novads
           '031', // Garkalnes Novads
           '032', // Grobiņas Novads
           '033', // Gulbenes Novads
           '034', // Iecavas Novads
           '035', // Ikšķiles Novads
           '036', // Ilūkstes Novads
           '037', // Inčukalna Novads
           '038', // Jaunjelgavas Novads
           '039', // Jaunpiebalgas Novads
           '040', // Jaunpils Novads
           '041', // Jelgavas Novads
           '042', // Jēkabpils Novads
           '043', // Kandavas Novads
           '044', // Kārsavas Novads
           '045', // Kocēnu Novads
           '046', // Kokneses Novads
           '047', // Krāslavas Novads
           '048', // Krimuldas Novads
           '049', // Krustpils Novads
           '050', // Kuldīgas Novads
           '051', // Ķeguma Novads
           '052', // Ķekavas Novads
           '053', // Lielvārdes Novads
           '054', // Limbažu Novads
           '055', // Līgatnes Novads
           '056', // Līvānu Novads
           '057', // Lubānas Novads
           '058', // Ludzas Novads
           '059', // Madonas Novads
           '060', // Mazsalacas Novads
           '061', // Mālpils Novads
           '062', // Mārupes Novads
           '063', // Mērsraga novads
           '064', // Naukšēnu Novads
           '065', // Neretas Novads
           '066', // Nīcas Novads
           '067', // Ogres Novads
           '068', // Olaines Novads
           '069', // Ozolnieku Novads
           '070', // Pārgaujas Novads
           '071', // Pāvilostas Novads
           '072', // Pļaviņu Novads
           '073', // Preiļu Novads
           '074', // Priekules Novads
           '075', // Priekuļu Novads
           '076', // Raunas Novads
           '077', // Rēzeknes Novads
           '078', // Riebiņu Novads
           '079', // Rojas Novads
           '080', // Ropažu Novads
           '081', // Rucavas Novads
           '082', // Rugāju Novads
           '083', // Rundāles Novads
           '084', // Rūjienas Novads
           '085', // Salas Novads
           '086', // Salacgrīvas Novads
           '087', // Salaspils Novads
           '088', // Saldus Novads
           '089', // Saulkrastu Novads
           '090', // Sējas Novads
           '091', // Siguldas Novads
           '092', // Skrīveru Novads
           '093', // Skrundas Novads
           '094', // Smiltenes Novads
           '095', // Stopiņu Novads
           '096', // Strenču Novads
           '097', // Talsu Novads
           '098', // Tērvetes Novads
           '099', // Tukuma Novads
           '100', // Vaiņodes Novads
           '101', // Valkas Novads
           '102', // Varakļānu Novads
           '103', // Vārkavas Novads
           '104', // Vecpiebalgas Novads
           '105', // Vecumnieku Novads
           '106', // Ventspils Novads
           '107', // Viesītes Novads
           '108', // Viļakas Novads
           '109', // Viļānu Novads
           '110', // Zilupes Novads
           'DGV', // Daugavpils
           'JEL', // Jelgava
           'JKB', // Jēkabpils
           'JUR', // Jurmala
           'LPX', // Liepaja
           'REZ', // Rezekne
           'RIX', // Riga
           'VEN', // Ventspils
           'VMR', // Valmiera
       ];
    }
}
