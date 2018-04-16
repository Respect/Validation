# SubdivisionCode

- `SubdivisionCode(string $countryCode)`

Validates subdivision country codes according to [ISO 3166-2][].

The `$countryCode` must be a country in [ISO 3166-1 alpha-2][] format.

```php
v::subdivisionCode('BR')->validate('SP'); // true
v::subdivisionCode('US')->validate('CA'); // true
```

This rule is case sensitive.

## Available country codes

- `AD`: Andorra
- `AE`: United Arab Emirates
- `AF`: Afghanistan
- `AG`: Antigua and Barbuda
- `AI`: Anguilla
- `AL`: Albania
- `AM`: Armenia
- `AN`: AN.html
- `AO`: Angola
- `AQ`: Antarctica
- `AR`: Argentina
- `AS`: American Samoa
- `AT`: Austria
- `AU`: Australia
- `AW`: Aruba
- `AX`: Åland
- `AZ`: Azerbaijan
- `BA`: Bosnia and Herzegovina
- `BB`: Barbados
- `BD`: Bangladesh
- `BE`: Belgium
- `BF`: Burkina Faso
- `BG`: Bulgaria
- `BH`: Bahrain
- `BI`: Burundi
- `BJ`: Benin
- `BL`: Saint Barthélemy
- `BM`: Bermuda
- `BN`: Brunei
- `BO`: Bolivia
- `BQ`: Bonaire
- `BR`: Brazil
- `BS`: Bahamas
- `BT`: Bhutan
- `BV`: Bouvet Island
- `BW`: Botswana
- `BY`: Belarus
- `BZ`: Belize
- `CA`: Canada
- `CC`: Cocos [Keeling] Islands
- `CD`: Democratic Republic of the Congo
- `CF`: Central African Republic
- `CG`: Republic of the Congo
- `CH`: Switzerland
- `CI`: Ivory Coast
- `CK`: Cook Islands
- `CL`: Chile
- `CM`: Cameroon
- `CN`: China
- `CO`: Colombia
- `CR`: Costa Rica
- `CS`: CS.html
- `CU`: Cuba
- `CV`: Cape Verde
- `CW`: Curacao
- `CX`: Christmas Island
- `CY`: Cyprus
- `CZ`: Czech Republic
- `DE`: Germany
- `DJ`: Djibouti
- `DK`: Denmark
- `DM`: Dominica
- `DO`: Dominican Republic
- `DZ`: Algeria
- `EC`: Ecuador
- `EE`: Estonia
- `EG`: Egypt
- `EH`: Western Sahara
- `ER`: Eritrea
- `ES`: Spain
- `ET`: Ethiopia
- `FI`: Finland
- `FJ`: Fiji
- `FK`: Falkland Islands
- `FM`: Micronesia
- `FO`: Faroe Islands
- `FR`: France
- `GA`: Gabon
- `GB`: United Kingdom
- `GD`: Grenada
- `GE`: Georgia
- `GF`: French Guiana
- `GG`: Guernsey
- `GH`: Ghana
- `GI`: Gibraltar
- `GL`: Greenland
- `GM`: Gambia
- `GN`: Guinea
- `GP`: Guadeloupe
- `GQ`: Equatorial Guinea
- `GR`: Greece
- `GS`: South Georgia and the South Sandwich Islands
- `GT`: Guatemala
- `GU`: Guam
- `GW`: Guinea-Bissau
- `GY`: Guyana
- `HK`: Hong Kong
- `HM`: Heard Island and McDonald Islands
- `HN`: Honduras
- `HR`: Croatia
- `HT`: Haiti
- `HU`: Hungary
- `ID`: Indonesia
- `IE`: Ireland
- `IL`: Israel
- `IM`: Isle of Man
- `IN`: India
- `IO`: British Indian Ocean Territory
- `IQ`: Iraq
- `IR`: Iran
- `IS`: Iceland
- `IT`: Italy
- `JE`: Jersey
- `JM`: Jamaica
- `JO`: Jordan
- `JP`: Japan
- `KE`: Kenya
- `KG`: Kyrgyzstan
- `KH`: Cambodia
- `KI`: Kiribati
- `KM`: Comoros
- `KN`: Saint Kitts and Nevis
- `KP`: North Korea
- `KR`: South Korea
- `KW`: Kuwait
- `KY`: Cayman Islands
- `KZ`: Kazakhstan
- `LA`: Laos
- `LB`: Lebanon
- `LC`: Saint Lucia
- `LI`: Liechtenstein
- `LK`: Sri Lanka
- `LR`: Liberia
- `LS`: Lesotho
- `LT`: Lithuania
- `LU`: Luxembourg
- `LV`: Latvia
- `LY`: Libya
- `MA`: Morocco
- `MC`: Monaco
- `MD`: Moldova
- `ME`: Montenegro
- `MF`: Saint Martin
- `MG`: Madagascar
- `MH`: Marshall Islands
- `MK`: Macedonia
- `ML`: Mali
- `MM`: Myanmar [Burma]
- `MN`: Mongolia
- `MO`: Macao
- `MP`: Northern Mariana Islands
- `MQ`: Martinique
- `MR`: Mauritania
- `MS`: Montserrat
- `MT`: Malta
- `MU`: Mauritius
- `MV`: Maldives
- `MW`: Malawi
- `MX`: Mexico
- `MY`: Malaysia
- `MZ`: Mozambique
- `NA`: Namibia
- `NC`: New Caledonia
- `NE`: Niger
- `NF`: Norfolk Island
- `NG`: Nigeria
- `NI`: Nicaragua
- `NL`: Netherlands
- `NO`: Norway
- `NP`: Nepal
- `NR`: Nauru
- `NU`: Niue
- `NZ`: New Zealand
- `OM`: Oman
- `PA`: Panama
- `PE`: Peru
- `PF`: French Polynesia
- `PG`: Papua New Guinea
- `PH`: Philippines
- `PK`: Pakistan
- `PL`: Poland
- `PM`: Saint Pierre and Miquelon
- `PN`: Pitcairn Islands
- `PR`: Puerto Rico
- `PS`: Palestine
- `PT`: Portugal
- `PW`: Palau
- `PY`: Paraguay
- `QA`: Qatar
- `RE`: Réunion
- `RO`: Romania
- `RS`: Serbia
- `RU`: Russia
- `RW`: Rwanda
- `SA`: Saudi Arabia
- `SB`: Solomon Islands
- `SC`: Seychelles
- `SD`: Sudan
- `SE`: Sweden
- `SG`: Singapore
- `SH`: Saint Helena
- `SI`: Slovenia
- `SJ`: Svalbard and Jan Mayen
- `SK`: Slovakia
- `SL`: Sierra Leone
- `SM`: San Marino
- `SN`: Senegal
- `SO`: Somalia
- `SR`: Suriname
- `SS`: South Sudan
- `ST`: São Tomé and Príncipe
- `SV`: El Salvador
- `SX`: Sint Maarten
- `SY`: Syria
- `SZ`: Swaziland
- `TC`: Turks and Caicos Islands
- `TD`: Chad
- `TF`: French Southern Territories
- `TG`: Togo
- `TH`: Thailand
- `TJ`: Tajikistan
- `TK`: Tokelau
- `TL`: East Timor
- `TM`: Turkmenistan
- `TN`: Tunisia
- `TO`: Tonga
- `TR`: Turkey
- `TT`: Trinidad and Tobago
- `TV`: Tuvalu
- `TW`: Taiwan
- `TZ`: Tanzania
- `UA`: Ukraine
- `UG`: Uganda
- `UM`: U.S. Minor Outlying Islands
- `US`: United States
- `UY`: Uruguay
- `UZ`: Uzbekistan
- `VA`: Vatican City
- `VC`: Saint Vincent and the Grenadines
- `VE`: Venezuela
- `VG`: British Virgin Islands
- `VI`: U.S. Virgin Islands
- `VN`: Vietnam
- `VU`: Vanuatu
- `WF`: Wallis and Futuna
- `WS`: Samoa
- `XK`: Kosovo
- `YE`: Yemen
- `YT`: Mayotte
- `ZA`: South Africa
- `ZM`: Zambia
- `ZW`: Zimbabwe

All data was extrated from [GeoNames][] which is licensed under a
[Creative Commons Attribution 3.0 License][].

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [CountryCode](CountryCode.md)
- [Tld](Tld.md)


[Creative Commons Attribution 3.0 License]: http://creativecommons.org/licenses/by/3.0 "Creative Commons Attribution 3.0 License"
[GeoNames]: http://www.geonames.org "GetNames"
[ISO 3166-1 alpha-2]: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2 "ISO 3166-1 alpha-2"
[ISO 3166-2]: http://en.wikipedia.org/wiki/ISO_3166-2 "ISO 3166-2"
