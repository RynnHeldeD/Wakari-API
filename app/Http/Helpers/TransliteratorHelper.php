<?php

namespace App\Http\Helpers;

class TransliteratorHelper {
	public static function toHiragana($text) {
		//Define kana arrays
		$hiragana =  array(
			//vowels
			'a' => 'あ',
			'i' => 'い',
			'u' => 'う',
			'e' => 'え',
			'o' => 'お',
			//k
			'ka' => 'か',
			'ki' => 'き',
			'ku' => 'く',
			'ke' => 'け',
			'ko' => 'こ',
			'ca' => 'か',
			'ci' => 'き',
			'cu' => 'く',
			'ce' => 'け',
			'co' => 'こ',
			//g
			'ga' => 'が',
			'gi' => 'ぎ',
			'gu' => 'ぐ',
			'ge' => 'げ',
			'go' => 'ご',
			//s
			'sa' => 'さ',
			'shi' => 'し',
			'si' => 'し',
			'su' => 'す',
			'se' => 'せ',
			'so' => 'そ',
			//j
			'ja' => 'じゃ',
			'ji' => 'じ',
			'ju' => 'じゅ',
			'je' => 'じぇ',
			'jo' => 'じょ',
			//z
			'za' => 'ざ',
			'zi' => 'じ',
			'zu' => 'ず',
			'ze' => 'ぜ',
			'zo' => 'ぞ',
			//t
			'ta' => 'た',
			'chi' => 'ち',
			'ti' => 'ち',
			'tsu' => 'つ',
			'tu' => 'つ',
			'te' => 'て',
			'to' => 'と',
			//d
			'da' => 'だ',
			'di' => 'ぢ',
			'du' => 'づ',
			'de' => 'で',
			'do' => 'ど',
			//n
			'na' => 'な',
			'ni' => 'に',
			'nu' => 'ぬ',
			'ne' => 'ね',
			'no' => 'の',
			//h
			'ha' => 'は',
			'hi' => 'ひ',
			'hu' => 'ふ',
			'fu' => 'ふ',
			'he' => 'へ',
			'ho' => 'ほ',
			//b
			'ba' => 'ば',
			'bi' => 'び',
			'bu' => 'ぶ',
			'be' => 'べ',
			'bo' => 'ぼ',
			//p
			'pa' => 'ぱ',
			'pi' => 'ぴ',
			'pu' => 'ぷ',
			'pe' => 'ぺ',
			'po' => 'ぽ',
			//m
			'ma' => 'ま',
			'mi' => 'み',
			'mu' => 'む',
			'me' => 'め',
			'mo' => 'も',
			//y
			'ya' => 'や',
			'yu' => 'ゆ',
			'yo' => 'よ',
			//r
			'ra' => 'ら',
			'ri' => 'り',
			'ru' => 'る',
			're' => 'れ',
			'ro' => 'ろ',
			//w
			'wa' => 'わ',
			'wo' => 'を',
			'n' => 'ん',
			//compound
			'kya' => 'きゃ',
			'kyu' => 'きゅ',
			'kyo' => 'きょ',
			'gya' => 'ぎゃ',
			'gyu' => 'ぎゅ',
			'gyo' => 'ぎょ',
			'sha' => 'しゃ',
			'shu' => 'しゅ',
			'sho' => 'しょ',
			'cha' => 'ちゃ',
			'chu' => 'ちゅ',
			'cho' => 'ちょ',
			'nya' => 'にゃ',
			'nyu' => 'にゅ',
			'nyo' => 'にょ',
			'hya' => 'ひゃ',
			'hyu' => 'ひゅ',
			'hyo' => 'ひょ',
			'bya' => 'びゃ',
			'byu' => 'びゅ',
			'byo' => 'びょ',
			'pya' => 'ぴゃ',
			'pyu' => 'ぴゅ',
			'pyo' => 'ぴょ',
			'mya' => 'みゃ',
			'myu' => 'みゅ',
			'myo' => 'みょ',
			'rya' => 'りゃ',
			'ryu' => 'りゅ',
			'ryo' => 'りょ',
		);
		
		$hira_repeated = array(
			'kk' => 'っk',
			'ss' => 'っs',
			'tt' => 'っt',
			'nn' => 'っn',
			'hh' => 'っh',
			'mm' => 'っm',
			'yy' => 'っy',
			'rr' => 'っr',
			'ww' => 'っw',
			'gg' => 'っg',
			'zz' => 'っz',
			'jj' => 'っj',
			'dd' => 'っd',
			'bb' => 'っb',
			'pp' => 'っp',
			'oo' => 'oう',
			'oh' => 'oう',
		);
		
		$text = str_replace('l', 'r', $text);
		return self::toKana($text, $hira_repeated, $hiragana);
	}
	
	// --------------------------------------------------------------------------
	
	public static function toKatakana($text)
	{
		//Define kana arrays
		$katakana =  array(
			//vowels
			'a' => 'ア',
			'i' => 'イ',
			'u' => 'ウ',
			'e' => 'エ',
			'o' => 'オ',
			//k
			'ca' => 'カ',
			'ci' => 'キ',
			'cu' => 'ク',
			'ce' => 'ケ',
			'co' => 'コ',
			'ka' => 'カ',
			'ki' => 'キ',
			'ku' => 'ク',
			'ke' => 'ケ',
			'ko' => 'コ',
			//g
			'ga' => 'ガ',
			'gi' => 'ギ',
			'gu' => 'グ',
			'ge' => 'ゲ',
			'go' => 'ゴ',
			//s
			'sa' => 'サ',
			'shi' => 'シ',
			'si' => 'シ',
			'su' => 'ス',
			'se' => 'セ',
			'so' => 'ソ',
			//j
			'ja' => 'ジャ',
			'ji' => 'ジ',
			'ju' => 'ジュ',
			'je' => 'ジェ',
			'jo' => 'ジョ',
			//z
			'za' => 'ザ',
			'zi' => 'ジ',
			'zu' => 'ズ',
			'ze' => 'ゼ',
			'zo' => 'ゾ',
			//t
			'ta' => 'タ',
			'chi' => 'チ',
			'ti' => 'チ',
			'tu' => 'ツ',
			'tsu' => 'ツ',
			'te' => 'テ',
			'to' => 'ト',
			//d
			'da' => 'ダ',
			'di' => 'ヂ',
			'du' => 'ヅ',
			'de' => 'デ',
			'do' => 'ド',
			//n
			'na' => 'ナ',
			'ni' => 'ニ',
			'nu' => 'ヌ',
			'ne' => 'ネ',
			'no' => 'ノ',
			//h
			'ha' => 'ハ',
			'hi' => 'ヒ',
			'hu' => 'フ',
			'fu' => 'フ',
			'he' => 'ヘ',
			'ho' => 'ホ',
			//b
			'ba' => 'バ',
			'bi' => 'ビ',
			'bu' => 'ブ',
			'be' => 'ベ',
			'bo' => 'ボ',
			//p
			'pa' => 'パ',
			'pi' => 'ピ',
			'pu' => 'プ',
			'pe' => 'ペ',
			'po' => 'ポ',
			//m
			'ma' => 'マ',
			'mi' => 'ミ',
			'mu' => 'ム',
			'me' => 'メ',
			'mo' => 'モ',
			//y
			'ya' => 'ヤ',
			'yu' => 'ユ',
			'yo' => 'ヨ',
			//r
			'ra' => 'ラ',
			'ri' => 'リ',
			'ru' => 'ル',
			're' => 'レ',
			'ro' => 'ロ',
			//w
			'wa' => 'ワ',
			'wo' => 'ヲ',
			'n' => 'ン',
			//compound
			'kya' => 'キャ',
			'kyu' => 'キュ',
			'kyo' => 'キョ',
			'gya' => 'ギャ',
			'gyu' => 'ギュ',
			'gyo' => 'ギョ',
			'sha' => 'シャ',
			'shu' => 'シュ',
			'sho' => 'ショ',
			'cha' => 'チャ',
			'chu' => 'チュ',
			'cho' => 'チョ',
			'nya' => 'ニャ',
			'nyu' => 'ニュ',
			'nyo' => 'ニョ',
			'hya' => 'ヒャ',
			'hyu' => 'ヒュ',
			'hyo' => 'ヒョ',
			'bya' => 'ビャ',
			'byu' => 'ビュ',
			'byo' => 'ビョ',
			'pya' => 'ピャ',
			'pyu' => 'ピュ',
			'pyo' => 'ピョ',
			'mya' => 'ミャ',
			'myu' => 'ミュ',
			'myo' => 'ミョ',
			'rya' => 'リャ',
			'ryu' => 'リュ',
			'ryo' => 'リョ',
		);
		
		$kata_repeated = array(
			'kk' => 'ッk',
			'ss' => 'ッs',
			'tt' => 'ッt',
			'nn' => 'ッn',
			'hh' => 'ッh',
			'mm' => 'ッm',
			'yy' => 'ッy',
			'rr' => 'ッr',
			'ww' => 'ッw',
			'gg' => 'ッg',
			'zz' => 'ッz',
			'jj' => 'ッj',
			'dd' => 'ッd',
			'bb' => 'ッb',
			'pp' => 'ッp',
			'aa' => 'aー',
			'ii' => 'iー',
			'uu' => 'uー',
			'ee' => 'eー',
			'oo' => 'oー',
			'oh' => 'oー',
		);

		$text = str_replace('l', 'r', $text);
		
		return self::toKana($text, $kata_repeated, $katakana);
	}
	
	// --------------------------------------------------------------------------
	
	public static function toRomaji($text)
	{
		$hiragana =  array(
			//vowels
			'あ' => 'a',
			'い' => 'i',
			'う' => 'u',
			'え' => 'e',
			'お' => 'o',
			//k
			'か' => 'ka',
			'き' => 'ki',
			'く' => 'ku',
			'け' => 'ke',
			'こ' => 'ko',
			//g
			'が' => 'ga',
			'ぎ' => 'gi',
			'ぐ' => 'gu',
			'げ' => 'ge',
			'ご' => 'go',
			//s
			'さ' => 'sa',
			'し' => 'shi',
			'す' => 'su',
			'せ' => 'se',
			'そ' => 'so',
			//j
			'じゃ' => 'ja',
			'じ' => 'ji',
			'ぢ' => 'ji',
			'じゅ' => 'ju',
			'じぇ' => 'je',
			'じょ' => 'jo',
			//z
			'ざ' => 'za',
			'ず' => 'zu',
			'ぜ' => 'ze',
			'ぞ' => 'zo',
			//t
			'た' => 'ta',
			'ち' => 'chi',
			'つ' => 'tsu',
			'て' => 'te',
			'と' => 'to',
			//d
			'だ' => 'da',
			'づ' => 'du',
			'で' => 'de',
			'ど' => 'do',
			//n
			'な' => 'na',
			'に' => 'ni',
			'ぬ' => 'nu',
			'ね' => 'ne',
			'の' => 'no',
			//h
			'は' => 'ha',
			'ひ' => 'hi',
			'ふ' => 'fu',
			'へ' => 'he',
			'ほ' => 'ho',
			//b
			'ば' => 'ba',
			'び' => 'bi',
			'ぶ' => 'bu',
			'べ' => 'be',
			'ぼ' => 'bo',
			//p
			'ぱ' => 'pa',
			'ぴ' => 'pi',
			'ぷ' => 'pu',
			'ぺ' => 'pe',
			'ぽ' => 'po',
			//m
			'ま' => 'ma',
			'み' => 'mi',
			'む' => 'mu',
			'め' => 'me',
			'も' => 'mo',
			//y
			'や' => 'ya',
			'ゆ' => 'yu',
			'よ' => 'yo',
			//r
			'ら' => 'ra',
			'り' => 'ri',
			'る' => 'ru',
			'れ' => 're',
			'ろ' => 'ro',
			//w
			'わ' => 'wa',
			'を' => 'wo',
			'ん' => 'n',
			//compound
			'きゃ' => 'kya',
			'きゅ' => 'kyu',
			'きょ' => 'kyo',
			'ぎゃ' => 'gya',
			'ぎゅ' => 'gyu',
			'ぎょ' => 'gyo',
			'しゃ' => 'sha',
			'しゅ' => 'shu',
			'しょ' => 'sho',
			'ちゃ' => 'cha',
			'ちゅ' => 'chu',
			'ちょ' => 'cho',
			'にゃ' => 'nya',
			'にゅ' => 'nyu',
			'にょ' => 'nyo',
			'ひゃ' => 'hya',
			'ひゅ' => 'hyu',
			'ひょ' => 'hyo',
			'びゃ' => 'bya',
			'びゅ' => 'byu',
			'びょ' => 'byo',
			'ぴゃ' => 'pya',
			'ぴゅ' => 'pyu',
			'ぴょ' => 'pyo',
			'みゃ' => 'mya',
			'みゅ' => 'myu',
			'みょ' => 'myo',
			'りゃ' => 'rya',
			'りゅ' => 'ryu',
			'りょ' => 'ryo',
		);
		
		$hira_repeated = array(
			'っk' => 'kk',
			'っs' => 'ss',
			'っt' => 'tt',
			'っn' => 'nn',
			'っh' => 'hh',
			'っm' => 'mm',
			'っy' => 'yy',
			'っr' => 'rr',
			'っw' => 'ww',
			'っg' => 'gg',
			'っz' => 'zz',
			'っj' => 'jj',
			'っd' => 'dd',
			'っb' => 'bb',
			'っp' => 'pp',
		);
		
		$katakana =  array(
			//vowels
			'ア' => 'a',
			'イ' => 'i',
			'ウ' => 'u',
			'エ' => 'e',
			'オ' => 'o',
			//k
			'カ' => 'ka',
			'キ' => 'ki',
			'ク' => 'ku',
			'ケ' => 'ke',
			'コ' => 'ko',
			//g
			'ガ' => 'ga',
			'ギ' => 'gi',
			'グ' => 'gu',
			'ゲ' => 'ge',
			'ゴ' => 'go',
			//s
			'サ' => 'sa',
			'シ' => 'shi',
			'ス' => 'su',
			'セ' => 'se',
			'ソ' => 'so',
			//j
			'ジャ' => 'ja',
			'ジ' => 'ji',
			'ヂ' => 'ji',
			'ジュ' => 'ju',
			'ジェ' => 'je',
			'ジョ' => 'jo',
			//z
			'ザ' => 'za',
			'ズ' => 'zu',
			'ゼ' => 'ze',
			'ゾ' => 'zo',
			//t
			'タ' => 'ta',
			'チ' => 'chi',
			'ツ' => 'tsu',
			'テ' => 'te',
			'ト' => 'to',
			//d
			'ダ' => 'da',
			'ヅ' => 'du',
			'デ' => 'de',
			'ド' => 'do',
			//n
			'ナ' => 'na',
			'ニ' => 'ni',
			'ヌ' => 'nu',
			'ネ' => 'ne',
			'ノ' => 'no',
			//h
			'ハ' => 'ha',
			'ヒ' => 'hi',
			'フ' => 'fu',
			'ヘ' => 'he',
			'ホ' => 'ho',
			//b
			'バ' => 'ba',
			'ビ' => 'bi',
			'ブ' => 'bu',
			'ベ' => 'be',
			'ボ' => 'bo',
			//p
			'パ' => 'pa',
			'ピ' => 'pi',
			'プ' => 'pu',
			'ペ' => 'pe',
			'ポ' => 'po',
			//m
			'マ' => 'ma',
			'ミ' => 'mi',
			'ム' => 'mu',
			'メ' => 'me',
			'モ' => 'mo',
			//y
			'ヤ' => 'ya',
			'ユ' => 'yu',
			'ヨ' => 'yo',
			//r
			'ラ' => 'ra',
			'リ' => 'ri',
			'ル' => 'ru',
			'レ' => 're',
			'ロ' => 'ro',
			//w
			'ワ' => 'wa',
			'ヲ' => 'wo',
			'ン' => 'n',
			//compound
			'キャ' => 'kya',
			'キュ' => 'kyu',
			'キョ' => 'kyo',
			'ギャ' => 'gya',
			'ギュ' => 'gyu',
			'ギョ' => 'gyo',
			'シャ' => 'sha',
			'シュ' => 'shu',
			'ショ' => 'sho',
			'チャ' => 'cha',
			'チュ' => 'chu',
			'チョ' => 'cho',
			'ニャ' => 'nya',
			'ニュ' => 'nyu',
			'ニョ' => 'nyo',
			'ヒャ' => 'hya',
			'ヒュ' => 'hyu',
			'ヒョ' => 'hyo',
			'ビャ' => 'bya',
			'ビュ' => 'byu',
			'ビョ' => 'byo',
			'ピャ' => 'pya',
			'ピュ' => 'pyu',
			'ピョ' => 'pyo',
			'ミャ' => 'mya',
			'ミュ' => 'myu',
			'ミョ' => 'myo',
			'リャ' => 'rya',
			'リュ' => 'ryu',
			'リョ' => 'ryo',
		);
		
		$kata_repeated = array(
			'ッk' => 'kk',
			'ッs' => 'ss',
			'ッt' => 'tt',
			'ッn' => 'nn',
			'ッh' => 'hh',
			'ッm' => 'mm',
			'ッy' => 'yy',
			'ッr' => 'rr',
			'ッw' => 'ww',
			'ッg' => 'gg',
			'ッz' => 'zz',
			'ッj' => 'jj',
			'ッd' => 'dd',
			'ッb' => 'bb',
			'ッp' => 'pp',
			'aー' => 'aa',
			'iー' => 'ii',
			'uー' => 'uu',
			'eー' => 'ee',
			'oー' => 'oo',
			'oー' => 'oh',
		);
		
		$kata_only = array(
			'ヴァ' => 'va',
			'ファ' => 'fa',
			'ウィ' => 'wi',
			'ヴィ' => 'vi',
			'フィ' => 'fi',
			'ヴ' => 'vu',
			'イェ' => 'ye',
			'ウェ' => 'we',
			'ヴェ' => 've',
			'フェ' => 'fe',
			'ヴォ' => 'vo',
			'フォ' => 'fo',
			'クァ' => 'kwa',
			'グァ' => 'gwa',
			'ツァ' => 'tsa',
			'クィ' => 'kwi',
			'グィ' => 'gwi',
			'ツィ' => 'tsi',
			'ティ' => 'thi',
			'クェ' => 'kwe',
			'グェ' => 'gwe',
			'シェ' => 'she',
			'チェ' => 'che',
			'ツェ' => 'tse',
			'クォ' => 'kwo',
			'グォ' => 'gwo',
			'ツォ' => 'tso',
			'ヴャ' => 'vya',
			'テャ' => 'tha',
			'ヂャ' => 'dya',
			'フャ' => 'fya',
			'ヴュ' => 'vyu',
			'テュ' => 'thu',
			'ヂュ' => 'dyu',
			'フュ' => 'fyu',
			'ヴョ' => 'vyo',
			'テョ' => 'tho',
			'ヂョ' => 'dyo',
			'フョ' => 'fyo',
		);
		
		//Merge arrays
		$pairs = array_merge($hiragana, $katakana, $kata_only);
		
		//Replace normal characters
		$text = strtr($text, $pairs);
		
		//Replace doubled letters
		$text = strtr($text, array_merge($hira_repeated, $kata_repeated));
	
		return $text;
	}
	
	// --------------------------------------------------------------------------
	
	private static function toKana($text, $repeated, $pairs)
	{
		$kata_only = array(
			'va' => 'ヴァ',
			'fa' => 'ファ',
			'wi' => 'ウィ',
			'vi' => 'ヴィ',
			'fi' => 'フィ',
			'vu' => 'ヴ',
			'ye' => 'イェ',
			'we' => 'ウェ',
			've' => 'ヴェ',
			'fe' => 'フェ',
			'vo' => 'ヴォ',
			'fo' => 'フォ',
			'kwa' => 'クァ',
			'gwa' => 'グァ',
			'tsa' => 'ツァ',
			'kwi' => 'クィ',
			'gwi' => 'グィ',
			'tsi' => 'ツィ',
			'thi' => 'ティ',
			'kwe' => 'クェ',
			'gwe' => 'グェ',
			'she' => 'シェ',
			'che' => 'チェ',
			'tse' => 'ツェ',
			'kwo' => 'クォ',
			'gwo' => 'グォ',
			'tso' => 'ツォ',
			'vya' => 'ヴャ',
			'tha' => 'テャ',
			'dya' => 'ヂャ',
			'fya' => 'フャ',
			'vyu' => 'ヴュ',
			'thu' => 'テュ',
			'dyu' => 'ヂュ',
			'fyu' => 'フュ',
			'vyo' => 'ヴョ',
			'tho' => 'テョ',
			'dyo' => 'ヂョ',
			'fyo' => 'フョ',
		);
	
		//Replace doubled letters
		$out = str_replace(array_keys($repeated), array_values($repeated), $text);
		
		//Add in katakana only combinations
		$pairs = array_merge($pairs, $kata_only);
		
		//Replace everything else
		$out = strtr($out, $pairs);
		
		return $out;
	}
}