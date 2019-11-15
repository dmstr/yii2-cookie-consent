<?php
/**
 * @link http://www.diemeisterei.de
 * @copyright Copyright (c) 2019 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * --- VARIABLES ---
 *
 * @var $save string
 * @var $learnMore string
 * @var $link string
 * @var $consent array
 */

use yii\helpers\Html; ?>

<div class="cookie-consent-popup">
    <p class="cookie-consent-message">
        <span class="cookie-consent-text"><?= Html::encode($message) ?></span>
        <?= Html::a($learnMore, $link, ['class' => 'cookie-consent-link']) ?>
    </p>
    <div class="cookie-consent-controls">
        <?php foreach ($consent as $key => $item) : ?>
            <label class="cookie-consent-control">
                <?= Html::checkbox('cookie-consent-checkbox', false, [
                    'class' => 'cookie-consent-checkbox',
                    'data-cc-namespace' => 'popup',
                    'data-cc-consent' => $key
                ]) ?>
                <span><?= Html::encode($item["label"]) ?></span>
            </label>
        <?php endforeach ?>
        <button class="cookie-consent-save" data-cc-namespace="popup"><?= Html::encode($save) ?></button>
    </div>
</div>
