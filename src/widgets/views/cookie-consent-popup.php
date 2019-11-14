<?php
/**
* --- VARIABLES ---
*
* @var $save string
* @var $learnMore string
* @var $link string
* @var $consent array
*/
?>

<div class="cookie-consent-popup">
    <p class="cookie-consent-message">
        <?= $message ?>
        <a class="cookie-consent-link" href="<?= $link ?>"><?= $learnMore ?></a>
    </p>
    <div class="cookie-consent-controls">
        <?php foreach ($consent as $key => $item) : ?>
            <label class="cookie-consent-control">
                <input class="cookie-consent-checkbox" type="checkbox" data-cc-namespace="popup" data-cc-consent="<?= $key ?>">
                <span><?= $item["label"] ?></span>
            </label>
        <?php endforeach ?>
        <button class="cookie-consent-save" data-cc-namespace="popup"><?= $save ?></button>
    </div>
</div>
