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
 * Validates whether an input is subdivision code of China or not.
 *
 * ISO 3166-1 alpha-2: CN
 *
 * @see http://www.geonames.org/CN/administrative-division-china.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CnSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AH', // Anhui
           'BJ', // Beijing
           'CQ', // Chongqìng
           'FJ', // Fujian
           'GD', // Guangdong
           'GS', // Gansu
           'GX', // Guangxi
           'GZ', // Guizhou
           'HA', // Henan
           'HB', // Hubei
           'HE', // Hebei
           'HI', // Hainan
           'HK', // Xianggang
           'HL', // Heilongjiang
           'HN', // Hunan
           'JL', // Jilin
           'JS', // Jiangsu
           'JX', // Jiangxi
           'LN', // Liaoning
           'MO', // Aomen
           'NM', // Nei Mongol
           'NX', // Ningxia
           'QH', // Qinghai
           'SC', // Sichuan
           'SD', // Shandong
           'SH', // Shanghai
           'SN', // Shaanxi
           'SX', // Shanxi
           'TJ', // Tianjin
           'TW', // Taiwan
           'XJ', // Xinjiang
           'XZ', // Xizang Zìzhìqu (Tibet)
           'YN', // Yunnan
           'ZJ', // Zhejiang
       ];
    }
}
