<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/26 0026
 * Time: 14:06
 */
include_once('D:\workspace/php/base.php');
include_once ('D:\workspace/php/simple_html_dom.php');
set_time_limit(0);
//index();
//findC5();
findC5New();
//completeC5();
//isSell();
function index(){

//    $url = 'https://www.igxe.cn/dota2/570?tags_type_name=%E6%8D%86%E7%BB%91%E5%8C%85&tags_type_id=1027&is_buying=0&is_stattrak%5B%5D=0&is_stattrak%5B%5D=0&sort=2&ctg_id=0&type_id=0&page_no=1&page_size=1000&rarity_id=0&exterior_id=0&quality_id=0&capsule_id=0&_t=1556266391326';
//
//    $url = "https://www.igxe.cn/dota2/570?quality_name=%E7%BA%AF%E6%AD%A3&is_buying=0&is_stattrak%5B%5D=0&is_stattrak%5B%5D=0&sort=2&ctg_id=0&type_id=0&page_no=1&page_size=350&rarity_id=0&exterior_id=0&quality_id=1023&capsule_id=0&_t=1557129070760";
    $url = 'https://www.igxe.cn/dota2/570?quality_name=%E6%A0%87%E5%87%86&is_buying=0&is_stattrak%5B%5D=0&is_stattrak%5B%5D=0&sort=2&ctg_id=0&type_id=0&page_no=1&page_size=2500&rarity_id=0&exterior_id=0&quality_id=954&capsule_id=0&_t=1556600696201';

    $base = new base();

    $html = $base->curl($url,array(),'ig');

    $dom = new simple_html_dom();

    $dom->load($html);

    foreach($dom->find('.dota') as $e){

        $href = $e->href;

        $href_array = explode('/', $href);

        $item_id = $href_array[3];

        $src = $e->first_child()->first_child()->src;

        $name = $e->children(1)->innertext;

        $price1 = $e->children(2)->first_child()->children(1)->innertext;
        $price2 = $e->children(2)->first_child()->children(2)->innertext;

        $price = $price1.$price2;

        $price = $price*100;

        try{

            $pdo = new PDO("mysql:host=47.97.253.197;dbname=lic_test","root","root");

            $pdo->exec('set names utf8');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql_is = "select * from price_difference where `name` ='".$name."'";

            $res = $pdo->query($sql_is);

            $result = $res->fetch();

            if(!$result){

                $time = time();

                $sql = "insert into price_difference (`name`,item_id_igxe,price_igxe,update_time,creat_time, img) VALUES (\"".$name."\",".$item_id.",".$price.", ".$time.",".$time.", \"".$src."\")";

                if($pdo->exec($sql)){

                    echo '添加成功';

                }else{

                    echo '添加失败';
                }

            }else{

                $difference = $result['price_c5']?$price-$result['price_c5']:-$price;

                $sql_update = "update price_difference set item_id_igxe=".$item_id.", price_igxe=".$price.",difference=".$difference." where id =".$result['id'];

                if($pdo->exec($sql_update)){

                    echo '更新成功';

                }else{

                    echo '价格未改变';

                }

            }

        }catch (PDOException $e){

            echo $e->getMessage();

        }

    }

    $dom->clear();

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

                    $price = $price*100;

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

        $page = 1;

        while($page<101){

//            $url = "https://www.c5game.com/dota.html?quality=genuine&page=".$page."&sort=price.desc";

//            $url = 'https://www.c5game.com/dota.html?type=bundle&page='.$page.'&sort=price.desc';

            $url = 'https://www.c5game.com/dota.html?sort=price.desc&quality=unique&page='.$page;

            $base = new base();

            $html = $base->curl($url);

            $pdo = new PDO("mysql:host=47.97.253.197;dbname=lic_test","root","root");

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->exec('set names utf8');

            $dom = new simple_html_dom();

            $dom->load($html);

            foreach($dom->find('.selling') as $e){

                $name_c5 = $e->children(1)->first_child()->first_child()->innertext;

                $price = $e->children(2)->first_child()->first_child()->innertext;

                $price = $base->getNum($price);

                $price = $price*100;

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

                    $sql_update = "update price_difference set price_c5=".$price.", update_time="."$update_time".", difference=".$difference.", item_id_c5=".$item_id_c5." where id=".$result['id'];

                    if($pdo->exec($sql_update)){
                        $message = '更新成功';
//                $message = iconv("UTF-8","gbk//TRANSLIT",$message);
                        echo $message;
                    }else{
                        echo 'error';
                    }
                }else{
                    $item_id_c5 = $base->getNum($e->first_child()->href, '*');

                    $src = $e->first_child()->children(1)->src;

                    $creat_time = $update_time;

                    $sql_insert = "insert into price_difference (`name`, item_id_c5, price_c5, update_time, creat_time, img) VALUES (\"".$name_c5."\", ".$item_id_c5.", ".$price.",".$update_time.", ".$creat_time.",\"".$src."\")";

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

function completeC5(){

    try{

        $pdo = new PDO("mysql:host=localhost;dbname=lic","root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('set names utf8');

        $sql = "select * from price_difference where price_c5=0 ORDER by update_time limit 50";

        $res = $pdo->query($sql);

        $result = $res->fetchAll(PDO::FETCH_ASSOC);

        $base = new base();

        foreach($result as $data){

            $pdo->exec("update price_difference set update_time=".time()." where id = ".$data['id']);

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

                    $price = $price*100;

                    $time = time();

                    $difference_price=$data['price_igxe']-$price;

                    $sql_update = "update price_difference set item_id_c5=".$item_id_c5.", price_c5=".$price.", update_time=".$time.", difference=".$difference_price." where id=".$data['id'];

                    if($pdo->exec($sql_update)){

                        $message = $name.'更新成功';

//                        $message = iconv("UTF-8","gbk//TRANSLIT",$message);

                        echo $message;
                        echo '<br>';

                    }else{

                        echo 'error';

                    }

                }

            }

            $dom->clear();


        }

    } catch (PDOException $e){

        echo $e->getMessage();

    }


}

function isSell($page=1,$count=1)
{

    try{

        if($page==1){

            $url = 'https://www.igxe.cn/sell/data/999999';

        }else{

            $url = 'https://www.igxe.cn/sell/data/999999?page_no='.$page;

        }


        $base = new base();

        $html = $base->curl($url,array(),'ig');

        $content = json_decode($html);

        $pdo = new PDO("mysql:host=localhost;dbname=lic","root","root");

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->exec('set names utf8');

        foreach($content->{'show_data'} as $value){

            $name = $value->{'name'};

            $sql = "update price_difference set is_sell=1 where `name`=\"".$name."\"";

            if($pdo->exec($sql)){

                echo '更新成功';

            }else{

                echo $name.'找不到信息或在售未改变';
            }

            $count++;

        }

        if($content->{'is_more'}){

            $page++;

            isSell($page, $count);

        }

        if(!$content->{'is_more'}){

            echo $count;

        }

    }catch(PDOException $e)

    {

        echo $e->getMessage();

    }

}

