<?php use yii\helpers\Html; ?>
<div class="row">
    <div class="col col-lg-12">
        <h4><?=Yii::t('app','Roles')?></h4>
        <?=Html::checkboxList('permissions',$permissions,\yii\helpers\ArrayHelper::map(Yii::$app->authManager->getItems(\yii\rbac\Role::TYPE_ROLE),'name','description'))?>
    </div>
    <div class="col col-lg-12">
        <h4><?=Yii::t('app','Permissions')?></h4>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <?php foreach($permissionsArray as $permissionName=>$permissionTitle): ?>
                <div class="col-lg-3">
                <?=$permissionTitle?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php foreach($identitiesArray as $identityName=>$identityTitle): ?>
            <div class="row">
                <div class="col-lg-3">
                <?=$identityTitle?>
                </div>
                <?php foreach($permissionsArray as $permissionName=>$permissionTitle): ?>
                    <?php $permission = $identityName.'-'.$permissionName; ?>
                    <div class="col-lg-3">
                        <?=Html::checkbox('permissions[]',in_array($permission,$permissions),['value'=>$permission])?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <hr />
        <?php foreach($customIdentitiesArray as $customIdentityName=>$customIdentityTitle): ?>
            <div class="row">
                <div class="col-lg-6">
                <?=$customIdentityTitle?>
                </div>
                <?php $permission = $customIdentityName; ?>
                <div class="col-lg-6">
                    <?=Html::checkbox('permissions[]',in_array($permission,$permissions),['value'=>$permission])?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
