<?php
 function getVailableLanguage() {
    $language = array(
      'af'     => 'Afrikaans',
      'az'     => 'Azerbaijani',
      'eu'     => 'Basque',
      'be'     => 'Belarusian',
      'be-lat'   => 'Belarusian latin',
      'bg'     => 'Bulgarian',
      'bs'     => 'Bosnian',
      'ca'     => 'Catalan',
      'zh'     => 'Chinese',
      //'zh-TW'     => 'Chinese traditional',
      //'zh-CN'     => 'Chinese simplified',
      'cs'     => 'Czech',
      'da'     => 'Danish',
      'de'     => 'German',
      'el'     => 'Greek',
      'en'     => 'English',
      'es'     => 'Spanish',
      'et'     => 'Estonian',
      'fa'     => 'Persian',
      'fi'     => 'Finnish',
      'fr'     => 'French',
      'gl'     => 'Galician',
      'he'     => 'Hebrew',
      'hi'     => 'Hindi',
      'hr'     => 'Croatian',
      'hu'     => 'Hungarian',
      'id'     => 'Indonesian',
      'it'     => 'Italian',
      'ja'     => 'Japanese',
      'ko'     => 'Korean',
      'ka'     => 'Georgian',
      'lt'     => 'Lithuanian',
      'lv'     => 'Latvian',
      'mk'     => 'Macedonian',
      'mn'     => 'Mongolian',
      'ms'     => 'Malay',
      'nl'     => 'Dutch',
      'no'     => 'Norwegian',
      'pl'     => 'Polish',
      'pt-BR'    => 'Brazilian portuguese',
      'pt'     => 'Portuguese',
      'ro'     => 'Romanian',
      'ru'     => 'Russian',
      'si'     => 'Sinhala',
      'sk'     => 'Slovak',
      'sl'     => 'Slovenian',
      'sq'     => 'Albanian',
      'sr-lat'   => 'Serbian latin',
      'sr'     => 'Serbian',
      'sv'     => 'Swedish',
      'th'     => 'Thai',
      'tr'     => 'Turkish',
      'tt'     => 'Tatarish',
      'uk'     => 'Ukrainian',
    );
    return $language;
  }
 function getLanguageName($language) {
    $languages = getVailableLanguage();
    return $languages[$language];
  }
 function array_language(){
  $array_language = array("en","zh");
  return $array_language;
 }
 function getDefalutlanguage(){
    return "zh";
 }
?>