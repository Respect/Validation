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
 * Validator for United Kingdom subdivision code.
 *
 * ISO 3166-1 alpha-2: GB
 *
 * @link http://www.geonames.org/GB/administrative-division-united-kingdom.html
 */
class GbSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'ABC', // Armagh City Banbridge and Craigavon
        'ABD', // Aberdeenshire
        'ABE', // Aberdeen
        'AGB', // Argyll and Bute
        'AGY', // Isle of Anglesey
        'AND', // Ards and North Down
        'ANN', // Antrim and Newtownabbey
        'ANS', // Angus
        'BAS', // Bath and North East Somerset
        'BBD', // Blackburn with Darwen
        'BDF', // Bedford
        'BDG', // Barking and Dagenham
        'BEN', // Brent
        'BEX', // Bexley
        'BFS', // Belfast
        'BGE', // Bridgend
        'BGW', // Blaenau Gwent
        'BIR', // Birmingham
        'BKM', // Buckinghamshire
        'BMH', // Bournemouth
        'BNE', // Barnet
        'BNH', // Brighton and Hove
        'BNS', // Barnsley
        'BOL', // Bolton
        'BPL', // Blackpool
        'BRC', // Bracknell Forest
        'BRD', // Bradford
        'BRY', // Bromley
        'BST', // Bristol City of
        'BUR', // Bury
        'CAM', // Cambridgeshire
        'CAY', // Caerphilly
        'CBF', // Central Bedfordshire
        'CCG', // Causeway Coast and Glens
        'CGN', // Ceredigion
        'CHE', // Cheshire East
        'CHW', // Cheshire West and Chester
        'CLD', // Calderdale
        'CLK', // Clackmannanshire
        'CMA', // Cumbria
        'CMD', // Camden
        'CMN', // Carmarthenshire
        'CON', // Cornwall
        'COV', // Coventry (West Midlands district)
        'CRF', // Cardiff
        'CRY', // Croydon
        'CWY', // Conwy
        'DAL', // Darlington
        'DBY', // Derbyshire
        'DEN', // Denbighshire
        'DER', // Derby
        'DEV', // Devon
        'DGY', // Dumfries and Galloway
        'DNC', // Doncaster
        'DND', // Dundee
        'DOR', // Dorset
        'DRS', // Derry City and Strabane
        'DUD', // Dudley (West Midlands district)
        'DUR', // Durham
        'EAL', // Ealing
        'EAY', // East Ayrshire
        'EDH', // Edinburgh
        'EDU', // East Dunbartonshire
        'ELN', // East Lothian
        'ELS', // Eilean Siar
        'ENF', // Enfield
        'ENG', // England
        'ERW', // East Renfrewshire
        'ERY', // East Riding of Yorkshire
        'ESS', // Essex
        'ESX', // East Sussex
        'FAL', // Falkirk
        'FIF', // Fife
        'FLN', // Flintshire
        'FMO', // Fermanagh and Omagh
        'GAT', // Gateshead (Tyne
        'GLG', // Glasgow
        'GLS', // Gloucestershire
        'GRE', // Greenwich
        'GWN', // Gwynedd
        'HAL', // Halton
        'HAM', // Hampshire
        'HAV', // Havering
        'HCK', // Hackney
        'HEF', // Herefordshire County of
        'HIL', // Hillingdon
        'HLD', // Highland
        'HMF', // Hammersmith and Fulham
        'HNS', // Hounslow
        'HPL', // Hartlepool
        'HRT', // Hertfordshire
        'HRW', // Harrow
        'HRY', // Haringey
        'IOW', // Isle of Wight
        'ISL', // Islington
        'IVC', // Inverclyde
        'KEC', // Kensington and Chelsea
        'KEN', // Kent
        'KHL', // Kingston upon Hull City of
        'KIR', // Kirklees
        'KTT', // Kingston upon Thames
        'KWL', // Knowsley
        'LAN', // Lancashire
        'LBC', // Lisburn and Castlereagh
        'LBH', // Lambeth
        'LCE', // Leicester
        'LDS', // Leeds
        'LEC', // Leicestershire
        'LEW', // Lewisham
        'LIN', // Lincolnshire
        'LIV', // Liverpool
        'LND', // London City of
        'LUT', // Luton
        'MAN', // Manchester
        'MDB', // Middlesbrough
        'MDW', // Medway
        'MEA', // Mid and East Antrim
        'MIK', // Milton Keynes
        'MLN', // Midlothian
        'MON', // Monmouthshire
        'MRT', // Merton
        'MRY', // Moray
        'MTY', // Merthyr Tydfil
        'MUL', // Mid Ulster
        'NAY', // North Ayrshire
        'NBL', // Northumberland
        'NEL', // North East Lincolnshire
        'NET', // Newcastle upon Tyne
        'NFK', // Norfolk
        'NGM', // Nottingham
        'NIR', // Northern Ireland
        'NLK', // North Lanarkshire
        'NLN', // North Lincolnshire
        'NMD', // Newry Mourne and Down
        'NSM', // North Somerset
        'NTH', // Northamptonshire
        'NTL', // Neath Port Talbot
        'NTT', // Nottinghamshire
        'NTY', // North Tyneside
        'NWM', // Newham
        'NWP', // Newport
        'NYK', // North Yorkshire
        'OLD', // Oldham
        'ORK', // Orkney Islands
        'OXF', // Oxfordshire
        'PEM', // Pembrokeshire
        'PKN', // Perth and Kinross
        'PLY', // Plymouth
        'POL', // Poole
        'POR', // Portsmouth
        'POW', // Powys
        'PTE', // Peterborough
        'RCC', // Redcar and Cleveland
        'RCH', // Rochdale
        'RCT', // Rhondda Cynon Taf
        'RDB', // Redbridge
        'RDG', // Reading
        'RFW', // Renfrewshire
        'RIC', // Richmond upon Thames
        'ROT', // Rotherham
        'RUT', // Rutland
        'SAW', // Sandwell
        'SAY', // South Ayrshire
        'SCB', // Scottish Borders The
        'SCT', // Scotland
        'SFK', // Suffolk
        'SFT', // Sefton
        'SGC', // South Gloucestershire
        'SHF', // Sheffield
        'SHN', // St Helens
        'SHR', // Shropshire
        'SKP', // Stockport
        'SLF', // Salford
        'SLG', // Slough
        'SLK', // South Lanarkshire
        'SND', // Sunderland
        'SOL', // Solihull
        'SOM', // Somerset
        'SOS', // Southend-on-Sea
        'SRY', // Surrey
        'STE', // Stoke-on-Trent
        'STG', // Stirling
        'STH', // Southampton
        'STN', // Sutton
        'STS', // Staffordshire
        'STT', // Stockton-on-Tees
        'STY', // South Tyneside
        'SWA', // Swansea
        'SWD', // Swindon
        'SWK', // Southwark
        'TAM', // Tameside
        'TFW', // Telford and Wrekin
        'THR', // Thurrock
        'TOB', // Torbay
        'TOF', // Torfaen
        'TRF', // Trafford
        'TWH', // Tower Hamlets
        'VGL', // Vale of Glamorgan
        'WAR', // Warwickshire
        'WBK', // West Berkshire
        'WDU', // West Dunbartonshire
        'WFT', // Waltham Forest
        'WGN', // Wigan
        'WIL', // Wiltshire
        'WKF', // Wakefield
        'WLL', // Walsall
        'WLN', // West Lothian
        'WLS', // Wales
        'WLV', // Wolverhampton
        'WND', // Wandsworth
        'WNM', // Windsor and Maidenhead
        'WOK', // Wokingham
        'WOR', // Worcestershire
        'WRL', // Wirral
        'WRT', // Warrington
        'WRX', // Wrexham
        'WSM', // Westminster
        'WSX', // West Sussex
        'YOR', // York
        'ZET', // Shetland Islands
    ];

    public $compareIdentical = true;
}
