<?php

/* @var $this yii\web\View */

$this->title = 'price_difference';

use yii\bootstrap\ButtonGroup;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php
use yii\widgets\LinkPager;
?>
<div class="site-index">

    <form id="formdata" action="" method="get" style="width: auto;">
<!--        <input type="hidden" name="r" value="data/index">-->
        <input class="form-control" type="text"  name="k" placeholder="差价" value="<?php echo $k?>" style="float: left;width: 250px;">
        <button type="submit" class="btn btn-primary" style="float: left;margin-left: 10px;">submit</button>
        <span style="margin-left: 20px;height: 50px;">
            <input type="checkbox" name="bundle" <?php echo $bundle?'checked':''?>>只显示捆绑包
            <input type="checkbox" name="immortal" <?php echo $immortal?'checked':''?>>只显示不朽
            <input type="checkbox" name="unique" <?php echo $unique?'checked':''?>>只显示标准
<!--            <input type="checkbox" name="H1Z1" --><?php //echo $H1Z1?'checked':''?><!-->
<!--            只显示H1Z1-->
            <input type="checkbox" name="sort" <?php echo $sort?'checked':''?>>按名称排序
        </span>
    </form>
    <a class="btn btn-success updateData" href="index.php?r=data/bundle&type=<?php echo \app\models\PriceDifference::TYPE_BUNDLE?>" style="margin-left: 400px;margin-top: -32px;">捆绑包</a>
    <a class="btn btn-default updateData" href="index.php?r=data/bundle&type=<?php echo \app\models\PriceDifference::TYPE_UNIQUE?>" style="margin-top: -32px;">标准</a>
    <a class="btn btn-danger updateData" href="index.php?r=data/bundle&type=<?php echo \app\models\PriceDifference::TYPE_GENUINE?>" style="margin-top: -32px;">纯正</a>
    <a class="btn btn-warning updateData" href="index.php?r=data/bundle&type=<?php echo \app\models\PriceDifference::TYPE_IMMORTAL?>" style="margin-top: -32px;">不朽</a>
<!--    <a class="btn btn-primary updateData" href="" style="margin-top: -32px;">UPDATEALL</a>-->
<!--    <a class="btn btn-info updateData" href="index.php?r=data/bundle&type=--><?php //echo \app\models\PriceDifference::TYPE_H1Z1?><!--" style="margin-top: -32px;">H1Z1</a>-->
</div>
<body class="content-container">

    <div class="site-index"  style="margin-top:20px;">
        <table class="table">
            <tr class="accordion">
                <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['name']?></td>
                <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['img']?></td>
                <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['price_igxe']?></td>
                <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['price_c5']?></td>
                <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['difference']?></td>
                <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['is_sell']?></td>
                <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['purchase_c5']?></td>
                <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['price_buff']?></td>
                <td class="table-danger">操作</td>
            </tr>

            <?php foreach($model as $data){?>

                <tr class="accordion">
                    <td class="table-danger">
                        <a target="_blank" href="https://www.c5game.com/dota/<?php echo $data->item_id_c5?>-S.html">
                            <?php echo $data->name?>
                        </a>
                    </td>
                    <td class="table-danger ">
                        <?php if($data->appid == 570):?>
                            <a target="_blank" href="https://www.igxe.cn/product/570/<?php echo $data->item_id_igxe?>">
                        <?php else: ?>
                            <a target="_blank" href="https://www.igxe.cn/product/433850/<?php echo $data->item_id_igxe?>">
                        <?php endif ?>
                            <img src="<?php echo $data->img?>" style="width: 58px;">
                        </a>
                    </td>
                    <td class="table-danger <?php echo $data->id.'_ig'?>"><?php echo $data->price_igxe/100?></td>
                    <td class="table-danger <?php echo $data->id.'_c5'?>"><?php echo $data->price_c5/100?></td>
                    <td class="table-danger <?php echo $data->id.'_difference'?>"><?php echo $data->difference/100?></td>
                    <td class="table-danger <?php echo $data->id.'_sell'?>"><?php echo \app\models\PriceDifference::getSellMsg($data->is_sell)?></td>
                    <td class="table-danger <?php echo $data->id.'_purchase'?>"><?php echo $data->purchase_c5/100?></td>
                    <td class="table-danger "><a target='_blank' class="url_change"  href="https://buff.163.com/market/goods?goods_id=<?php echo $data->item_id_buff?>"><span class="<?php echo $data->id.'_buff'?>"><?php echo $data->price_buff/100?></span></a></td>
                    <td>
<!--                        --><?php
//                            echo ButtonGroup::widget([
//                            'buttons' => [
//                                ['label' => '按钮A'],
//                                ['label' => '按钮B'],
//                                ['label' => '隐藏按钮C', 'visible' => false],
//                            ]
//                        ]);
//                        ?>
                        <button class="btn update" id="<?php echo $data->id?>" data-url="index.php?r=data/update">update</button>
                        <button class="btn btn-info buy" data-id="<?php echo $data->id?>" data-url="index.php?r=data/buy">buy</button>
                        <button class="btn btn-warning purchase" data-id="<?php echo $data->id?>" data-url="index.php?r=data/purchase">purchase</button>
                    </td>
                </tr>
            <?php }?>

        </table>
    </div>
</body>


<?php echo LinkPager::widget([
    'pagination' => $pages,
    'firstPageLabel' => '首页',
    'lastPageLabel' => '尾页',
    'maxButtonCount' =>8,
]); ?>

<script>

    $(document).ready(function(){

        $('.updateData').click(function(){

            $(this).attr('disabled','');

        })

        $('.purchase').click(function(){

            $(this).attr('disabled','');
            var id = $(this).data('id');
            var url = $(this).data('url');
            var $this = $(this);

            $.post(url, {id:id}, function(data){

                var data = eval("("+data+")");

                alert(data.msg);

            })

            $this.removeAttr('disabled');

        })


        $('.update').click(function(){

            $(this).attr('disabled','');
            var id = $(this).attr('id');
            var url = $(this).data('url');
            var $this = $(this);

            $.post(url, {id:id}, function(data){

//                var data = eval("("+data+")");

                if(data){

                    $("."+data.id+"_ig").html(data.ig);
                    $("."+data.id+"_c5").html(data.c5);
                    $("."+data.id+"_difference").html(data.difference/100);
                    $("."+data.id+"_sell").html(data.sell);
                    $("."+data.id+"_purchase").html(data.price_p);
                    $("."+data.id+"_buff").html(data.price_buff);
                    $('.url_change').attr('href', 'https://buff.163.com/market/goods?goods_id='+data.item_id_buff);

                }

               $this.removeAttr('disabled');

            },'json')

        })

        $('.buy').click(function(){

            $(this).attr('disabled','');
            var id = $(this).data('id');
            var url = $(this).data('url');
            var $this = $(this);

            $.post(url, {id:id}, function(data){

                var data = eval("("+data+")");

                alert(data.msg);

                $this.removeAttr('disabled');

            })

        })

    })

</script>

