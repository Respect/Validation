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
 * Validates whether an input is subdivision code of Mexico or not.
 *
 * ISO 3166-1 alpha-2: MX
 *
 * @see http://www.geonames.org/MX/administrative-division-mexico.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MxSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AGU', // Aguascalientes
           'BCN', // Baja California
           'BCS', // Baja California Sur
           'CAM', // Campeche
           'CHH', // Chihuahua
           'CHP', // Chiapas
           'CMX', // Ciudad de Mexico
           'COA', // Coahuila
           'COL', // Colima
           'DUR', // Durango
           'GRO', // Guerrero
           'GUA', // Guanajuato
           'HID', // Hidalgo
           'JAL', // Jalisco
           'MEX', // Mexico
           'MIC', // Michoacan
           'MOR', // Morelos
           'NAY', // Nayarit
           'NLE', // Nuevo Leon
           'OAX', // Oaxaca
           'PUE', // Puebla
           'QUE', // Queretaro
           'ROO', // Quintana Roo
           'SIN', // Sinaloa
           'SLP', // San Luis Potosi
           'SON', // Sonora
           'TAB', // Tabasco
           'TAM', // Tamaulipas
           'TLA', // Tlaxcala
           'VER', // Veracruz
           'YUC', // Yucatan
           'ZAC', // Zacatecas
       ];
    }
}
