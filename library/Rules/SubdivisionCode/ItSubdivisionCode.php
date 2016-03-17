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
 * Validator for Italy subdivision code.
 *
 * ISO 3166-1 alpha-2: IT
 *
 * @link http://www.geonames.org/IT/administrative-division-italy.html
 */
class ItSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '21', // Piedmont
        '23', // Regione Autonoma Valle d'Aosta
        '25', // Lombardy
        '32', // Regione Autonoma Trentino-Alto Adige
        '34', // Regione del Veneto
        '36', // Regione Autonoma Friuli-Venezia Giulia
        '42', // Regione Liguria
        '45', // Regione Emilia-Romagna
        '52', // Tuscany
        '55', // Regione Umbria
        '57', // Regione Marche
        '62', // Regione Lazio
        '65', // Regione Abruzzo
        '67', // Regione Molise
        '72', // Regione Campania
        '75', // Regione Puglia
        '77', // Regione Basilicata
        '78', // Regione Calabria
        '82', // Regione Autonoma Siciliana
        '88', // Regione Autonoma della Sardegna
        'AG', // Agrigento
        'AL', // Alessandria
        'AN', // Ancona
        'AO', // Aosta
        'AP', // Ascoli Piceno
        'AQ', // L'Aquila
        'AR', // Arezzo
        'AT', // Asti
        'AV', // Avellino
        'BA', // Bari
        'BG', // Bergamo
        'BI', // Biella
        'BL', // Belluno
        'BN', // Benevento
        'BO', // Bologna
        'BR', // Brindisi
        'BS', // Brescia
        'BT', // Barletta-Andria-Trani
        'BZ', // Bolzano
        'CA', // Cagliari
        'CB', // Campobasso
        'CE', // Caserta
        'CH', // Chieti
        'CI', // Carbonia-Iglesias
        'CL', // Caltanissetta
        'CN', // Cuneo
        'CO', // Como
        'CR', // Cremona
        'CS', // Cosenza
        'CT', // Catania
        'CZ', // Catanzaro
        'EN', // Enna
        'FC', // Forlì-Cesena
        'FE', // Ferrara
        'FG', // Foggia
        'FI', // Firenze
        'FM', // Fermo
        'FR', // Frosinone
        'GE', // Genova
        'GO', // Gorizia
        'GR', // Grosseto
        'IM', // Imperia
        'IS', // Isernia
        'KR', // Crotone
        'LC', // Lecco
        'LE', // Lecce
        'LI', // Livorno
        'LO', // Lodi
        'LT', // Latina
        'LU', // Lucca
        'MB', // Monza e Brianza
        'MC', // Macerata
        'ME', // Messina
        'MI', // Milano
        'MN', // Mantova
        'MO', // Modena
        'MS', // Massa-Carrara
        'MT', // Matera
        'NA', // Napoli
        'NO', // Novara
        'NU', // Nuoro
        'OG', // Ogliastra
        'OR', // Oristano
        'OT', // Olbia-Tempio
        'PA', // Palermo
        'PC', // Piacenza
        'PD', // Padova
        'PE', // Pescara
        'PG', // Perugia
        'PI', // Pisa
        'PN', // Pordenone
        'PO', // Prato
        'PR', // Parma
        'PT', // Pistoia
        'PU', // Pesaro e Urbino
        'PV', // Pavia
        'PZ', // Potenza
        'RA', // Ravenna
        'RC', // Reggio Calabria
        'RE', // Reggio Emilia
        'RG', // Ragusa
        'RI', // Rieti
        'RM', // Roma
        'RN', // Rimini
        'RO', // Rovigo
        'SA', // Salerno
        'SI', // Siena
        'SO', // Sondrio
        'SP', // La Spezia
        'SR', // Siracusa
        'SS', // Sassari
        'SV', // Savona
        'TA', // Taranto
        'TE', // Teramo
        'TN', // Trento
        'TO', // Torino
        'TP', // Trapani
        'TR', // Terni
        'TS', // Trieste
        'TV', // Treviso
        'UD', // Udine
        'VA', // Varese
        'VB', // Verbano-Cusio-Ossola
        'VC', // Vercelli
        'VE', // Venezia
        'VI', // Vicenza
        'VR', // Verona
        'VS', // Medio Campidano
        'VT', // Viterbo
        'VV', // Vibo Valentia
    ];

    public $compareIdentical = true;
}
