<?php

function random_password($length, $letters, $numbers, $specials, $password = '') {
    $chars    = $letters . $numbers . $specials;

    // build a random string with the requested substrings
    $password = str_shuffle(str_pad($password, $length, str_shuffle($chars)));

    // set a regex pattern for every substrings
    $required = array(
        'letters'  => '/[a-zA-Z]/',
        'numbers'  => '/\d/',
        'specials' => '/\W/'
    );

    // make sure that the random string contains at least
    // one of the each requested substrings
    $min_requirement = false;
    $nb_requirements = 0;
    $orig_length = $length;
    foreach($required as $requirement => $pattern) {
        if (strlen($$requirement)) {
            $min_requirement = true;
            $nb_requirements++;
            
            // add characters if more substrings are required than maxlength
            if ($nb_requirements > $orig_length) {
                $orig_length++;
            }
            if (!preg_match($pattern, $password)) {
                $password = random_password($orig_length, $letters, $numbers, $specials);
            }
        }
    }

    // return empty string if no substring is required
    if (!$min_requirement) {
        return '';
    }

    // falls back to required maxlength
    return substr($password, 0, $length);
}


// request on submission
if ($_POST) {
    $pass = random_password(
        $_POST['length'],
        isset($_POST['letters'])  && $_POST['letters']  ? 'ertuiopsdfghjklxcvbnERTUIOPSDFGHJKLXCVBN' : '',
        isset($_POST['numbers'])  && $_POST['numbers']  ? '0123456789' : '',
        isset($_POST['specials']) && $_POST['specials'] ? '/*-+' : ''
    );
}