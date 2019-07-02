<?php
/**
 * Created by PhpStorm.
 * User: licheng
 * Date: 2019/6/26
 * Time: 23:45
 */
$this->title = 'create';
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php
echo Html::a('创建', '#', [
    'id' => 'create',
    'data-toggle' => 'modal',
    'data-target' => '#create-modal',
    'class' => 'btn btn-success',
]);

?>

<?php
Modal::begin([
    'id' => 'create-modal',
    'header' => '<h4 class="modal-title">创建</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]);
//$requestUrl = Url::toRoute('create');
//$js = <<<JS
//$.get('{$requestUrl}', {},
//function (data) {
//$('.modal-body').html(data);
//}
//);
//JS;
//$this->registerJs($js);
Modal::end();

?>
