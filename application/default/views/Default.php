<?php require_once SYSTEM . 'LinkHelper.php'; ?>
<h1 class="center">Latest Widgets</h1>
<div class="line">
    <div class="unit size1of3">
        <h3 class="tcenter">Widget1</h3>
        <img class="center" src="img/widget01.png" alt="Widget 1" />
        <div class="innerColWrap">
            <p>This paragraph describes how awesome widget1 is. You know you want it.</p>
            <div class="action center">
                <?php LinkHelper::url('Widget 1 Details', 'Product', 'view', '1'); ?>
            </div>
        </div>
    </div>
    <div class="unit size1of3">
        <h3 class="tcenter">Widget2</h3>
        <img class="center" src="img/widget02.png" alt="Widget 2" />
        <div class="innerColWrap">
            <p>This paragraph describes how awesome widget2 is. You know you want it.</p>
            <div class="action center">
                <?php LinkHelper::url('Widget 2 Details', 'Product', 'view', '2'); ?>
            </div>
        </div>
    </div>
    <div class="unit size1of3">
        <h3 class="tcenter">Widget3</h3>
        <img class="center" src="img/widget03.png" alt="Widget 3" />
        <div class="innerColWrap">
            <p>This paragraph describes how awesome widget3 is. You know you want it.</p>
            <div class="action center">
                <?php LinkHelper::url('Widget 3 Details', 'Product', 'view', '3'); ?>
            </div>
        </div>
    </div>
</div>