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
    <div class="cookie-consent-top-wrapper">
        <p class="cookie-consent-message">
            <span class="cookie-consent-text"><?= $message ?></span>
            <?= Html::a($learnMore, $link, ['class' => 'cookie-consent-link']) ?>
        </p>
        <button class="cookie-consent-accept-all"><?= $acceptAll ?></button>
        <button class="cookie-consent-controls-toggle"><?= $controlsOpen ?></button>
        <button class="cookie-consent-details-toggle"><?= $detailsOpen ?></button>
    </div>
    <div class="cookie-consent-controls <?php if (!empty($visibleControls)): ?>open<?php endif; ?>">
        <?php foreach ($consent as $key => $item) : ?>
            <label for="<?= $key ?>" class="cookie-consent-control">
                <?= Html::checkbox($key, $item["checked"], [
                    'class' => 'cookie-consent-checkbox',
                    'data-cc-consent' => $key,
                    'disabled' => $item["disabled"],
                    'id' => $key
                ]) ?>
                <span><?= $item["label"] ?></span>
            </label>
        <?php endforeach ?>
        <button class="cookie-consent-save" data-cc-namespace="popup"><?= $save ?></button>
    </div>
    <div class="cookie-consent-details <?php if (!empty($visibleDetails)): ?>open<?php endif; ?>">
        <?php foreach ($consent as $key => $item) : ?>
            <?php if (!empty($item['details'])): ?>
                <label><?= $item["label"] ?></label>
                <table>
                    <?php foreach ($item['details'] as $detail) : ?>
                        <?php if (!empty($detail['title']) && !empty($detail['description'])): ?>
                            <tr>
                                <td><?= $detail['title'] ?></td>
                                <td><?= $detail['description'] ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach ?>
                </table>
            <?php endif; ?>
        <?php endforeach ?>
    </div>
</div>
