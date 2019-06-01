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
?>
<?php
use yii\widgets\LinkPager;
?>
<div class="site-index">
    <form id="formdata" action="" method="get">
        <input type="hidden" name="r" value="data/replenish">
        <input class="input-group-text" type="text"  name="k" placeholder="差价" value="<?php echo $k?>">
        <button type="submit">submit</button>
    </form>
</div>
<body class="content-container">

<div class="site-index"  style="margin-top:20px;">

    <table class="table">
        <tr class="accordion">
            <td class="table-danger"><?php echo \app\models\Replenish::attributeLabels()['sell_day']?></td>
            <td class="table-danger"><?php echo \app\models\Replenish::attributeLabels()['status']?></td>
            <td class="table-danger"><?php echo \app\models\Replenish::attributeLabels()['fee']?></td>
            <td class="table-danger"><?php echo \app\models\Replenish::attributeLabels()['income_price']?></td>
            <td class="table-danger"><?php echo \app\models\Replenish::attributeLabels()['sold_time']?></td>
            <td class="table-danger">操作</td>
        </tr>

        <?php foreach($model as $data){?>

            <tr class="accordion">
                <td class="table-danger">
                    <a target="_blank" href="">
                        <?php echo date('Y-m-d', $data->sell_day)?>
                    </a>
                </td>
                <td class="table-danger "><img src="<?php echo $data->status?>" style="width: 58px;"></td>
                <td class="table-danger <?php echo $data->id.'_ig'?>"><?php echo $data->fee/100?></td>
                <td class="table-danger <?php echo $data->id.'_c5'?>"><?php echo $data->income_price/100?></td>
                <td class="table-danger <?php echo $data->id.'_difference'?>"><?php echo date('Y-m-d H:i:s', $data->sold_time)?></td>
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
                    <button class="button update" id="<?php echo $data->id?>" data-url="index.php?r=data/update">update</button>
                    <button class="button buy" data-id="<?php echo $data->id?>" data-url="index.php?r=data/buy">buy</button>
                    <button class="button purchase" data-id="<?php echo $data->id?>" data-url="index.php?r=data/purchase">purchase</button>
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
