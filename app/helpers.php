<?php

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\App;

 function transAdmin($key, $placeholder = [],$group = 'lang')
{
    if (App::isLocale('en')){
        $locale='en';
    }else{
        $locale='ar';
    }
    $key = trim($key);
    $word = $group . '.' . $key;
    if (Lang::has($word))
        return trans($word, $placeholder, $locale);

    $messages = [
        $word => $key,
    ];


    app('translator')->addLines($messages, $locale);
    $translation_file = base_path() . '/resources/lang/' . $locale . '/' . $group . '.php';
    $fh = fopen($translation_file, 'r+');
    $new_key = "  \n  '" . $key . "' => '" . $key . "',\n];\n";
    $saved_cursor = -1;
    $end_with_comma = false;
    $has_single_qoute = false;
    for ($cursor = -1; $cursor < 100; $cursor--) {
        fseek($fh, $cursor, SEEK_END);
        if (fgetc($fh) == ',' && !$has_single_qoute) {
            $end_with_comma = true;
            fseek($fh, $cursor + 1, SEEK_END);
            fwrite($fh, $new_key);
            break;
        } else if (fgetc($fh) == '\'' && !$end_with_comma) {
            $has_single_qoute = true;
            fseek($fh, $cursor + 2, SEEK_END);
            fwrite($fh, ',' . $new_key);
            break;
        }
    }
    fclose($fh);
    return trans($word, $placeholder, $locale);
}
