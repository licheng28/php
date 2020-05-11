<?php

/* @var $this yii\web\View */

$this->title = 'autosp';

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

    <form id="formdata" action="index.php?r=data/autosp" method="get" style="width: auto;">
        <!--        <input type="hidden" name="r" value="data/index">-->
        <input class="form-control" type="text"  name="k" placeholder="差价" value="<?php echo $k?>" style="float: left;width: 250px;">
        <button type="submit" class="btn btn-primary" style="float: left;margin-left: 10px;">submit</button>
        <span style="margin-left: 20px;height: 50px;">
        </span>
    </form>

    <a href="javascript:;">
        <button class="updateall btn btn-danger" data-idstr="" data-url="index.php?r=data/updateh1z1" style="margin-left: 400px;margin-top: -32px;">updateall</button>
    </a>

</div>
<body class="content-container">

<div class="site-index"  style="margin-top:20px;">
    <table class="table">
        <tr class="accordion">
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['name']?></td>
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['img']?></td>
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['price_igxe']?></td>
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['price_c5']?></td>
<!--            <td class="table-danger">--><?php //echo \app\models\PriceDifference::attributeLabels()['difference']?><!--</td>-->
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['is_sell']?></td>
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['purchase_c5']?></td>
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['sell_time']?></td>
            <td class="table-danger">操作</td>
        </tr>

        <?php foreach($model as $data){?>

            <tr class="accordion">
                <td class="table-danger">
                    <a target="_blank" href="https://www.c5game.com/dota/<?php echo $data['item_id_c5']?>-S.html">
                        <?php echo $data['name']?>
                    </a>
                </td>
                <td class="table-danger ">
                    <?php if($data['appid'] == 570):?>
                    <a target="_blank" href="https://www.igxe.cn/product/570/<?php echo $data['item_id_igxe']?>">
                        <?php else: ?>
                        <a target="_blank" href="https://www.igxe.cn/product/433850/<?php echo $data['item_id_igxe']?>">
                            <?php endif ?>
                            <img src="<?php echo $data['img']?>" style="width: 58px;">
                        </a>
                </td>
                <td class="table-danger <?php echo $data['id'].'_ig'?>"><?php echo $data['price_igxe']/100?></td>
                <td class="table-danger <?php echo $data['id'].'_c5'?>"><?php echo $data['price_c5']/100?></td>
<!--                <td class="table-danger --><?php //echo $data['id'].'_difference'?><!--">--><?php //echo $data['difference']/100?><!--</td>-->
                <td class="table-danger <?php echo $data['id'].'_sell'?>"><?php echo \app\models\PriceDifference::getSellMsg($data['is_sell'])?></td>
                <td class="table-danger <?php echo $data['id'].'_purchase'?>"><?php echo $data['purchase_c5']/100?></td>
                <td class="table-danger <?php echo $data['id'].'_selltime'?>"><?php echo $data['sell_time']?></td>
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
                    <button class="btn update" id="<?php echo $data['id']?>" data-url="index.php?r=data/update">update</button>
                    <button class="btn btn-info buy" data-id="<?php echo $data['id']?>" data-url="index.php?r=data/buy">buy</button>
                    <button class="btn btn-warning purchase" data-id="<?php echo $data['id']?>" data-url="index.php?r=data/purchase">purchase</button>
                </td>
            </tr>
        <?php }?>

    </table>
</div>
</body>


<?php //echo LinkPager::widget([
//    'pagination' => $pages,
//    'firstPageLabel' => '首页',
//    'lastPageLabel' => '尾页',
//    'maxButtonCount' =>8,
//]); ?>

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
//                    $("."+data.id+"_difference").html(data.difference/100);
                    $("."+data.id+"_sell").html(data.sell);
                    $("."+data.id+"_purchase").html(data.price_p);
                    $("."+data.id+"_selltime").html(data.sell_time);

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

        $('.updateall').click(function(){

            $(this).attr('disabled','');
            var url = $(this).data('url');
            var $this = $(this);

            $.post(url,{},function(data){

                if(data){

                    location.reload();
                }

                $this.removeAttr('disabled');

            })

        })

    })

</script>

