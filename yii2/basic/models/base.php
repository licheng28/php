<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/22 0022
 * Time: 16:03
 */
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\simple_html_dom;



class base extends Model
{

    var $cookie_c5 = 'C5Lang=zh; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1556181926; C5NoticeBounces1556170168=close; C5Appid=570; C5SessionID=rcl4ss5tpvq9deieti9cfm80f7; C5Sate=9dac2228e8e1038ef95eb42cb26dd526540df83ba%3A4%3A%7Bi%3A0%3Bs%3A9%3A%22557376709%22%3Bi%3A1%3Bs%3A10%3A%22brave_five%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5Token=5cc174f589f60; C5Login=557376709; C5Machines=Wl4MOBJaQ0Fj%2F3qKBDxJGciO%2Bfd%2BvowCOflGnn8qGYs%3D; C5_NPWD=0QRrydA06t9FYzzO7qR%2FNA%3D%3D; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1556182330';
//    var $cookie_c5 ='bdshare_firstime=1495112656374; fp_ver=3.3.3; BSFIT_OkLJUJ=FFBqPVR-F9hmdg-zTUxNdxvoJUwJAI8P; BSFIT_DEVICEID=By3w4BbUbCpg3rijooGXLYUOhJ5DbIgY7h-9Iq6K7SZb_AljkrSOAS6Powiq7grc0HqpCUH1xMZgru0nAZ2ZnLPRyMZXmGGUrXUz64wskn5a4JSz8s_FtruUXmHE1xJuDslfpLXtqyXPhJa5Ld9qQjM1WfGOVVGd; MEIQIA_EXTRA_TRACK_ID=0wnpBv1NMrGhzg6IkdfVZB6AYSP; buyKnowNotice=close; C5Machines=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; C5buygame=Y; C5Appid=570; C5Lang=zh; C5NoticeBounces1555403740=close; C5Notice1555403740=close; C5NoticeBounces1555558523=close; C5Notice1555558523=close; C5Steamurl=true; C5SessionID=n5saim7bo5ausckfbtgc8tff01; C5Sate=29899df08071363644fe55e1e682693ad0d980eca%3A4%3A%7Bi%3A0%3Bs%3A6%3A%22253352%22%3Bi%3A1%3Bs%3A11%3A%2218758000957%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5Token=5cbbff88bf9db; C5Login=253352; C5_NPWD=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1555473868,1555560364,1555745175,1555824487; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1555832787';
    var $cookie_ig = 'distribution_channel=681a3905060164114876; my_steam_game=570; __cfduid=d173e9333e80a5a60245cc291762ff5dc1531462579; my_game=570; agree_sell_agreementlic666=true; gdxidpyhxdE=pYCXqveN9uD5bfqNyQDwUYGblo4LPr2ibStEV6zlpJHE63gVOfz8tTZ2uu%5Cz%5CXbNbnPXNp%2BACb42C%2BhuA7vbqc6zVgdawdPBeZ3PN0xZQBnBuw9Q%2F%2BBUrMMzKLzfsJrz%2Fv95r6j9f3SfJe3CA7BjPTSHjzrN2%2BS%2FnwV3n%2B54js%5CEVLfO%3A1558239691886; _9755xjdesxxd_=32; not_pay_pwd_token=9e77b411-cd59-4fdd-bfd7-031a104f4ef4; aliyungf_tc=AQAAAOvfIxix5AsA7pK1PIYiyJu+5h+l; href=https%3A%2F%2Fwww.igxe.cn%2Flogin%2F%3Fnext%3D%2Fsold%2F570; _gat=1; myDateMinutes=3; token=96f1ad2a-dd6f-4621-9351-696c46ecf9e2; qimo_seosource_572d9ba0-d737-11e8-970c-a553533099d1=%E7%AB%99%E5%86%85; qimo_seokeywords_572d9ba0-d737-11e8-970c-a553533099d1=; accessId=572d9ba0-d737-11e8-970c-a553533099d1; pageViewNum=1307; Hm_lvt_fe0238ac0617c14d9763a2776288b64b=1558587207,1558669880,1558757985,1558782747; Hm_lpvt_fe0238ac0617c14d9763a2776288b64b=1558850657; _ga=GA1.2.2062975550.1499832672; _gid=GA1.2.431814668.1556871626; bad_id572d9ba0-d737-11e8-970c-a553533099d1=e95fabd1-3e39-11e9-a785-a5e06bca4f16; nice_id572d9ba0-d737-11e8-970c-a553533099d1=fa6472f1-7edd-11e9-abc5-6b36602ded22; csrftoken=gBN6Z6FajQymadhJ9OjMcR07BMbf8nti; sessionid=rl09yfuuk0yyomnykllvxzys5zq9aask';
    var $pwd = '328928';

    public function updateInfo($id){

        try{

            $price_c5 = 0;
            $price_ig = 0;

            $data = PriceDifference::findOne($id);

            $is_sell = $this->isSell($data);

            if($is_sell){

                $data->is_sell = 1;

            }else{

                $data->is_sell = 0;

            }

            if($data->item_id_igxe){

                $price_ig = $this->updateIgPrice($data);

                $data->price_igxe = $price_ig*100;

            }

            if($data->item_id_c5){

                $price_arr = $this->updateC5Price($data);

            }

            $difference = $price_ig*100-$price_arr['price']*100;

            return array(
                'c5' => $price_arr['price'],
                'ig' => $price_ig,
                'id' => $data->id,
                'difference' => (int)$difference,
                'sell' => $is_sell,
                'price_p' => $price_arr['price_p'],
            );

        }catch(PDOException $e) {

            echo $e->getMessage();

        }


    }

    public function updateIgPrice($data){

        $url = 'https://www.igxe.cn/purchase/product_info_'.$data->item_id_igxe.'_2?p_type=1';

        $html = $this->curl($url, array(), 'ig');

        $content = json_decode($html);

        if($content->{'succ'} == true){

            $price = $content->{'min_price'};

            $price = round($price, 2);

            $difference = $data->price_c5?($price-$data->price_c5/100)*100:-$price*100;

            PriceDifference::updateAll(array('price_igxe'=>$price*100, 'difference'=>$difference, 'update_time'=>time(), 'is_sell' => $data->is_sell), array('id' => $data->id));

        }

        return $price;

    }

    public function updateC5Price($data){

        $url_purchase_item = 'https://www.c5game.com/api/purchase/item';

        $data_item = array(

            'id' => $data->item_id_c5

        );

        $html = $this->curl($url_purchase_item,$data_item);

        $content = json_decode($html);

        $price = $data->price_c5;

        $price_purchase = 0;

        $difference = $data->difference;

        if($content->{'status'} == 200){

            $price = $content->{'body'}->{'item'}->{'sell_min_price'};

            $price_purchase = $content->{'body'}->{'item'}->{'purchase_max_price'};

            $difference = $data->price_igxe?$data->price_igxe-($price*100):$price*100;

//            PriceDifference::model()->updateByPk($data->id,array('price_c5'=>$price*100, 'difference'=>$difference, 'update_time'=>time()));

            PriceDifference::updateAll(array('price_c5'=>$price*100, 'difference'=>$difference, 'purchase_c5' => $price_purchase*100, 'update_time'=>time()), array('id' => $data->id));

        }else{

            $name = $data->name;

            $url = 'https://www.c5game.com/dota.html?k='.$name;

            $html = $this->curl($url);

//            include_once  Yii::$app->basePath.\models\simple_html_dom.php;

            $dom = new simple_html_dom();

            $dom->load($html);

            foreach($dom->find('.selling') as $e){

                $name_c5 = $e->children(1)->first_child()->first_child()->innertext;

                if($name==$name_c5){

                    $price = $e->children(2)->first_child()->first_child()->innertext;

                    $price = $this->getNum($price);

                    $price = $price*100;

                    $difference = $data->price_igxe?$data->price_igxe-($price):$price;

//                    PriceDifference::updateAll(array('price_c5'=>$price, 'difference'=>$difference, 'update_time'=>time()), array('id' => $data->id));

//                    $sql_update = "update price_difference set item_id_c5=".$item_id_c5.", price_c5=".$price.", update_time=".$time.", difference=".$difference_price." where id=".$data['id'];
                }

            }

            foreach($dom->find('.purchaseing') as $e){

                $name_c5 = $e->children(1)->first_child()->first_child()->innertext;

                if($name==$name_c5){

                    $price_purchase = $e->children(2)->first_child()->first_child()->innertext;

                    $price_purchase = $this->getNum($price_purchase);

                    $price_purchase = $price_purchase*100;

//                    PriceDifference::updateAll(array('purchase_c5'=>$price_purchase, 'difference'=>$difference, 'update_time'=>time()), array('id' => $data->id));

//                    $sql_update = "update price_difference set item_id_c5=".$item_id_c5.", price_c5=".$price.", update_time=".$time.", difference=".$difference_price." where id=".$data['id'];

                }

            }

            PriceDifference::updateAll(array('purchase_c5'=>$price_purchase,'price_c5'=>$price, 'difference'=>$difference, 'update_time'=>time()), array('id' => $data->id));

            $price = $price/100;
            $price_purchase = $price_purchase/100;

            $dom->clear();

        }

        return array('price' => $price, 'price_p' => $price_purchase);

    }

    public function curl($url,$data=array(),$type='c5'){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
//    curl_setopt($curl,CURLOPT_HEADER,1);
        if($type == 'ig'){

            curl_setopt($curl, CURLOPT_COOKIE, $this->cookie_ig);

        }else{

            curl_setopt($curl, CURLOPT_COOKIE, $this->cookie_c5);

        }
        if($data){

            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);

        }

        $html =  curl_exec($curl);

        curl_close($curl);

        return $html;


    }

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

    public function c5Buy($id){

        $data = PriceDifference::findOne($id);

        $url = "https://www.c5game.com/dota/".$data->item_id_c5."-S.html";

        $html = $this->curl($url);

        $dom = new simple_html_dom();

        $dom->load($html);

        foreach($dom->find('.sale-item-table') as $e){

            $a = $e->outertext;

            preg_match_all('/(data-url)=("[^"]*")/i', $a, $matches);

            $item_url = $matches[2][0];

            $num = $this->getNum($item_url, '=');

            $arr = explode('=',$num);

            $c5_id = $arr[1];

        }

        $sell_url = "https://www.c5game.com/api/product/sale.json?id=".$c5_id."&quick=&gem_id=0&page=1&flag=&delivery=&sort=&b1=&style=";

        $list = $this->curl($sell_url);

        $list = json_decode($list);

        if($list->{'status'} == 200){

            $item_info = $list->{'body'}->{'items'}[0];

            if($item_info->price>$data->price_c5){

                return array('status'=> 204, 'msg'=>'价格过高，请刷新');

            }

            $pay_url = "https://www.c5game.com/api/order/payment.json";

            $data_array = array(

                'id' => $item_info->id,
                'paypwd' => $this->pwd,
                'is_nopass' => 'no',
                'price' => $item_info->price,
                'method' => 4

            );

            $res = $this->curl($pay_url, $data_array);

            $res = json_decode($res);

            if($res->{'status'} == 200){

                return array('status' => 200, 'msg' => 'succ');

            }else{

                return array('status' => 203, 'msg' => $res->{'message'});

            }

        }else{

            return array('status' => 202, 'msg' => $list->{'message'});

        }

    }

     public function isSell($data){

         $url = "https://www.igxe.cn/sell/data/999999?page_no=1&sort_key=2&sort_rule=2&status_type=9&trade_type=0&search_key=".$data->name;

         $url = str_replace(' ', '%20', $url);

         $res = $this->curl($url, array(), 'ig');

         $res = json_decode($res);

         if($res->{'succ'}){

             foreach($res->{'show_data'} as $e){

                 if($e->{'name'} == $data->name){

                     return true;

                 }

             }

         }

         return false;

    }

}