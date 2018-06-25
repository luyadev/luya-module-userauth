<?php
use yii\widgets\ActiveForm;
use luya\helpers\Html;

/** @var luya\userauth\models\UserLoginForm $model */
?>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username'); ?>
    <?= $form->field($model, 'password')->passwordInput(); ?>
    <?= Html::submitButton('Login'); ?>
<?php $form::end(); ?>