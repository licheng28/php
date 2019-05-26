<?php

/* @var $this yii\web\View */

$this->title = 'price_difference';
?>
<?php
use yii\widgets\LinkPager;
?>
<div class="site-index">
    <form id="formdata" action="" method="get">
        <input type="hidden" name="r" value="data/index">
        <input class="input-group-text" type="text"  name="k" placeholder="差价" value="<?php echo $k?>">
        <button type="submit">submit</button>
    </form>
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
                <td class="table-danger">操作</td>
            </tr>

            <?php foreach($model as $data){?>

                <tr class="accordion">
                    <td class="table-danger">
                        <a target="_blank" href="https://www.c5game.com/dota/<?php echo $data->item_id_c5?>-S.html">
                            <?php echo $data->name?>
                        </a>
                    </td>
                    <td class="table-danger "><img src="<?php echo $data->img?>" style="width: 58px;"></td>
                    <td class="table-danger <?php echo $data->id.'_ig'?>"><?php echo $data->price_igxe/100?></td>
                    <td class="table-danger <?php echo $data->id.'_c5'?>"><?php echo $data->price_c5/100?></td>
                    <td class="table-danger <?php echo $data->id.'_difference'?>"><?php echo $data->difference/100?></td>
                    <td class="table-danger <?php echo $data->id.'_sell'?>"><?php echo $data->is_sell?'是':'否'?></td>
                    <td>
                        <button class="button update" id="<?php echo $data->id?>" data-url="index.php?r=data/update">update</button>
                        <button class="button buy" data-id="<?php echo $data->id?>" data-url="index.php?r=data/buy">buy</button>
                        <button class="button purchase" data-url="index.php?r=data/purchase">purchase</button>
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


        $('.update').click(function(){

            var id = $(this).attr('id');
            var url = $(this).data('url');

            $.post(url, {id:id}, function(data){

                var data = eval("("+data+")");

                if(data){

                    $("."+data.id+"_ig").html(data.ig);
                    $("."+data.id+"_c5").html(data.c5);
                    $("."+data.id+"_difference").html(data.difference/100);

                    if(data.sell){

                        $("."+data.id+"_sell").html('是');

                    }else{

                        $("."+data.id+"_sell").html('否');

                    }

                }

            })

        })

        $('.buy').click(function(){

            var id = $(this).data('id');
            var url = $(this).data('url');

            $.post(url, {id:id}, function(data){

                var data = eval("("+data+")");

                if(data.status == 200){

                    alert(data.msg);

                }else{

                    alert(data.msg);
                }

            })



        })



    })

</script>
