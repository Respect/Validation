<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * China country subdivision.
 *
 * ISO 3166-1 alpha-2: CN
 *
 * @link http://www.geonames.org/CN/administrative-division-china.html
 */
class CnCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '11', // Beijing
        '12', // Tianjin
        '13', // Hebei
        '14', // Shanxi
        '15', // Nei Mongol
        '21', // Liaoning
        '22', // Jilin
        '23', // Heilongjiang
        '31', // Shanghai
        '32', // Jiangsu
        '33', // Zhejiang
        '34', // Anhui
        '35', // Fujian
        '36', // Jiangxi
        '37', // Shandong
        '41', // Henan
        '42', // Hubei
        '43', // Hunan
        '44', // Guangdong
        '45', // Guangxi
        '46', // Hainan
        '50', // Chongqìng
        '51', // Sichuan
        '52', // Guizhou
        '53', // Yunnan
        '54', // Xizang Zìzhìqu (Tibet)
        '61', // Shaanxi
        '62', // Gansu
        '63', // Qinghai
        '64', // Ningxia
        '65', // Xinjiang
        '71', // Taiwan
        '91', // Xianggang
        '92', // Aomen
    );

    public $compareIdentical = true;
}
