<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/26 0026
 * Time: 14:06
 */
include_once('D:\workspace/base.php');
include_once ('D:\workspace/simple_html_dom.php');
set_time_limit(0);
//index();
//findC5();
findC5New();
function index(){

//    $url = 'https://www.igxe.cn/dota2/570?tags_type_name=%E6%8D%86%E7%BB%91%E5%8C%85&tags_type_id=1027&is_buying=0&is_stattrak%5B%5D=0&is_stattrak%5B%5D=0&sort=2&ctg_id=0&type_id=0&page_no=1&page_size=1000&rarity_id=0&exterior_id=0&quality_id=0&capsule_id=0&_t=1556266391326';

    $url = 'https://www.igxe.cn/dota2/570?quality_name=%E6%A0%87%E5%87%86&is_buying=0&is_stattrak%5B%5D=0&is_stattrak%5B%5D=0&sort=2&ctg_id=0&type_id=0&page_no=1&page_size=20&rarity_id=0&exterior_id=0&quality_id=954&capsule_id=0&_t=1556600696201';

    $base = new base();

    $html = $base->curl($url,array(),'ig');

    $dom = new simple_html_dom();

    $dom->load($html);

    foreach($dom->find('.dota') as $e){

        $href = $e->href;

        $href_array = explode('/', $href);

        $item_id = $href_array[3];

        $name = $e->children(1)->innertext;

        $price1 = $e->children(2)->first_child()->children(1)->innertext;
        $price2 = $e->children(2)->first_child()->children(2)->innertext;

        $price = $price1.$price2;

        try{

            $pdo = new PDO("mysql:host=localhost;dbname=lic","root","");

            $pdo->exec('set names utf8');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql_is = "select id from price_difference where item_id_igxe ="."$item_id";

            $res = $pdo->query($sql_is);

            if(!$res->fetch()){

                $time = time();

                $sql = "insert into price_difference (`name`,item_id_igxe,price_igxe,update_time,creat_time) VALUES (\"".$name."\",".$item_id.",".$price.", ".$time.",".$time.")";

                if($pdo->exec($sql)){

                    echo '添加成功';

                }else{

                    echo '添加失败';
                }

            }else{

                $sql_update = "update price_difference set price_igxe=".$price." where item_id_igxe =".$item_id;

                if($pdo->exec($sql_update)){

                    echo '更新成功';

                }else{

                    echo '价格未改变';

                }

            }

        }catch (PDOException $e){

            echo $e->getMessage();

        }

        $dom->clear();



    }

}

function findC5(){

    try{

        $sql = "select * from price_difference order by update_time limit 20";

        $pdo = new PDO("mysql:host=localhost;dbname=lic","root","");

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->exec('set names utf8');

        $res = $pdo->query($sql);

        $result = $res->fetchAll(PDO::FETCH_ASSOC);

        $base = new base();

        foreach($result as $data){

            $name = $data['name'];

            $url = 'https://www.c5game.com/dota.html?k='.$name;

            $html = $base->curl($url);

            $dom = new simple_html_dom();

            $dom->load($html);

            foreach($dom->find('.selling') as $e){

                $name_c5 = $e->children(1)->first_child()->first_child()->innertext;

                if($name==$name_c5){

                    $item_id_c5 = $base->getNum($e->first_child()->href, '*');

                    $price = $e->children(2)->first_child()->first_child()->innertext;

                    $price = $base->getNum($price);

                    $time = time();

                    $difference_price=$data['price_igxe']-$price;

                    $sql_update = "update price_difference set item_id_c5=".$item_id_c5.", price_c5=".$price.", update_time=".$time.", difference=".$difference_price." where id=".$data['id'];

                    if($pdo->exec($sql_update)){

                        $message = '更新成功';

                        $message = iconv("UTF-8","gbk//TRANSLIT",$message);

                        echo $message;

                    }else{

                        echo 'error';

                    }

                }

            }

            $dom->clear();


        }

    }catch (PDOException $e){

        echo $e->getMessage();

    }

}

function findC5New(){

    try{

        $page = 50;

        while($page<100){

//            $url = 'https://www.c5game.com/dota.html?type=bundle&page='.$page.'&sort=price.desc';

            $url = 'https://www.c5game.com/dota.html?sort=price.desc&quality=unique&page='.$page;

            $base = new base();

            $html = $base->curl($url);

            $pdo = new PDO("mysql:host=localhost;dbname=lic","root","");

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->exec('set names utf8');

            $dom = new simple_html_dom();

            $dom->load($html);

            foreach($dom->find('.selling') as $e){

                $name_c5 = $e->children(1)->first_child()->first_child()->innertext;

                $price = $e->children(2)->first_child()->first_child()->innertext;

                $price = $base->getNum($price);

                $item_id_c5 = $base->getNum($e->first_child()->href, '*');

                $update_time = time();

                $sql = "select * from price_difference where `name`=\"".$name_c5."\"";

                $res = $pdo->query($sql);

//            $num = $res->rowCount();
//
//            print_r($num);die;

                $result = $res->fetch();

                if($result){

                    $difference = $result['price_igxe']?$result['price_igxe']-$price:$price;

                    $sql_update = "update price_difference set price_c5=".$price.", update_time="."$update_time".", difference=".$difference." item_id_c5=".$item_id_c5." where id=".$result['id'];

                    if($pdo->exec($sql_update)){

                        $message = '更新成功';

//                $message = iconv("UTF-8","gbk//TRANSLIT",$message);

                        echo $message;

                    }else{

                        echo 'error';

                    }


                }else{

                    $item_id_c5 = $base->getNum($e->first_child()->href, '*');

                    $creat_time = $update_time;

                    $sql_insert = "insert into price_difference (`name`, item_id_c5, price_c5, update_time, creat_time) VALUES (\"".$name_c5."\", ".$item_id_c5.", ".$price.",".$update_time.", ".$creat_time.")";

                    if($pdo->exec($sql_insert)){

                        echo "添加成功";

                    }else{

                        echo "error";
                    }

                }

            }

            $page++;
        }

    }catch (PDOException $e){

        echo $e->getMessage();

    }


}


