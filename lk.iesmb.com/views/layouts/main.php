<?php
use yii\helpers\Html;
use app\widgets\MainMenu;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'IESMB',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo MainMenu::widget(['options'=>['class' => 'navbar-nav navbar-right']]);
            NavBar::end();
        ?>

        <div class="container">
            <?php if(Yii::$app->session->hasFlash('success')):?>
                <?=Alert::widget([
                    'options' => [
                        'class' => 'alert-success',
                    ],
                    'body' => Yii::$app->session->getFlash('success'),
                ]);?>
            <?php endif; ?>
            <?php if(Yii::$app->session->hasFlash('error')):?>
                <?=Alert::widget([
                    'options' => [
                        'class' => 'alert-error',
                    ],
                    'body' => Yii::$app->session->getFlash('error'),
                ]);?>
            <?php endif; ?>

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; IESMB <?= date('Y') ?></p>
            <p class="pull-right">Создано <a href="http://iesmb.com" target="_blank">iesmb.com</a></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
