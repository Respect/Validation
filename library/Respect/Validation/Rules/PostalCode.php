<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

class PostalCode extends AbstractRule 
{

    //public $locale = ''; // ISO 3166-1 alpha-2

    public $stringFormat = '';

    public function __construct($locale='')
    {
        if (!is_string($locale) || strlen($locale) != 2)
            throw new ComponentException(
                'Invalid country code.'
        );

        $this->setStringFormat($locale);
    }

    /**
    * Defines the postal code format appropriate for the country informed
    * Regarding the comments that contains "format: ": A = letter and N = number
    * @param string $locale The ISO 3166-1 alpha-2 country code. See: http://en.wikipedia.org/wiki/List_of_postal_codes
    */
    public function setStringFormat($locale) {

        switch (strtoupper($locale)){
            
            case 'BR': // format: 	NNNNN-NNN (NNNNN from 1972 to 1992)
                $this->stringFormat = '/^\d{5}-?\d{3}$/';
                break;

            case 'AF': // format: 	NNNN
            case 'AX': // format: 	NNNNN
            case 'AL': // format: 	NNNN
            case 'DZ': // format: 	NNNNN
            case 'AS': // format: 	NNNNN (optionally NNNNN-NNNN or NNNNN-NNNNNN)
            case 'AD': // format: 	CCNNN
            case 'AI': // format: 	AI-2640
            case 'AR': // format: 	1974-1998 NNNN; From 1999 ANNNNAAA
            case 'AM': // format: 	NNNN
            case 'AC': // format: 	AAAANAA one code: ASCN 1ZZ
            case 'AU': // format: 	NNNN
            case 'AT': // format: 	NNNN
            case 'AZ': // format: 	CCNNNN
            case 'BH': // format: 	NNN or NNNN
            case 'BD': // format: 	NNNN
            case 'BB': // format: 	CCNNNNN
            case 'BY': // format: 	NNNNNN
            case 'BE': // format: 	NNNN
            case 'BM': // format: 	AA NN or AA AA
            case 'BT': // format: 	NNN
            case 'BO': // format: 	NNNN
            case 'BA': // format: 	NNNNN
            case 'IO': // format: 	AAAANAA one code: BBND 1ZZ
            case 'VG': // format: 	CCNNNN
            case 'BN': // format: 	AANNNN
            case 'BG': // format: 	NNNN
            case 'KH': // format: 	NNNNN
            case 'CA': // format: 	ANA NAN
            case 'CV': // format: 	NNNN
            case 'KY': // format: 	CCN-NNNN
            case 'TD': // format: 	NNNNN
            case 'CL': // format: 	NNNNNNN (NNN-NNNN)
            case 'CN': // format: 	NNNNNN
            case 'CX': // format: 	NNNN
            case 'CC': // format: 	NNNN
            case 'CO': // format: 	NNNNNN
            case 'CR': // format: 	NNNNN (NNNN until 2007)
            case 'HR': // format: 	NNNNN
            case 'CU': // format: 	NNNNN
            case 'CY': // format: 	NNNN
            case 'CZ': // format: 	NNNNN (NNN NN)
            case 'DK': // format: 	NNNN
            case 'DO': // format: 	NNNNN
            case 'EC': // format: 	CCNNNNNN
            case 'SV': // format: 	1101
            case 'EG': // format: 	NNNNN
            case 'EE': // format: 	NNNNN
            case 'ET': // format: 	NNNN
            case 'FK': // format: 	AAAANAA one code: FIQQ 1ZZ
            case 'FO': // format: 	NNN
            case 'FI': // format: 	NNNNN
            case 'FR': // format: 	NNNNN
            case 'GF': // format: 	NNNNN
            case 'PF': // format: 	NNNNN
            case 'GA': // format: 	NN [city name] NN
            case 'GE': // format: 	NNNN
            case 'DE': // format: 	1941: NN 1962: NNNN 1993: NNNNN
            case 'GI': // format: 	GX11 1AA
            case 'GR': // format: 	NNN NN
            case 'GL': // format: 	NNNN
            case 'GP': // format: 	NNNNN
            case 'GU': // format: 	NNNNN
            case 'GT': // format: 	NNNNN
            case 'GG': // format: 	AAN NAA, AANN NAA
            case 'GW': // format: 	NNNN
            case 'HT': // format: 	NNNN
            case 'HM': // format: 	NNNN
            case 'HN': // format: 	NNNNN
            case 'HU': // format: 	NNNN
            case 'IS': // format: 	NNN
            case 'IN': // format: 	"NNNNNN, NNN NNN"
            case 'ID': // format: 	NNNNN
            case 'IR': // format: 	NNNNN-NNNNN
            case 'IQ': // format: 	NNNNN
            case 'IM': // format: 	CCN NAA, CCNN NAA
            case 'IL': // format: 	NNNNN
            case 'IT': // format: 	NNNNN
            case 'JM': // format: 	CCAAANN
            case 'JP': // format: 	NNNNNNN (NNN-NNNN)
            case 'JE': // format: 	CCN NAA
            case 'JO': // format: 	NNNNN
            case 'KZ': // format: 	NNNNNN
            case 'XK': // format: 	NNNNN
            case 'KG': // format: 	NNNNNN
            case 'LV': // format: 	CC-NNNN
            case 'LA': // format: 	NNNNN
            case 'LB': // format: 	NNNN NNNN
            case 'LS': // format: 	NNN
            case 'LR': // format: 	NNNN
            case 'LY': // format: 	NNNNN
            case 'LI': // format: 	NNNN
            case 'LT': // format: 	NNNNN
            case 'LU': // format: 	NNNN
            case 'MK': // format: 	NNNN
            case 'MG': // format: 	NNN
            case 'MY': // format: 	NNNNN
            case 'MT': // format: 	AAANNNN (AAA NNNN)
            case 'MH': // format: 	NNNNN
            case 'MQ': // format: 	NNNNN
            case 'YT': // format: 	NNNNN
            case 'FM': // format: 	NNNNN or NNNNN-NNNN
            case 'MX': // format: 	NNNNN
            case 'FM': // format: 	NNNNN
            case 'MD': // format: 	CCNNNN (CC-NNNN)
            case 'MC': // format: 	980NN
            case 'MN': // format: 	NNNNNN
            case 'ME': // format: 	NNNNN
            case 'MA': // format: 	NNNNN
            case 'MZ': // format: 	NNNN
            case 'MM': // format: 	NNNNN
            case 'NA': // format: 	NNNNN
            case 'NP': // format: 	NNNNN
            case 'NL': // format: 	NNNN AA
            case 'NC': // format: 	NNNNN
            case 'NZ': // format: 	NNNN
            case 'NI': // format: 	NNN-NNN-N
            case 'NE': // format: 	NNNN
            case 'NG': // format: 	NNNNNN
            case 'NF': // format: 	NNNN
            case 'MP': // format: 	NNNNN
            case 'NO': // format: 	NNNN
            case 'OM': // format: 	NNN
            case 'PK': // format: 	NNNNN
            case 'PW': // format: 	NNNNN
            case 'PA': // format: 	NNNNNN
            case 'PG': // format: 	NNN
            case 'PY': // format: 	NNNN
            case 'PE': // format: 	Alphanumeric
            case 'PH': // format: 	NNNN
            case 'PN': // format: 	AAAANAA one code: PCRN 1ZZ
            case 'PL': // format: 	NNNNN (NN-NNN)
            case 'PT': // format: 	NNNN
            case 'PT': // format: 	NNNN-NNN (NNNN NNN)
            case 'PR': // format: 	NNNNN
            case 'RE': // format: 	NNNNN
            case 'RO': // format: 	NNNNNN
            case 'RU': // format: 	NNNNNN
            case 'BL': // format: 	NNNNN
            case 'SH': // format: 	STHL 1ZZ
            case 'MF': // format: 	NNNNN
            case 'PM': // format: 	NNNNN
            case 'VC': // format: 	CCNNNN
            case 'SM': // format: 	NNNNN
            case 'SA': // format: 	NNNNN
            case 'SN': // format: 	NNNNN
            case 'RS': // format: 	NNNNN
            case 'RS': // format: 	NNNNN
            case 'SG': // format: 	1950: NN 1973: NNNN 1995: NNNNNN (Each building has its own unique postcode.)
            case 'SK': // format: 	NNNNN (NNN NN)
            case 'SI': // format: 	NNNN (CC-NNNN)
            case 'ZA': // format: 	NNNN
            case 'GS': // format: 	SIQQ 1ZZ
            case 'KR': // format: 	NNNNNN (NNN-NNN)
            case 'ES': // format: 	NNNNN
            case 'LK': // format: 	NNNNN
            case 'SD': // format: 	NNNNN
            case 'SZ': // format: 	ANNN
            case 'SE': // format: 	NNNNN (NNN NN)
            case 'CH': // format: 	NNNN
            case 'TW': // format: 	NNNNN
            case 'TJ': // format: 	NNNNNN
            case 'TH': // format: 	NNNNN
            case 'TT': // format: 	NNNNNN
            case 'SH': // format: 	TDCU 1ZZ
            case 'TN': // format: 	NNNN
            case 'TC': // format: 	TKCA 1ZZ
            case 'TR': // format: 	NNNNN
            case 'TM': // format: 	NNNNNN
            case 'TC': // format: 	TKCA 1ZZ
            case 'UA': // format: 	NNNNN
            case 'GB': // format: 	A(A)N(A/N)NAA (A[A]N[A/N] NAA)
            case 'US': // format: 	NNNNN (optionally NNNNN-NNNN or NNNNN-NNNNNN)
            case 'UY': // format: 	NNNNN
            case 'VI': // format: 	NNNNN
            case 'VA': // format: 	120
            case 'VE': // format: 	NNNN or NNNN A
            case 'VN': // format: 	NNNNNN
            case 'WF': // format: 	NNNNN
            case 'ZM': // format: 	NNNNN
                throw new ComponentException(
                    'No implementation for this country.'
                );
                break;
            case 'AO':
            case 'AG':
            case 'AW':
            case 'BS':
            case 'BZ':
            case 'BJ':
            case 'BW':
            case 'BF':
            case 'BI':
            case 'CM':
            case 'CF':
            case 'KM':
            case 'CG':
            case 'CD':
            case 'CK':
            case 'CI':
            case 'CW':
            case 'DJ':
            case 'DM':
            case 'TL':
            case 'GQ':
            case 'ER':
            case 'FJ':
            case 'TF':
            case 'GM':
            case 'GH':
            case 'GD':
            case 'GN':
            case 'GY':
            case 'HK':
            case 'IE':
            case 'KE':
            case 'KI':
            case 'KP':
            case 'KR':
            case 'KW':
            case 'MO':
            case 'MW':
            case 'MV':
            case 'ML':
            case 'MR':
            case 'MU':
            case 'MS':
            case 'NR':
            case 'NU':
            case 'QA':
            case 'KN':
            case 'LC':
            case 'ST':
            case 'SC':
            case 'SX':
            case 'SL':
            case 'SB':
            case 'SO':
            case 'SR':
            case 'SY':
            case 'TZ':
            case 'TG':
            case 'TK':
            case 'TO':
            case 'TV':
            case 'UG':
            case 'AE':
            case 'UZ':
            case 'VU':
            case 'YE':
            case 'ZW':
                throw new ComponentException(
                    "This country doesn't uses postal code."
                );
                break;
            default:
                throw new ComponentException(
                    'Invalid country code.'
                );
                break;
        }
    }

    public function validate($input) 
    {
        
        $p = preg_match($this->stringFormat, $input);
        
        if ($p === 0 || $p === false) 
            return false;
     
        return true;
    }
}
