<?php
/**
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
/**
 * @author Jonas Felix <jf@cabag.ch>
 * @author Tizian Schmidlin <st@cabag.ch>
 * @packag fix_mixed_encoding
 */
/**
 * This script was originally cloned form https://github.com/CDRO/fixMixedEncoding.git
 */
// show usage
if(!is_file($argv[1]) || empty($argv[0])) {
	echo "\nUsage: > php fix_mixed_encoding.php inputfile.sql outputfile.sql\n";
	exit;
}

// replace damaged utf8 characters with fixed ones
function fixMixedCharacters($string) {
	$searchReplace = array(
	'Ã¼'=>'ü',
	'Ã¤'=>'ä',
	'Ã¶'=>'ö',
	'Ã–'=>'Ö',
	'ÃŸ'=>'ß',
	'Ã '=>'à',
	'Ã¡'=>'á',
	'Ã¢'=>'â',
	'Ã£'=>'ã',
	'Ã¹'=>'ù',
	'Ãº'=>'ú',
	'Ã»'=>'û',
	'Ã™'=>'Ù',
	'Ãš'=>'Ú',
	'Ã›'=>'Û',
	'Ãœ'=>'Ü',
	'Ã²'=>'ò',
	'Ã³'=>'ó',
	'Ã´'=>'ô',
	'Ã¨'=>'è',
	'Ã©'=>'é',
	'Ãª'=>'ê',
	'Ã«'=>'ë',
	'Ã€'=>'À',
	'Ã'=>'Á',
	'Ã‚'=>'Â',
	'Ãƒ'=>'Ã',
	'Ã„'=>'Ä',
	'Ã…'=>'Å',
	'Ã‡'=>'Ç',
	'Ãˆ'=>'È',
	'Ã‰'=>'É',
	'ÃŠ'=>'',
	'Ã‹'=>'Ë',
	'ÃŒ'=>'Ì',
	'Ã'=>'Í',
	'ÃŽ'=>'Î',
	'Ã'=>'Ï',
	'Ã‘'=>'Ñ',
	'Ã’'=>'Ò',
	'Ã“'=>'Ó',
	'Ã”'=>'Ô',
	'Ã•'=>'Õ',
	'Ã˜'=>'Ø',
	'Ã¥'=>'å',
	'Ã¦'=>'æ',
	'Ã§'=>'ç',
	'Ã¬'=>'ì',
	'Ã­'=>'í',
	'Ã®'=>'î',
	'Ã¯'=>'ï',
	'Ã°'=>'ð',
	'Ã±'=>'ñ',
	'Ãµ'=>'õ',
	'Ã¸'=>'ø',
	'Ã½'=>'ý',
	'Ã¿'=>'ÿ',
	'â‚¬'=>'€'
	);
	return str_replace(array_keys($searchReplace), $searchReplace, $string);
}

// open input file
$fp = fopen($argv[1], ‚r‘);
// open/create output file
$fp2 = fopen($argv[2], ‚w+‘);
// read the whole file by 4098 byte pieces and fix the encoding
while(!feof($fp)) {
	$fixThisString = fread($fp, 4098);
	$fixThisString = fixMixedCharacters($fixThisString);
	fwrite($fp2, $fixThisString);
}
fclose($fp);
fclose($fp2);
