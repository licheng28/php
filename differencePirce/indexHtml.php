</<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
<!--    <script src="--><?php //echo $_SERVER['DOCUMENT_ROOT']?><!--/differencePirce/jquery-3.4.1.js"></script>-->
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>

<table>
    <tr>
        <td>名称</td>
        <td>差价</td>
        <td>操作</td>
    </tr>
    <?php foreach($result as $data){?>
    <tr>
        <td><?php echo $data['name']?></td>
        <td><?php echo $data['difference']?></td>
        <td>
            <span class="update">更新</span>
            <button url="index/buy" name="<?php echo $data['name']?>">购买</button>
        </td>
    </tr>
    <?php }?>
</table>

</body>
</html>


<script>

    $(document).ready(function(){

        $("button").click(function(){

            var url = $(this).attr("url");

            var name = $(this).attr("name");

            $.post(url, name, function(data){

                alert(data);

            })
        })

    })

</script>