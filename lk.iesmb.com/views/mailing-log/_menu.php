<?= \yii\widgets\Menu::widget([
    'items' => [
        ['label' => Yii::t('app', 'Suppliers'), 'url' => ['/supplier/index']],
        ['label' => Yii::t('app', 'Suppliers groups'), 'url' => ['/supplier-group/index']],
    ],
    'options' => [
        'class' => 'suppliers-menu nav nav-pills',
    ],
]); ?>