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
 * Validator for Vietnam subdivision code.
 *
 * ISO 3166-1 alpha-2: VN
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class VnSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Lai Châu
        '02', // Lào Cai
        '03', // Hà Giang
        '04', // Cao Bằng
        '05', // Sơn La
        '06', // Yên Bái
        '07', // Tuyên Quang
        '09', // Lạng Sơn
        '13', // Quảng Ninh
        '14', // Hoà Bình
        '15', // Hà Tây
        '18', // Ninh Bình
        '20', // Thái Bình
        '21', // Thanh Hóa
        '22', // Nghệ An
        '23', // Hà Tỉnh
        '24', // Quảng Bình
        '25', // Quảng Trị
        '26', // Thừa Thiên-Huế
        '27', // Quảng Nam
        '28', // Kon Tum
        '29', // Quảng Ngãi
        '30', // Gia Lai
        '31', // Bình Định
        '32', // Phú Yên
        '33', // Đắc Lắk
        '34', // Khánh Hòa
        '35', // Lâm Đồng
        '36', // Ninh Thuận
        '37', // Tây Ninh
        '39', // Đồng Nai
        '40', // Bình Thuận
        '41', // Long An
        '43', // Bà Rịa-Vũng Tàu
        '44', // An Giang
        '45', // Đồng Tháp
        '46', // Tiền Giang
        '47', // Kiên Giang
        '49', // Vĩnh Long
        '50', // Bến Tre
        '51', // Trà Vinh
        '52', // Sóc Trăng
        '53', // Bắc Kạn
        '54', // Bắc Giang
        '55', // Bạc Liêu
        '56', // Bắc Ninh
        '57', // Bình Dương
        '58', // Bình Phước
        '59', // Cà Mau
        '61', // Hải Duong
        '63', // Hà Nam
        '66', // Hưng Yên
        '67', // Nam Định
        '68', // Phú Thọ
        '69', // Thái Nguyên
        '70', // Vĩnh Phúc
        '71', // Điện Biên
        '72', // Đắk Nông
        '73', // Hậu Giang
        'CT', // Cần Thơ
        'DN', // Đà Nẵng
        'HN', // Hà Nội
        'HP', // Hải Phòng
        'SG', // Hồ Chí Minh [Sài Gòn]
    ];

    public $compareIdentical = true;
}
