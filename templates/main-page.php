<?php
/**
 *  Main page
 */

use \SimpleDocumentation\Core;
use \SimpleDocumentation\I18n;

?>
<div class="wrap simpledoc-wrap">
    <h2><?= Core::getLabel() ?></h2>

    <h3><?= __('Documentation list', 'simpledocumentation') ?></h3>

    <h3>Featured</h3>

    <div class="simpledoc-list simpledoc-list--featured">

        <?php for ($i=0; $i<4; $i++) : ?>
            <div class='simpledoc-list__item'>
                <div class="simpledoc-preview"></div>

                <h4 class="simpledoc-title">Item title here</h4>
                <div class="simpledoc-content">
                    <p>Vestibulum id ligula porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis.</p>
                </div>
            </div>
        <?php endfor; ?>

    </div>

    <h3>List</h3>

    <div class="simpledoc-list">
        <?php for ($i=0; $i<4; $i++) : ?>
            <div class='simpledoc-list__item'>
                <h4 class="simpledoc-title">Item title here</h4>
            </div>
        <?php endfor; ?>
    </div>
</div>
