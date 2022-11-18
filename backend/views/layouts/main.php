<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\components\LanguageSwitcher;
use common\components\SidebarItems;
use common\widgets\Alert;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap5\Modal;
use yii\bootstrap5\Offcanvas;
use yii\helpers\Url;

$this->registerJsVar(
    'urls',
    [
        'getColleges' => Url::toRoute(['colleges/colleges']),
        'addCollegeForm' => Url::toRoute(['colleges/add-form']),
        'editCollegeForm' => Url::toRoute(['colleges/edit-form']),
        'editInstitutionForm' => Url::toRoute(['institutions/edit-form']),
        'contentManagement' => Url::toRoute(['colleges/content-management']),
        'addSpecializationForm' => Url::toRoute(['specializations/add-form']),
    ],
    \yii\web\View::POS_HEAD
);
AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-row h-100">
    <?php $this->beginBody() ?>
    <header style="background-image:url('<?= Yii::getAlias('@images/sidebar_background.jpeg') ?>') ;">
        <?php
        $menuItems = [
            ['label' => FA::icon('home') . ' Dashboard', 'url' => ['/site/index']],
            ['label' => FA::icon('university') . ' Institutions', 'url' => ['/institutions/index']],
        ];

        $nav = Nav::widget([
            'items' => $menuItems,
            'options' => [
                'class' => 'd-flex flex-column'
            ]
        ]);
        echo SidebarItems::widget(['nav' => $nav]);
        ?>
    </header>
    <main>
        <div class="container c-header">
            <?php
            NavBar::begin([
                'options' => [
                    'class' => 'navbar navbar-expand-md',
                ],
            ]);
            echo Alert::widget();
            echo LanguageSwitcher::widget();
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                . Html::submitButton(
                    'Logout',
                    ['class' => 'btn btn-link logout text-decoration-none']
                )
                . Html::endForm();
            NavBar::end();
            ?>
        </div>
        <div class="container c-index">
            <?= $content; ?>
        </div>
    </main>
    <?php
    Modal::begin([
        'closeButton' => false,
        'options' => [
            'id' => 'helper-modal'
        ]
    ]);
    echo FA::icon('refresh', ['class' => 'fa-spin']);
    Modal::end();
    ?>
    <?php
    Offcanvas::begin([
        'options' => ['id' => 'helper-offcanvas', 'class' => 'w-50'],
        'closeButton' => false,
        'placement' => Offcanvas::PLACEMENT_END,
        'bodyOptions' => [
            'class' => 'd-flex flex-column'
        ]
    ]);
    echo '<h1>Loading...</h1>';
    echo FA::icon('refresh', ['class' => 'fa-spin m-auto']);
    Offcanvas::end();
    ?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
