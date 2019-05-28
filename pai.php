<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/21 0021
 * Time: 15:43
 */
date_default_timezone_set("Asia/Shanghai");
set_time_limit(0);
index();

function index(){

    $url = 'https://www.c5game.com/user/purchase/index.html';
//    $cookie = 'C5Machines=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; C5Lang=zh; C5Appid=570; C5Notice1558575896=close; C5Sate=29899df08071363644fe55e1e682693ad0d980eca%3A4%3A%7Bi%3A0%3Bs%3A6%3A%22253352%22%3Bi%3A1%3Bs%3A11%3A%2218758000957%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5SessionID=oqmjotlbf6flvv3tgpt9smm1r5; C5Token=5cebe430de6b7; C5Login=253352; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1558891615,1558891662,1558891775,1558963252; C5_NPWD=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1558974326';
//    $pwd = 328928;
    $cookie = 'C5Lang=zh; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1556181926; C5NoticeBounces1556170168=close; C5Appid=570; C5SessionID=rcl4ss5tpvq9deieti9cfm80f7; C5Sate=9dac2228e8e1038ef95eb42cb26dd526540df83ba%3A4%3A%7Bi%3A0%3Bs%3A9%3A%22557376709%22%3Bi%3A1%3Bs%3A10%3A%22brave_five%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5Token=5cc174f589f60; C5Login=557376709; C5Machines=Wl4MOBJaQ0Fj%2F3qKBDxJGciO%2Bfd%2BvowCOflGnn8qGYs%3D; C5_NPWD=0QRrydA06t9FYzzO7qR%2FNA%3D%3D; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1556182330';
    $pwd = 679578;


    $html = curl($url, $cookie);

//    require_once  'D:/workspace/php/simple_html_dom.php';
    include_once ('/var/git/licheng.git/php/simple_html_dom.php');
//$html = file_get_html('https://www.c5game.com');//获取html
    $dom = new simple_html_dom(); //new simple_html_dom对象
    $dom->load($html);  //加载html
    // Find all images
    $page_count = 1;
    foreach($dom->find('ul li.last a') as $e){

        $page_count = $e->href;

        $page_count = getNum($page_count, '*');

        break;

    }
    $purchase = array();
    $j = 0;
    $i = 1;

    if(!$page_count){

        $page_count = 1;

    }

    for($page=1;$page<=$page_count;$page++){

        $url = 'https://www.c5game.com/user/purchase/index.html?page='.$page;

        $html = curl($url, $cookie);

        $dom->load($html);

        foreach($dom->find('tr td') as $element) {

            if($i == 2|| $i==3||$i==6){

                if($i == 6){

                    $a = $element->first_child()->outertext;

                    preg_match_all('/(data-id|data-item_id)=("[^"]*")/i', $a, $matches);

                    $purchase[$j]['purchase_id'] = getNum($matches[2][0]);
                    $purchase[$j]['item_id'] = getNum($matches[2][1]);

                }elseif($i == 3){

                    $result = getNum($element);

                    $purchase[$j]['max_price'] = $result;

                }else{

                    $result = getNum($element->first_child()->innertext);

                    $purchase[$j]['price'] = $result;
                }


            }

            $i++;

            if($i == 7){

                $i = 1;

                $j++;

            }

        }

        $dom->clear();

    }

    $key = 1;

    foreach($purchase as $data){

        if($data){

//            if($data['price'] == $data['max_price']){
//
//                continue;
//
//            }

            changePurchasePrice($data, $cookie, $pwd);

        }

        $key++;

        if($key>10){

            sleep(1);

            $key = 1;

        }

    }



}
/*
 *
 */


function getNum($element,$punctuation='.'){

    if($punctuation){

        $p = $punctuation;

    }

    $element=trim($element);
    if(empty($element)){return '';}
    $result='';
    for($i=0;$i<strlen($element);$i++){
        if(is_numeric($element[$i]) || $element[$i] == $p){
            $result.=$element[$i];
        }
    }

    return $result;

}

/*
 *
 */

function changePurchasePrice($data, $cookie, $pwd){

    $item_id = $data['item_id'];

    $file  = 'D:\workspace/log.txt';

    if(!$item_id){

        echo '<br>';

        $message = '获取item信息失败';

        echo $message;

//        $time = date("Y-m-d h:i:sa");
//
//        file_put_contents($file, $message.' '.$time."\n",FILE_APPEND);

        return;

    }

    $purchase_id = $data['purchase_id'];

//    $url = 'https://www.c5game.com/dota/'.$item_id.'-S.html';
//
//    $html = curl($url, $cookie);
//
//    $dom = new simple_html_dom();
//
//    $dom->load($html);
//
//    foreach($dom->find('#sale-body') as $element){
//
//        echo '<pre>';
//        echo $element->innertext;
//
//    }

//取消求购

    $message = '';

    $url_cancel = 'https://www.c5game.com/api/purchase/cancel';

    $data_cancel = array(

        'id' => $purchase_id

    );

    $res = curl($url_cancel, $cookie, $data_cancel);

    if($res){

        $res = json_decode($res);

        $message =  $res->{'message'};

    }

//发布求购

    $url_purchase_item = 'https://www.c5game.com/api/purchase/item';

    $data_item = array(

        'id' => $item_id

    );

    $content = curl($url_purchase_item, $cookie, $data_item);

    if($content){

        $content = json_decode($content);

        $name = $content->{'body'}->{'item'}->{'name'};

        $sell_min_price = $content->{'body'}->{'item'}->{'sell_min_price'};

        $purchase_max_price = $content->{'body'}->{'item'}->{'purchase_max_price'};

        if($sell_min_price&&$purchase_max_price){

            if($purchase_max_price/$sell_min_price<0.94||$sell_min_price-$purchase_max_price>=2){

                if($purchase_max_price>100){

                    $is_purchase = $purchase_max_price-$data['price']>10?false:true;

                    $improve_price = 1;

                }elseif($purchase_max_price>=1&&$purchase_max_price<=100){

                    $is_purchase = $purchase_max_price-$data['price']>3?false:true;

                    $improve_price = 0.1;

                }else{

                    $is_purchase = $purchase_max_price-$data['price']>0.5?false:true;

                    $improve_price = 0.01;
                }

                if($is_purchase){

                    $url_purchase_submit = 'https://www.c5game.com/api/purchase/submit';

                    $purchase_data = array(

                        'price' => $purchase_max_price+$improve_price,
                        'num' => 1,
                        'paypwd' => $pwd,
                        'delivery' => 'on',
                        'id' => $item_id,//item_id
                        'appid' => 570,

                    );

                    curl($url_purchase_submit, $cookie, $purchase_data);

                    $message = $message .'  发布求购成功,物品名称 = '.$name.',花费金额:'.$purchase_data['price'];

                }else{

                    $message = $message.'&nbsp'.$name.'求购价与新求购价价格相差过高';

                }

            }else{

                $message = $message.'  求购价太高取消求购，物品名称 = '.$name;

            }

        }else{

            $message = $message.'&nbsp'.$name. '没有求购或没有在售';

        }

    }else{

        $message = $message.'&nbsp没有物品信息';

    }


    echo '<br>';
//    $message = iconv("UTF-8","gbk//TRANSLIT",$message);
    echo $message;
//    $time = date("Y-m-d h:i:sa");
//    file_put_contents($file, $message.' '.$time."\n",FILE_APPEND);

}

/*
 *
 */

function curl($url, $cookie,$data=array()){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
//    curl_setopt($curl,CURLOPT_HEADER,1);
    curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    if($data){

        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);

    }

    $html =  curl_exec($curl);

    curl_close($curl);

    return $html;

}

function unicode_decode($name)
{
    // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches))
    {
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++)
        {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0)
            {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code).chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            }
            else
            {
                $name .= $str;
            }
        }
    }
    return $name;
}



