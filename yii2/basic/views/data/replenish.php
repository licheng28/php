<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/1 0001
 * Time: 15:45
 */
/* @var $this yii\web\View */

$this->title = 'replenish';

use yii\bootstrap\ButtonGroup;
use yii\bootstrap\Button;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;
?>
<?php
use yii\widgets\LinkPager;
?>
<div class="site-index">
    <a href="index.php?r=data/update-sold&start_time=<?php echo $day?>">
        <button class="updatesold btn btn-success">updatesold</button>
    </a>
    <form id="formdata" action="" method="get">
        <input type="hidden" name="r" value="data/replenish">
<!--        <input class="input-group-text" type="text"  name="k" placeholder="差价" value="--><?php //echo $k?><!--">-->
        <?php echo DatePicker::widget([
            'name' => 'start_time',
            'options' => ['placeholder' => '起始日期'],
            //value值更新的时候需要加上
            'value' => $day,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
            ]
        ]); ?>
        <button type="submit">submit</button>
    </form>

</div>
<body class="content-container">

<div class="site-index"  style="margin-top:20px;">

    <table class="table">
        <tr class="accordion">
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['name']?></td>
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['img']?></td>
<!--            <td class="table-danger">--><?php //echo \app\models\Replenish::attributeLabels()['fee']?><!--</td>-->
            <td class="table-danger"><?php echo \app\models\Replenish::attributeLabels()['income_price']?></td>
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['price_igxe']?></td>
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['price_c5']?></td>
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['purchase_c5']?></td>
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['difference']?></td>
            <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['is_sell']?></td>
            <td class="table-danger"><?php echo \app\models\Replenish::attributeLabels()['sold_time']?></td>
            <td class="table-danger">操作</td>
        </tr>

        <?php foreach($model as $data){?>

            <tr class="accordion">
                <td class="table-danger">
                    <a target="_blank" href="https://www.c5game.com/dota/<?php echo $data->itemInfo['item_id_c5']?>-S.html">
                        <?php echo $data->itemInfo['name'];?>
                    </a>
                </td>
                <td class="table-danger ">
                    <a target="_blank" href="https://www.igxe.cn/product/570/<?php echo $data->item_id_igxe?>">
                        <img src="<?php print_r($data->itemInfo['img']) ?>" style="width: 48px;">
                    </a>
                </td>
<!--                <td class="table-danger">--><?php //print_r($data->fee/100) ?><!--</td>-->
                <td class="table-danger"><?php echo $data->income_price/100?></td>
                <td class="table-danger <?php echo $data->itemInfo['id'].'_ig'?>"><?php echo $data->itemInfo['price_igxe']/100?></td>
                <td class="table-danger <?php echo $data->itemInfo['id'].'_c5'?>"><?php echo $data->itemInfo['price_c5']/100?></td>
                <td class="table-danger <?php echo $data->itemInfo['id'].'_purchase'?>"><?php echo $data->itemInfo['purchase_c5']/100?></td>
                <td class="table-danger <?php echo $data->itemInfo['id'].'_difference'?>"><?php echo $data->itemInfo['difference']/100?></td>
                <td class="table-danger <?php echo $data->itemInfo['id'].'_sell'?>"><?php echo \app\models\PriceDifference::getSellMsg($data->itemInfo['is_sell'])?></td>
                <td class="table-danger"><?php echo date('Y-m-d H:i:s', $data->sold_time)?></td>
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

                    <button class="btn update" id="<?php echo $data->itemInfo['id']?>" data-url="index.php?r=data/update">update</button>
                    <button class="btn btn-info buy" data-id="<?php echo $data->itemInfo['id']?>" data-url="index.php?r=data/buy">buy</button>
                    <button class="btn btn-warning purchase" data-id="<?php echo $data->itemInfo['id']?>" data-url="index.php?r=data/purchase">purchase</button>
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

                var data = eval("("+data+")");

                if(data){

                    $("."+data.id+"_ig").html(data.ig);
                    $("."+data.id+"_c5").html(data.c5);
                    $("."+data.id+"_difference").html(data.difference/100);
                    $("."+data.id+"_sell").html(data.sell);
                    $("."+data.id+"_purchase").html(data.price_p);

                }

                $this.removeAttr('disabled');

            })

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
