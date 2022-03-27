<?php

// detect localization and load translations file
$lang = isset($_GET['lang']) && $_GET['lang'] == 'FR' ? 'FR' : 'EN';
include('locale.php');

// password generator
include('generator.php');

?>
<!doctype html>
<html lang="<?php echo $locale[$lang]['lang'] ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Generate passwords that work both on AZERTY and QWERTY keyboards.">

    <title><?php echo $locale[$lang]['title'] ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="cover.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-fork-ribbon-css/0.2.3/gh-fork-ribbon.min.css" />
</head>

<body class="text-center">

    <a class="github-fork-ribbon" href="https://github.com/germain-italic/azerty-qwerty-password-generator/fork" data-ribbon="<?php echo $locale[$lang]['fork'] ?>" title="<?php echo $locale[$lang]['fork'] ?>" target="_blank"><?php echo $locale[$lang]['fork'] ?></a>

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link <?php echo $lang == 'FR' ? 'active' : '' ?>" href="/?lang=FR">FR</a>
                    <a class="nav-link <?php echo $lang == 'EN' ? 'active' : '' ?>" href="/?lang=EN">EN</a>
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
            <h1 class="cover-heading"><?php echo $locale[$lang]['cover-heading'] ?></h1>
            <p class="lead"><?php echo $locale[$lang]['lead'] ?></p>


            <form action="/<?php echo isset($_GET['lang']) && $_GET['lang'] ? '?lang='.$lang : '' ?>" method="POST" class="form-inline">

                <div class="d-flex justify-content-center mb-3 align-items-center full-width">
                    <div class="p-2 col-auto">
                        <label class="form-check-label" for="length"><?php echo $locale[$lang]['length'] ?></label>
                    </div>

                    <div class="p-2 col-auto">
                        <select class="form-control" id="length" name="length">
                            <?php
                            $lengths = array(1, 2, 8, 12, 16, 32, 64, 128);
                            $default = isset($_POST['length'])  && $_POST['length']  ? $_POST['length'] : 16;
                            foreach($lengths as $length) :
                                ?>
                            <option value="<?php echo $length ?>"
                                <?php echo $length == $default ? 'selected="selected"' : '' ?>><?php echo $length ?>
                            </option>
                            <?php
                            endforeach
                            ?>
                        </select>
                    </div>

                    <div class="p-2 col-auto">
                        <div class="form-check">
                            <?php
                            if ($_POST) {
                                if (isset($_POST['letters'])) {
                                    $checked = 'checked';
                                } else {
                                    $checked = '';
                                }
                            } else {
                                $checked = 'checked';
                            }
                            ?>
                            <input class="form-check-input" type="checkbox" id="letters" name="letters" value="1"
                                <?php echo $checked ?>>
                            <label class="form-check-label"
                                for="letters"><?php echo $locale[$lang]['letters'] ?></label>
                        </div>
                    </div>

                    <div class="p-2 col-auto">
                        <div class="form-check">
                            <?php
                            if ($_POST) {
                                if (isset($_POST['numbers'])) {
                                    $checked = 'checked';
                                } else {
                                    $checked = '';
                                }
                            } else {
                                $checked = 'checked';
                            }
                            ?>
                            <input class="form-check-input" type="checkbox" id="numbers" name="numbers" value="1"
                                <?php echo $checked ?>>
                            <label class="form-check-label"
                                for="numbers"><?php echo $locale[$lang]['numbers'] ?></label>
                        </div>
                    </div>

                    <div class="p-2 col-auto">
                        <div class="form-check">
                            <?php
                            if ($_POST) {
                                if (isset($_POST['specials'])) {
                                    $checked = 'checked';
                                } else {
                                    $checked = '';
                                }
                            } else {
                                $checked = '';
                            }
                            ?>
                            <input class="form-check-input" type="checkbox" id="specials" name="specials" value="1"
                                <?php echo $checked ?>>
                            <label class="form-check-label" for="specials"><?php echo $locale[$lang]['specials'] ?></label>
                        </div>
                    </div>

                    <div class="p-2 col-auto">
                        <button type="submit" class="btn btn-primary" <?php if (!$_POST) : ?>autofocus<?php endif ?>><?php echo $locale[$lang]['submit'] ?></button>
                    </div>
                </div>
            </form>

            <?php if ($_POST) : ?>
                <div class="d-flex justify-content-center mt-3 full-width">
                    <div class="p-1 col-auto">
                        <input id="password" class="form-control" type="text" value="<?php echo $pass ?>" size="<?php echo strlen($pass) ?>">
                    </div>
                    <div class="p-1 col-auto">
                        <button onclick="copy()" class="btn mb-2" <?php if ($_POST) : ?>autofocus<?php endif ?>><?php echo $locale[$lang]['copy'] ?></button>
                    </div>
                </div>

            <?php endif ?>

        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p><?php echo $locale[$lang]['credits'] ?></p>
            </div>
        </footer>
    </div>


    <script>
        function copy() {
            var copyText = document.getElementById('password');

            copyText.select();
            copyText.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(copyText.value);
        }
    </script>

</body>

</html>