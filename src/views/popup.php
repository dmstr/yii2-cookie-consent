<div class="cookie-consent-popup">
    <span class="cookie-consent-message"><?= $message ?></span>
    <?php if (!empty($linkLabel)): ?>
        <a class="cookie-consent-link" href="<?= $link ?>"><?= $linkLabel ?></a>
    <?php endif; ?>
    <?php if (!empty($dismiss)): ?>
        <a href="javascript:void(0)" class="cookie-consent-dismiss"><?= $dismiss ?></a>
    <?php endif; ?>
    <?php if (!empty($allow)): ?>
        <a href="javascript:void(0)" class="cookie-consent-allow"><?= $allow ?></a>
    <?php endif; ?>
    <?php if (!empty($deny)): ?>
        <a href="javascript:void(0)" class="cookie-consent-deny"><?= $deny ?></a>
    <?php endif; ?>
</div>