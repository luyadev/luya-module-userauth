<?php
use luya\helpers\Html;
use luya\userauth\frontend\Module;
use yii\widgets\ActiveForm;

/** @var luya\userauth\models\UserLoginForm $model */
?>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username'); ?>
    <?= $form->field($model, 'password')->passwordInput(); ?>
    <?= Html::submitButton(Module::t('userauth.controller.default.index.loginlabel')); ?>
<?php $form::end(); ?>