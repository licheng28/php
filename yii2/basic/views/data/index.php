<?php

/* @var $this yii\web\View */

$this->title = 'price_difference';
?>
<?php
use yii\widgets\LinkPager;
?>
<div class="site-index">

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
           <td class="table-danger"><?php echo $data->price_igxe?></td>
           <td class="table-danger"><?php echo $data->price_c5?></td>
           <td class="table-danger"><?php echo $data->difference?></td>
           <td>
               <button class="button update">update</button>
               <button class="button buy">buy</button>
           </td>
       </tr>
       <?php }?>

   </table>
</div>
<?php echo LinkPager::widget(['pagination' => $pages]); ?>

<script>

    $(document).ready(function(){


        $('.update').click(function(){

            alert('123');

        })



    })

</script>
