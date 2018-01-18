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
 * Validates whether an input is subdivision code of Spain or not.
 *
 * ISO 3166-1 alpha-2: ES
 *
 * @see http://www.geonames.org/ES/administrative-division-spain.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class EsSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'A', // Alicante
           'AB', // Albacete
           'AL', // Almería
           'AN', // Comunidad Autónoma de Andalucía
           'AR', // Comunidad Autónoma de Aragón
           'AS', // Comunidad Autónoma del Principado de Asturias
           'AV', // Ávila
           'B', // Barcelona
           'BA', // Badajoz
           'BI', // Vizcaya
           'BU', // Burgos
           'C', // A Coruña
           'CA', // Cádiz
           'CB', // Comunidad Autónoma de Cantabria
           'CC', // Cáceres
           'CE', // Ceuta
           'CL', // Comunidad Autónoma de Castilla y León
           'CM', // Comunidad Autónoma de Castilla-La Mancha
           'CN', // Comunidad Autónoma de Canarias
           'CO', // Córdoba
           'CR', // Ciudad Real
           'CS', // Castellón
           'CT', // Catalunya
           'CU', // Cuenca
           'EX', // Comunidad Autónoma de Extremadura
           'GA', // Comunidad Autónoma de Galicia
           'GC', // Las Palmas
           'GI', // Girona
           'GR', // Granada
           'GU', // Guadalajara
           'H', // Huelva
           'HU', // Huesca
           'IB', // Comunidad Autónoma de las Islas Baleares
           'J', // Jaén
           'L', // Lleida
           'LE', // León
           'LO', // La Rioja
           'LU', // Lugo
           'M', // Madrid
           'MA', // Málaga
           'MC', // Comunidad Autónoma de la Región de Murcia
           'MD', // Comunidad de Madrid
           'ML', // Melilla
           'MU', // Murcia
           'NA', // Navarra
           'NC', // Comunidad Foral de Navarra
           'O', // Asturias
           'OR', // Ourense
           'P', // Palencia
           'PM', // Baleares
           'PO', // Pontevedra
           'PV', // Euskal Autonomia Erkidegoa
           'RI', // Comunidad Autónoma de La Rioja
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
           'VC', // Comunidad Valenciana
           'VI', // Álava
           'Z', // Zaragoza
           'ZA', // Zamora
       ];
    }
}
