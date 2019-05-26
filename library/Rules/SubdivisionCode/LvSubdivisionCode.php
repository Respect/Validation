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
 * Validator for Latvia subdivision code.
 *
 * ISO 3166-1 alpha-2: LV
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class LvSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '001', // Aglonas novads
        '002', // Aizkraukles novads
        '003', // Aizputes novads
        '004', // Aknīstes novads
        '005', // Alojas novads
        '006', // Alsungas novads
        '007', // Alūksnes novads
        '008', // Amatas novads
        '009', // Apes novads
        '010', // Auces novads
        '011', // Ādažu novads
        '012', // Babītes novads
        '013', // Baldones novads
        '014', // Baltinavas novads
        '015', // Balvu novads
        '016', // Bauskas novads
        '017', // Beverīnas novads
        '018', // Brocēnu novads
        '019', // Burtnieku novads
        '020', // Carnikavas novads
        '021', // Cesvaines novads
        '022', // Cēsu novads
        '023', // Ciblas novads
        '024', // Dagdas novads
        '025', // Daugavpils novads
        '026', // Dobeles novads
        '027', // Dundagas novads
        '028', // Durbes novads
        '029', // Engures novads
        '030', // Ērgļu novads
        '031', // Garkalnes novads
        '032', // Grobiņas novads
        '033', // Gulbenes novads
        '034', // Iecavas novads
        '035', // Ikšķiles novads
        '036', // Ilūkstes novads
        '037', // Inčukalna novads
        '038', // Jaunjelgavas novads
        '039', // Jaunpiebalgas novads
        '040', // Jaunpils novads
        '041', // Jelgavas novads
        '042', // Jēkabpils novads
        '043', // Kandavas novads
        '044', // Kārsavas novads
        '045', // Kocēnu novads
        '046', // Kokneses novads
        '047', // Krāslavas novads
        '048', // Krimuldas novads
        '049', // Krustpils novads
        '050', // Kuldīgas novads
        '051', // Ķeguma novads
        '052', // Ķekavas novads
        '053', // Lielvārdes novads
        '054', // Limbažu novads
        '055', // Līgatnes novads
        '056', // Līvānu novads
        '057', // Lubānas novads
        '058', // Ludzas novads
        '059', // Madonas novads
        '060', // Mazsalacas novads
        '061', // Mālpils novads
        '062', // Mārupes novads
        '063', // Mērsraga novads
        '064', // Naukšēnu novads
        '065', // Neretas novads
        '066', // Nīcas novads
        '067', // Ogres novads
        '068', // Olaines novads
        '069', // Ozolnieku novads
        '070', // Pārgaujas novads
        '071', // Pāvilostas novads
        '072', // Pļaviņu novads
        '073', // Preiļu novads
        '074', // Priekules novads
        '075', // Priekuļu novads
        '076', // Raunas novads
        '077', // Rēzeknes novads
        '078', // Riebiņu novads
        '079', // Rojas novads
        '080', // Ropažu novads
        '081', // Rucavas novads
        '082', // Rugāju novads
        '083', // Rundāles novads
        '084', // Rūjienas novads
        '085', // Salas novads
        '086', // Salacgrīvas novads
        '087', // Salaspils novads
        '088', // Saldus novads
        '089', // Saulkrastu novads
        '090', // Sējas novads
        '091', // Siguldas novads
        '092', // Skrīveru novads
        '093', // Skrundas novads
        '094', // Smiltenes novads
        '095', // Stopiņu novads
        '096', // Strenču novads
        '097', // Talsu novads
        '098', // Tērvetes novads
        '099', // Tukuma novads
        '100', // Vaiņodes novads
        '101', // Valkas novads
        '102', // Varakļānu novads
        '103', // Vārkavas novads
        '104', // Vecpiebalgas novads
        '105', // Vecumnieku novads
        '106', // Ventspils novads
        '107', // Viesītes novads
        '108', // Viļakas novads
        '109', // Viļānu novads
        '110', // Zilupes novads
        'DGV', // Daugavpils
        'JEL', // Jelgava
        'JKB', // Jēkabpils
        'JUR', // Jūrmala
        'LPX', // Liepāja
        'REZ', // Rēzekne
        'RIX', // Rīga
        'VEN', // Ventspils
        'VMR', // Valmiera
    ];

    public $compareIdentical = true;
}
