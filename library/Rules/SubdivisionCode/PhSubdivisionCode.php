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
 * Validator for Philippines subdivision code.
 *
 * ISO 3166-1 alpha-2: PH
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class PhSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '00', // National Capital Region
        '01', // Ilocos (Region I)
        '02', // Cagayan Valley (Region II)
        '03', // Central Luzon (Region III)
        '05', // Bicol (Region V)
        '06', // Western Visayas (Region VI)
        '07', // Central Visayas (Region VII)
        '08', // Eastern Visayas (Region VIII)
        '09', // Zamboanga Peninsula (Region IX)
        '10', // Northern Mindanao (Region X)
        '11', // Davao (Region XI)
        '12', // Soccsksargen (Region XII)
        '13', // Caraga (Region XIII)
        '14', // Autonomous Region in Muslim Mindanao (ARMM)
        '15', // Cordillera Administrative Region (CAR)
        '40', // CALABARZON (Region IV-A)
        '41', // MIMAROPA (Region IV-B)
        'ABR', // Abra
        'AGN', // Agusan del Norte
        'AGS', // Agusan del Sur
        'AKL', // Aklan
        'ALB', // Albay
        'ANT', // Antique
        'APA', // Apayao
        'AUR', // Aurora
        'BAN', // Batasn
        'BAS', // Basilan
        'BEN', // Benguet
        'BIL', // Biliran
        'BOH', // Bohol
        'BTG', // Batangas
        'BTN', // Batanes
        'BUK', // Bukidnon
        'BUL', // Bulacan
        'CAG', // Cagayan
        'CAM', // Camiguin
        'CAN', // Camarines Norte
        'CAP', // Capiz
        'CAS', // Camarines Sur
        'CAT', // Catanduanes
        'CAV', // Cavite
        'CEB', // Cebu
        'COM', // Compostela Valley
        'DAO', // Davao Oriental
        'DAS', // Davao del Sur
        'DAV', // Davao del Norte
        'DIN', // Dinagat Islands
        'EAS', // Eastern Samar
        'GUI', // Guimaras
        'IFU', // Ifugao
        'ILI', // Iloilo
        'ILN', // Ilocos Norte
        'ILS', // Ilocos Sur
        'ISA', // Isabela
        'KAL', // Kalinga-Apayso
        'LAG', // Laguna
        'LAN', // Lanao del Norte
        'LAS', // Lanao del Sur
        'LEY', // Leyte
        'LUN', // La Union
        'MAD', // Marinduque
        'MAG', // Maguindanao
        'MAS', // Masbate
        'MDC', // Mindoro Occidental
        'MDR', // Mindoro Oriental
        'MOU', // Mountain Province
        'MSC', // Misamis Occidental
        'MSR', // Misamis Oriental
        'NCO', // North Cotabato
        'NEC', // Negros Occidental
        'NER', // Negros Oriental
        'NSA', // Northern Samar
        'NUE', // Nueva Ecija
        'NUV', // Nueva Vizcaya
        'PAM', // Pampanga
        'PAN', // Pangasinan
        'PLW', // Palawan
        'QUE', // Quezon
        'QUI', // Quirino
        'RIZ', // Rizal
        'ROM', // Romblon
        'SAR', // Sarangani
        'SCO', // South Cotabato
        'SIG', // Siquijor
        'SLE', // Southern Leyte
        'SLU', // Sulu
        'SOR', // Sorsogon
        'SUK', // Sultan Kudarat
        'SUN', // Surigao del Norte
        'SUR', // Surigao del Sur
        'TAR', // Tarlac
        'TAW', // Tawi-Tawi
        'WSA', // Western Samar
        'ZAN', // Zamboanga del Norte
        'ZAS', // Zamboanga del Sur
        'ZMB', // Zambales
        'ZSI', // Zamboanga Sibugay
    ];

    public $compareIdentical = true;
}
