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
 * Validator for China subdivision code.
 *
 * ISO 3166-1 alpha-2: CN
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class CnSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AH', // Anhui Sheng
        'BJ', // Beijing Shi
        'CQ', // Chongqing Shi
        'FJ', // Fujian Sheng
        'GD', // Guangdong Sheng
        'GS', // Gansu Sheng
        'GX', // Guangxi Zhuangzu Zizhiqu
        'GZ', // Guizhou Sheng
        'HA', // Henan Sheng
        'HB', // Hubei Sheng
        'HE', // Hebei Sheng
        'HI', // Hainan Sheng
        'HK', // Hong Kong SAR (see also separate country code entry under HK)
        'HL', // Heilongjiang Sheng
        'HN', // Hunan Sheng
        'JL', // Jilin Sheng
        'JS', // Jiangsu Sheng
        'JX', // Jiangxi Sheng
        'LN', // Liaoning Sheng
        'MO', // Macao SAR (see also separate country code entry under MO)
        'NM', // Nei Mongol Zizhiqu
        'NX', // Ningxia Huizi Zizhiqu
        'QH', // Qinghai Sheng
        'SC', // Sichuan Sheng
        'SD', // Shandong Sheng
        'SH', // Shanghai Shi
        'SN', // Shaanxi Sheng
        'SX', // Shanxi Sheng
        'TJ', // Tianjin Shi
        'TW', // Taiwan Sheng (see also separate country code entry under TW)
        'XJ', // Xinjiang Uygur Zizhiqu
        'XZ', // Xizang Zizhiqu
        'YN', // Yunnan Sheng
        'ZJ', // Zhejiang Sheng
    ];

    public $compareIdentical = true;
}
