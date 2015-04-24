<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Spain country subdivision.
 *
 * ISO 3166-1 alpha-2: ES
 *
 * @link http://www.geonames.org/ES/administrative-division-spain.html
 */
class EsCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AN', // Comunidad Autónoma de Andalucía
        'AR', // Comunidad Autónoma de Aragón
        'AS', // Comunidad Autónoma del Principado de Asturias
        'CB', // Comunidad Autónoma de Cantabria
        'CE', // Ceuta
        'CL', // Comunidad Autónoma de Castilla y León
        'CM', // Comunidad Autónoma de Castilla-La Mancha
        'CN', // Comunidad Autónoma de Canarias
        'CT', // Catalunya
        'EX', // Comunidad Autónoma de Extremadura
        'GA', // Comunidad Autónoma de Galicia
        'IB', // Comunidad Autónoma de las Islas Baleares
        'MC', // Comunidad Autónoma de la Región de Murcia
        'MD', // Comunidad de Madrid
        'ML', // Melilla
        'NC', // Comunidad Foral de Navarra
        'PV', // Euskal Autonomia Erkidegoa
        'RI', // Comunidad Autónoma de La Rioja
        'VC', // Comunidad Valenciana
        'A', // Alicante
        'AB', // Albacete
        'AL', // Almería
        'AV', // Ávila
        'B', // Barcelona
        'BA', // Badajoz
        'BI', // Vizcaya
        'BU', // Burgos
        'C', // A Coruña
        'CA', // Cádiz
        'CC', // Cáceres
        'CO', // Córdoba
        'CR', // Ciudad Real
        'CS', // Castellón
        'CU', // Cuenca
        'GC', // Las Palmas
        'GI', // Girona
        'GR', // Granada
        'GU', // Guadalajara
        'H', // Huelva
        'HU', // Huesca
        'J', // Jaén
        'L', // Lleida
        'LE', // León
        'LO', // La Rioja
        'LU', // Lugo
        'M', // Madrid
        'MA', // Málaga
        'MU', // Murcia
        'NA', // Navarra
        'O', // Asturias
        'OR', // Ourense
        'P', // Palencia
        'PM', // Baleares
        'PO', // Pontevedra
        'S', // Cantabria
        'SA', // Salamanca
        'SE', // Sevilla
        'SG', // Segovia
        'SO', // Soria
        'SS', // Guipúzcoa
        'T', // Tarragona
        'TE', // Teruel
        'TF', // Santa Cruz de Tenerife
        'TO', // Toledo
        'V', // Valencia
        'VA', // Valladolid
        'VI', // Álava
        'Z', // Zaragoza
        'ZA', // Zamora
    );

    public $compareIdentical = true;
}
