<?php

/*
Plugin Name: sm-clean-wordpress
Plugin URI: http://scuola-mondo.net/clean-wordpress/
Description: Replaces special characters in Wordpress title, excerpt, content and comments. Based on code by <a href="http://www.papascott.de">Scott Hanson</a>, later modified by <a href="http://otaku42.de/">Michael Renzmann</a> and remodified by <a href="http://www.gerhards.net/">Rainer Gerhards</a>. No congfigurable options.
Version: 2.8.1 (tested with Wordpress 2.8+)
Author: Lucius
Author URI: http://scuola-mondo.net/

This plugin is heavily based on the "German Permalinks" plugin from Scott Hanson with modifications form Michael Renzmann and Rainer Gerhards.

See also: http://otaku42.de/2005/06/30/plugin-o42-clean-umlauts/
and: http://www.gerhards.net/wordpress_umlaut

Rainer Gerhards has added the capability to clean the content to HTML entities (e.g. &uuml;) and I have added more characters and limited the plugin-function only for the Wordpress title, excerpt, content and comments. The plugin works with the default Wordpress editor (tested with Wordpress 2.8+) or <a href="http://www.deanlee.cn/wordpress/fckeditor-for-wordpress-plugin/">Dean's FCKEditor for Wordpress</a>.

NOTE: If you miss some conversions, drop me a note with details to info@scuola-mondo.net
*/

// input
$o42_cu_chars['in'] = array(
    chr(188), chr(189), chr(190), chr(169), chr(215), chr(247), chr(162), chr(163), chr(165), chr(167), chr(198), chr(230), chr(199), chr(231), chr(192), chr(224), chr(193), chr(225), chr(200), chr(232), chr(201), chr(233), chr(204), chr(236), chr(205), chr(237), chr(210), chr(242), chr(211), chr(243), chr(217), chr(249), chr(218), chr(250), chr(221), chr(253), chr(194), chr(226), chr(195), chr(227), chr(196), chr(228), chr(197), chr(229), chr(202), chr(234), chr(203), chr(235), chr(206), chr(238), chr(207), chr(239), chr(212), chr(244), chr(213), chr(245), chr(214), chr(246), chr(219), chr(251), chr(220), chr(252), chr(255), chr(174), chr(182), chr(177), chr(183), chr(172), chr(164), chr(166), chr(176), chr(180), chr(168), chr(175), chr(184), chr(171), chr(187), chr(185), chr(178), chr(179), chr(170), chr(186), chr(161), chr(191), chr(181), chr(208), chr(240), chr(209), chr(241), chr(216), chr(248), chr(223), chr(222), chr(254)
);
$o42_cu_chars['ecto'] = array(
    '¼', '½', '¾', '©', '×', '÷', '¢', '£', '¥', '§', 'Æ', 'æ', 'Ç', 'ç', 'À', 'à', 'Á', 'á', 'È', 'è', 'É', 'é', 'Ì', 'ì', 'Í', 'í', 'Ò', 'ò', 'Ó', 'ó', 'Ù', 'ù', 'Ú', 'ú', 'Ý', 'ý', 'Â', 'â', 'Ã', 'ã', 'Ä', 'ä', 'Å', 'å', 'Ê', 'ê', 'Ë', 'ë', 'Î', 'î', 'Ï', 'ï', 'Ô', 'ô', 'Õ', 'õ', 'Ö', 'ö', 'Û', 'û', 'Ü', 'ü', 'ÿ', '®', '¶', '±', '·', '¬', '¤', '¦', '°', '´', '¨', '¯', '¸', '«', '»', '¹', '²', '³', 'ª', 'º', '¡', '¿', 'µ', 'Ð', 'ð', 'Ñ', 'ñ', 'Ø', 'ø', 'ß', 'Þ', 'þ'
);
$o42_cu_chars['utf8'] = array(
    utf8_encode('¼'), utf8_encode('½'), utf8_encode('¾'), utf8_encode('©'), utf8_encode('×'), utf8_encode('÷'), utf8_encode('¢'), utf8_encode('£'), utf8_encode('¥'), utf8_encode('§'), utf8_encode('Æ'), utf8_encode('æ'), utf8_encode('Ç'), utf8_encode('ç'), utf8_encode('À'), utf8_encode('à'), utf8_encode('Á'), utf8_encode('á'), utf8_encode('È'), utf8_encode('è'), utf8_encode('É'), utf8_encode('é'), utf8_encode('Ì'), utf8_encode('ì'), utf8_encode('Í'), utf8_encode('í'), utf8_encode('Ò'), utf8_encode('ò'), utf8_encode('Ó'), utf8_encode('ó'), utf8_encode('Ù'), utf8_encode('ù'), utf8_encode('Ú'), utf8_encode('ú'), utf8_encode('Ý'), utf8_encode('ý'), utf8_encode('Â'), utf8_encode('â'), utf8_encode('Ã'), utf8_encode('ã'), utf8_encode('Ä'), utf8_encode('ä'), utf8_encode('Å'), utf8_encode('å'), utf8_encode('Ê'), utf8_encode('ê'), utf8_encode('Ë'), utf8_encode('ë'), utf8_encode('Î'), utf8_encode('î'), utf8_encode('Ï'), utf8_encode('ï'), utf8_encode('Ô'), utf8_encode('ô'), utf8_encode('Õ'), utf8_encode('õ'), utf8_encode('Ö'), utf8_encode('ö'), utf8_encode('Û'), utf8_encode('û'), utf8_encode('Ü'), utf8_encode('ü'), utf8_encode('ÿ'), utf8_encode('®'), utf8_encode('¶'), utf8_encode('±'), utf8_encode('·'), utf8_encode('¬'), utf8_encode('¤'), utf8_encode('¦'), utf8_encode('°'), utf8_encode('´'), utf8_encode('¨'), utf8_encode('¯'), utf8_encode('¸'), utf8_encode('«'), utf8_encode('»'), utf8_encode('¹'), utf8_encode('²'), utf8_encode('³'), utf8_encode('ª'), utf8_encode('º'), utf8_encode('¡'), utf8_encode('¿'), utf8_encode('µ'), utf8_encode('Ð'), utf8_encode('ð'), utf8_encode('Ñ'), utf8_encode('ñ'), utf8_encode('Ø'), utf8_encode('ø'), utf8_encode('ß'), utf8_encode('Þ'), utf8_encode('þ')
);
$o42_cu_chars['perma'] = array(
    '', '', '', '', '', '', '', '', '', '', '', '', 'C', 'c', 'A', 'a', 'A', 'a', 'E', 'e', 'E', 'e', 'I', 'i', 'I', 'i', 'O', 'o', 'O', 'o', 'U', 'u', 'U', 'u', 'Y', 'y', 'A', 'a', 'A', 'a', 'Ae', 'ae', 'A', 'a', 'E', 'e', 'E', 'e', 'I', 'i', 'I', 'i', 'O', 'o', 'O', 'o', 'Oe', 'oe', 'U', 'u', 'Ue', 'ue', 'y', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2', '3', 'a', '0', 'i', '', '', 'D', 'o', 'N', 'n', '', '', 'ss', 'p', 'p'
);

// output
$o42_cu_chars['post'] = array(
    '&frac14;', '&frac12;', '&frac34;', '&copy;', '&times;', '&divide;', '&cent;', '&pound;', '&yen;', '&sect;', '&AElig;', '&aelig;', '&Ccedil;', '&ccedil;', '&Agrave;', '&agrave;', '&Aacute;', '&aacute;', '&Egrave;', '&egrave;', '&Eacute;', '&eacute;', '&Igrave;', '&igrave;', '&Iacute;', '&iacute;', '&Ograve;', '&ograve;', '&Oacute;', '&oacute;', '&Ugrave;', '&ugrave;', '&Uacute;', '&uacute;', '&Yacute;', '&yacute;', '&Acirc;', '&acirc;', '&Atilde;', '&atilde;', '&Auml;', '&auml;', '&Aring;', '&aring;', '&Ecirc;', '&ecirc;', '&Euml;', '&euml;', '&Icirc;', '&icirc;', '&Iuml;', '&iuml;', '&Ocirc;', '&ocirc;', '&Otilde;', '&otilde;', '&Ouml;', '&ouml;', '&Ucirc;', '&ucirc;', '&Uuml;', '&uuml;', '&yuml;', '&reg;', '&para;', '&plusmn;', '&middot;', '&not;', '&curren;', '&brvbar;', '&deg;', '&acute;', '&uml;', '&macr;', '&cedil;', '&laquo;', '&raquo;', '&sup1;', '&sup2;', '&sup3;', '&ordf;', '&ordm;', '&iexcl;', '&iquest;', '&micro;', '&ETH;', '&eth;', '&Ntilde;', '&ntilde;', '&Oslash;', '&oslash;', '&szlig;', '&THORN;', '&thorn;'
);
$o42_cu_chars['feed'] = array(
    '&#188;', '&#189;', '&#190;', '&#169;', '&#215;', '&#247;', '&#162;', '&#163;', '&#165;', '&#167;', '&#198;', '&#230;', '&#199;', '&#231;', '&#192;', '&#224;', '&#193;', '&#225;', '&#200;', '&#232;', '&#201;', '&#233;', '&#204;', '&#236;', '&#205;', '&#237;', '&#210;', '&#242;', '&#211;', '&#243;', '&#217;', '&#249;', '&#218;', '&#250;', '&#221;', '&#253;', '&#194;', '&#226;', '&#195;', '&#227;', '&#196;', '&#228;', '&#197;', '&#229;', '&#202;', '&#234;', '&#203;', '&#235;', '&#206;', '&#238;', '&#207;', '&#239;', '&#212;', '&#244;', '&#213;', '&#245;', '&#214;', '&#246;', '&#219;', '&#251;', '&#220;', '&#252;', '&#255;', '&#174;', '&#182;', '&#177;', '&#183;', '&#172;', '&#164;', '&#166;', '&#176;', '&#180;', '&#168;', '&#175;', '&#184;', '&#171;', '&#187;', '&#185;', '&#178;', '&#179;', '&#170;', '&#186;', '&#161;', '&#191;', '&#181;', '&#208;', '&#240;', '&#209;', '&#241;', '&#216;', '&#248;', '&#223;', '&#222;', '&#254;'
);

function o42_cu_permalinks($title) {
    global $o42_cu_chars;

    if (seems_utf8($title)) {
	$invalid_latin_chars = array(chr(197).chr(146) => 'OE', chr(197).chr(147) => 'oe', chr(197).chr(160) => 'S', chr(197).chr(189) => 'Z', chr(197).chr(161) => 's', chr(197).chr(190) => 'z', chr(226).chr(130).chr(172) => 'E');
	$title = utf8_decode(strtr($title, $invalid_latin_chars));
    }

    $title = str_replace($o42_cu_chars['ecto'], $o42_cu_chars['perma'], $title);
    $title = str_replace($o42_cu_chars['in'], $o42_cu_chars['perma'], $title);
    $title = sanitize_title_with_dashes($title);
    return $title;
}


// use table "post", not "feed" - change this if you don't like it
function o42_cu_content($content) {
    global $o42_cu_chars;

    if (strtoupper(get_option('blog_charset')) == 'UTF-8') {
	$content = str_replace($o42_cu_chars['utf8'], $o42_cu_chars['post'], $content);
    }
    $content = str_replace($o42_cu_chars['ecto'], $o42_cu_chars['post'], $content);
    $content = str_replace($o42_cu_chars['in'], $o42_cu_chars['post'], $content);

    return $content;
}

/* enable cleaning of permalinks */
remove_filter('sanitize_title', 'sanitize_title_with_dashes');
add_filter('sanitize_title', 'o42_cu_permalinks');

/* enable cleaning of title, excerpt, content and comments */
add_filter('the_excerpt', 'o42_cu_content');
add_filter('the_content', 'o42_cu_content');
add_filter('the_title', 'o42_cu_content');
add_filter('wp_title', 'o42_cu_content');  // this changes title and meta tags
add_filter('comment_text', 'o42_cu_content');

?>
