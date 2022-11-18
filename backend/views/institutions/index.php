<?php

use common\components\AddInstitutionsForm;
use common\components\InstitutionsGrid;

?>
<div class="row r-index">
    <div class="col-md-7">
        <?= InstitutionsGrid::widget(['toggleRow' => $gridIndex]); ?>
    </div>
    <div class="col-md-4">
        <?= AddInstitutionsForm::widget(); ?>
    </div>
</div>