<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

class Tld extends AbstractRule
{
    protected $tldList = [
        //generic - http://en.wikipedia.org/wiki/Generic_top-level_domain
        'aero', 'asia', 'biz', 'cat', 'com', 'coop', 'edu', 'gov', 'info',
        'int', 'jobs', 'mil', 'mobi', 'museum', 'name', 'net', 'org', 'post', 'pro',
        'tel', 'travel', 'xxx', 'ninja', 'abb', 'abbott', 'abogado', 'academy',
        'accenture', 'accountant', 'accountants', 'active', 'actor', 'ads', 'adult',
        'aeg', 'afl', 'agency', 'aig', 'airforce', 'allfinanz', 'alsace', 'amsterdam',
        'an', 'android', 'apartments', 'app', 'aquarelle', 'archi', 'army', 'arpa',
        'associates', 'attorney', 'auction', 'audio', 'auto', 'autos', 'axa', 'azure',
        'band', 'bank', 'bar', 'barclaycard', 'barclays', 'bargains', 'bauhaus',
        'bayern', 'bbc', 'bbva', 'beer', 'berlin', 'best', 'bharti', 'bible', 'bid',
        'bike', 'bing', 'bingo', 'bio', 'black', 'blackfriday', 'bloomberg', 'blue',
        'bmw', 'bnl', 'bnpparibas', 'boats', 'bond', 'boo', 'boutique', 'bradesco',
        'bridgestone', 'broker', 'brother', 'brussels', 'budapest', 'build', 'builders',
        'business', 'buzz', 'bv', 'bzh', 'cab', 'cafe', 'cal', 'camera', 'camp',
        'cancerresearch', 'canon', 'capetown', 'capital', 'caravan', 'cards',
        'care', 'career', 'careers', 'cars', 'cartier', 'casa', 'cash', 'casino',
        'catering', 'cba', 'cbn', 'center', 'ceo', 'cern', 'cfa', 'cfd', 'channel',
        'chat', 'cheap', 'chloe', 'christmas', 'chrome', 'church', 'cisco', 'citic',
        'city', 'claims', 'cleaning', 'click', 'clinic', 'clothing', 'cloud', 'club',
        'coach', 'codes', 'coffee', 'college', 'cologne', 'commbank', 'community',
        'company', 'computer', 'condos', 'construction', 'consulting', 'contractors',
        'cooking', 'cool', 'corsica', 'country', 'coupons', 'courses', 'credit',
        'creditcard', 'cricket', 'crown', 'crs', 'cruises', 'cuisinella', 'cw',
        'cymru', 'cyou', 'dabur', 'dad', 'dance', 'date', 'dating', 'datsun',
        'day', 'dclk', 'deals', 'degree', 'delivery', 'democrat', 'dental', 'dentist'
        , 'desi', 'design', 'dev', 'diamonds', 'diet', 'digital', 'direct', 'directory',
        'discount', 'dnp', 'docs', 'dog', 'doha', 'domains', 'doosan', 'download',
        'drive', 'durban', 'dvag', 'earth', 'eat', 'education', 'email', 'emerck',
        'energy', 'engineer', 'engineering', 'enterprises', 'epson', 'equipment',
        'erni', 'esq', 'estate', 'eurovision', 'eus', 'events', 'everbank',
        'exchange', 'expert', 'exposed', 'express', 'fail', 'faith', 'fan', 'fans',
        'farm', 'fashion', 'feedback', 'film', 'finance', 'financial', 'firmdale',
        'fish', 'fishing', 'fit', 'fitness', 'flights', 'florist', 'flowers', 'flsmidth',
        'fly', 'foo', 'football', 'forex', 'forsale', 'forum', 'foundation', 'frl',
        'frogans', 'fund', 'furniture', 'futbol', 'fyi', 'gal', 'gallery', 'garden',
        'gbiz', 'gdn', 'gent', 'genting', 'ggee', 'gift', 'gifts', 'gives', 'glass',
        'gle', 'global', 'globo', 'gmail', 'gmo', 'gmx', 'gold', 'goldpoint', 'golf',
        'goo', 'goog', 'google', 'gop', 'graphics', 'gratis', 'green', 'gripe', 'guge',
        'guide', 'guitars', 'guru', 'hamburg', 'hangout', 'haus', 'healthcare', 'help',
        'here', 'hermes', 'hiphop', 'hitachi', 'hiv', 'hockey', 'holdings', 'holiday',
        'homedepot', 'homes', 'honda', 'horse', 'host', 'hosting', 'hoteles', 'hotmail',
        'house', 'how', 'ibm', 'icbc', 'icu', 'ifm', 'immo', 'immobilien', 'industries',
        'infiniti', 'ing', 'ink', 'institute', 'insure', 'international', 'investments',
        'irish', 'iwc', 'java', 'jcb', 'jetzt', 'jewelry', 'jlc', 'jll', 'joburg', 'juegos',
        'kaufen', 'kddi', 'kim', 'kitchen', 'kiwi', 'koeln', 'komatsu', 'krd', 'kred',
        'kyoto', 'lacaixa', 'land', 'lasalle', 'lat', 'latrobe', 'law', 'lawyer', 'lds',
        'lease', 'leclerc', 'legal', 'lgbt', 'liaison', 'lidl', 'life', 'lighting',
        'limited', 'limo', 'link', 'loan', 'loans', 'lol', 'london', 'lotte', 'lotto',
        'love', 'ltda', 'lupin', 'luxe', 'luxury', 'madrid', 'maif', 'maison', 'management',
        'mango', 'market', 'marketing', 'markets', 'marriott', 'mba', 'media', 'meet',
        'melbourne', 'meme', 'memorial', 'men', 'menu', 'miami', 'microsoft', 'mini', 'mma',
        'moda', 'moe', 'monash', 'money', 'montblanc', 'mormon', 'mortgage', 'moscow',
        'motorcycles', 'mov', 'movie', 'movistar', 'mtn', 'mtpc', 'nadex', 'nagoya', 'navy',
        'nec', 'netbank', 'network', 'neustar', 'new', 'news', 'nexus', 'ngo', 'nhk', 'nico',
        'ninja', 'nissan', 'nra', 'nrw', 'ntt', 'nyc', 'office', 'okinawa', 'omega', 'one',
        'ong', 'onl', 'online', 'ooo', 'oracle', 'organic', 'osaka', 'otsuka', 'ovh', 'page',
        'panerai', 'paris', 'partners', 'parts', 'party', 'pharmacy', 'philips', 'photo',
        'photography', 'photos', 'physio', 'piaget', 'pics', 'pictet', 'pictures', 'pink',
        'pizza', 'place', 'play', 'plumbing', 'plus', 'pohl', 'poker', 'porn', 'praxi',
        'press', 'prod', 'productions', 'prof', 'properties', 'property', 'pub', 'qpon',
        'quebec', 'racing', 'realtor', 'realty', 'recipes', 'red', 'redstone', 'rehab',
        'reise', 'reisen', 'reit', 'ren', 'rent', 'rentals', 'repair', 'report', 'republican',
        'rest', 'restaurant', 'review', 'reviews', 'rich', 'ricoh', 'rio', 'rip', 'rocks',
        'rodeo', 'rsvp', 'ruhr', 'run', 'ryukyu', 'saarland', 'sakura', 'sale', 'samsung',
        'sandvik', 'sandvikcoromant', 'sap', 'sarl', 'saxo', 'sca', 'scb', 'schmidt',
        'scholarships', 'school', 'schule', 'schwarz', 'science', 'scor', 'scot', 'seat',
        'sener', 'services', 'sew', 'sex', 'sexy', 'shiksha', 'shoes', 'show', 'shriram',
        'singles', 'site', 'sj', 'ski', 'sky', 'skype', 'sncf', 'soccer', 'social',
        'software', 'sohu', 'solar', 'solutions', 'sony', 'soy', 'space', 'spiegel',
        'spreadbetting', 'starhub', 'statoil', 'studio', 'study', 'style', 'sucks', 'supplies',
        'supply', 'support', 'surf', 'surgery', 'suzuki', 'swatch', 'swiss', 'sx', 'sydney',
        'systems', 'taipei', 'tatar', 'tattoo', 'tax', 'taxi', 'team', 'tech', 'technology',
        'telefonica', 'temasek', 'tennis', 'thd', 'theater', 'tickets', 'tienda', 'tips',
        'tires', 'tirol', 'today', 'tokyo', 'tools', 'top', 'toray', 'toshiba', 'tours',
        'town', 'toys', 'trade', 'trading', 'training', 'trust', 'tui', 'university', 'uno',
        'uol', 'vacations', 'vegas', 'ventures', 'versicherung', 'vet', 'viajes', 'video',
        'villas', 'vision', 'vista', 'vistaprint', 'vlaanderen', 'vodka', 'vote', 'voting',
        'voto', 'voyage', 'wales', 'walter', 'wang', 'watch', 'webcam', 'website', 'wed',
        'wedding', 'weir', 'whoswho', 'wien', 'wiki', 'williamhill', 'win', 'windows',
        'wme', 'work', 'works', 'world', 'wtc', 'wtf', 'xbox', 'xerox', 'xin', 'xyz',
        'yachts', 'yandex', 'yodobashi', 'yoga', 'yokohama', 'youtube', 'zip', 'zone', 'zuerich',
        //country
        'ac', 'ad', 'ae', 'af', 'ag', 'ai', 'al', 'am', 'ao', 'aq', 'ar', 'as',
        'at', 'au', 'aw', 'ax', 'az', 'ba', 'bb', 'bd', 'be', 'bf', 'bg', 'bh',
        'bi', 'bj', 'bm', 'bn', 'bo', 'br', 'bs', 'bt', 'bw', 'by', 'bz',
        'ca', 'cc', 'cd', 'cf', 'cg', 'ch', 'ci', 'ck', 'cl', 'cm', 'cn', 'co',
        'cr', 'cs', 'cu', 'cv', 'cx', 'cy', 'cz', 'de', 'dj', 'dk', 'dm', 'do',
        'dz', 'ec', 'ee', 'eg', 'er', 'es', 'et', 'eu', 'fi', 'fj', 'fk', 'fm',
        'fo', 'fr', 'ga', 'gb', 'gd', 'ge', 'gf', 'gg', 'gh', 'gi', 'gl', 'gm',
        'gn', 'gp', 'gq', 'gr', 'gs', 'gt', 'gu', 'gw', 'gy', 'hk', 'hm', 'hn',
        'hr', 'ht', 'hu', 'id', 'ie', 'il', 'im', 'in', 'io', 'iq', 'ir', 'is',
        'it', 'je', 'jm', 'jo', 'jp', 'ke', 'kg', 'kh', 'ki', 'km', 'kn', 'kp',
        'kr', 'kw', 'ky', 'kz', 'la', 'lb', 'lc', 'li', 'lk', 'lr', 'ls', 'lt',
        'lu', 'lv', 'ly', 'ma', 'mc', 'md', 'me', 'mg', 'mh', 'mk', 'ml', 'mm',
        'mn', 'mo', 'mp', 'mq', 'mr', 'ms', 'mt', 'mu', 'mv', 'mw', 'mx', 'my',
        'mz', 'na', 'nc', 'ne', 'nf', 'ng', 'ni', 'nl', 'no', 'np', 'nr', 'nu',
        'nz', 'om', 'pa', 'pe', 'pf', 'pg', 'ph', 'pk', 'pl', 'pm', 'pn', 'pr',
        'ps', 'pt', 'pw', 'py', 'qa', 're', 'ro', 'rs', 'ru', 'rw', 'sa', 'sb',
        'sc', 'sd', 'se', 'sg', 'sh', 'si', 'sk', 'sl', 'sm', 'sn', 'so',
        'sr', 'st', 'su', 'sv', 'sy', 'sz', 'tc', 'td', 'tf', 'tg', 'th', 'tj',
        'tk', 'tl', 'tm', 'tn', 'to', 'tp', 'tr', 'tt', 'tv', 'tw', 'tz', 'ua',
        'ug', 'uk', 'us', 'uy', 'uz', 'va', 'vc', 've', 'vg', 'vi', 'vn', 'vu',
        'wf', 'ws', 'ye', 'yt', 'za', 'zm', 'zw',
    ];

    public function validate($input)
    {
        return in_array(strtolower($input), $this->tldList);
    }
}
