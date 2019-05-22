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
                <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['price_igxe']?></td>
                <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['price_c5']?></td>
                <td class="table-danger"><?php echo \app\models\PriceDifference::attributeLabels()['difference']?></td>
                <td class="table-danger">操作</td>
            </tr>

            <?php foreach($model as $data){?>

                <tr class="accordion">
                    <td class="table-danger"><?php echo $data->name?></td>
                    <td class="table-danger"><?php echo $data->price_igxe/100?></td>
                    <td class="table-danger"><?php echo $data->price_c5/100?></td>
                    <td class="table-danger"><?php echo $data->difference/100?></td>
                    <td>
                        <button class="button update" id="<?php echo $data->id?>" data-url="index.php?r=data/update">update</button>
                        <button class="button buy">buy</button>
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

            $.post(url, {id:id}, function(){



            })

        })



    })

</script>
