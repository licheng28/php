<?php
/**
 * Created by PhpStorm.
 * User: licheng
 * Date: 2019/6/26
 * Time: 20:38
 */
use yii\helpers\Url;

$this->title = 'create';
?>

<body>

    <form action="" method="get">
        <input type="hidden" name="r" value="data/create">
        <div class="form-group">
            <label class="control-label">网站</label>
            <input type="text" name="name" value="ig" class="form-control" >
        </div>
        <div class="form-group">
            <label class="control-label">cookie</label>
            <textarea name="cookie"style="height: 200px;" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label class="control-label">密码</label>
            <input type="text" name="pwd" class="form-control" >
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success" style="margin-top: 20px;">提交</button>
        </div>
    </form>

</body>
