<?= \yii\widgets\Menu::widget([
    'items' => [
        ['label' => Yii::t('app', 'Suppliers groups'), 'url' => ['/supplier-group/index']],
        ['label' => Yii::t('app', 'Mailing log'), 'url' => ['/mailing-log/index']],
    ],
    'options' => [
        'class' => 'suppliers-menu nav nav-pills',
    ],
]); ?>