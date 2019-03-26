<?= \yii\widgets\Menu::widget([
    'items' => [
        ['label' => Yii::t('app', 'Suppliers'), 'url' => ['/supplier/index']],
        ['label' => Yii::t('app', 'Mailing log'), 'url' => ['/mailing-log/index']],
    ],
    'options' => [
        'class' => 'suppliers-menu nav nav-pills',
    ],
]); ?>