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

    var $cookie_c5 ='bdshare_firstime=1495112656374; fp_ver=3.3.3; BSFIT_OkLJUJ=FFBqPVR-F9hmdg-zTUxNdxvoJUwJAI8P; BSFIT_DEVICEID=By3w4BbUbCpg3rijooGXLYUOhJ5DbIgY7h-9Iq6K7SZb_AljkrSOAS6Powiq7grc0HqpCUH1xMZgru0nAZ2ZnLPRyMZXmGGUrXUz64wskn5a4JSz8s_FtruUXmHE1xJuDslfpLXtqyXPhJa5Ld9qQjM1WfGOVVGd; MEIQIA_EXTRA_TRACK_ID=0wnpBv1NMrGhzg6IkdfVZB6AYSP; buyKnowNotice=close; C5Machines=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; C5buygame=Y; C5Appid=570; C5Lang=zh; C5NoticeBounces1555403740=close; C5Notice1555403740=close; C5NoticeBounces1555558523=close; C5Notice1555558523=close; C5Steamurl=true; C5SessionID=n5saim7bo5ausckfbtgc8tff01; C5Sate=29899df08071363644fe55e1e682693ad0d980eca%3A4%3A%7Bi%3A0%3Bs%3A6%3A%22253352%22%3Bi%3A1%3Bs%3A11%3A%2218758000957%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5Token=5cbbff88bf9db; C5Login=253352; C5_NPWD=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1555473868,1555560364,1555745175,1555824487; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1555832787';
    var $cookie_ig = '_ga=GA1.2.2053708244.1523634691; distribution_channel=1249c251701509571840; _9755xjdesxxd_=32; my_steam_game=433850; agree_sell_agreementlic666=true; username=lic666; bad_id572d9ba0-d737-11e8-970c-a553533099d1=045e9372-3e7a-11e9-9a95-e726cc7fecda; __cfduid=d16d91c59d01d8b94b0766311e57a58091555174165; gdxidpyhxdE=J2kvOfpR9z9Mgj%2BtfHzMQHG1xhEfTwHLtYcrAwJ0BMvJvTVrrXMXLQWEWtkiSymwqxsiN%5C30XcjW1CSTmIdlt9fIEX13UmqmMbcG3iez03JXzV%2FHYR7%2Be5JCqwx2LvS%2BviXf6jAt78kQ93%2Bm0ysRckBaTz%5Copm38K11omfURvDZP3t%5C%2F%3A1555249514578; my_game=570; _gid=GA1.2.1462298995.1557675607; accessId=572d9ba0-d737-11e8-970c-a553533099d1; not_pay_pwd_token=52099be5-184f-4b86-94c3-261ffb640c32; aliyungf_tc=AQAAAMj3oFe05gcAHRltfWP1dd0upFgm; Hm_lvt_fe0238ac0617c14d9763a2776288b64b=1558575721,1558611586,1558662844,1558699576; href=https%3A%2F%2Fwww.igxe.cn%2Flogin%2F%3Fnext%3D%2Fsold%2F570; nice_id572d9ba0-d737-11e8-970c-a553533099d1=547664a2-7e1c-11e9-acac-513c32136d3b; csrftoken=znXgHuGgAlBHoyhmMci9sgTxDQoVvvdv; token=0d21f32f-5a2a-4b91-984c-31c1bd004124; sessionid=nyledr335c0tprz9q68zwjteix7vluld; myDateMinutes=18; _gat=1; qimo_seosource_572d9ba0-d737-11e8-970c-a553533099d1=%E7%AB%99%E5%86%85; qimo_seokeywords_572d9ba0-d737-11e8-970c-a553533099d1=; pageViewNum=598; Hm_lpvt_fe0238ac0617c14d9763a2776288b64b=1558707579';
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

                $price_c5 = $this->updateC5Price($data);

            }

            $difference = $price_ig*100-$price_c5*100;

            return array('c5' => $price_c5, 'ig' => $price_ig, 'id' => $data->id, 'difference' => (int)$difference, 'sell' => $is_sell);

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

        if($content->{'status'} == 200){

            $price = $content->{'body'}->{'item'}->{'sell_min_price'};

            $difference = $data->price_igxe?$data->price_igxe-($price*100):$price*100;

//            PriceDifference::model()->updateByPk($data->id,array('price_c5'=>$price*100, 'difference'=>$difference, 'update_time'=>time()));

            PriceDifference::updateAll(array('price_c5'=>$price*100, 'difference'=>$difference, 'update_time'=>time()), array('id' => $data->id));

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

                    PriceDifference::updateAll(array('price_c5'=>$price, 'difference'=>$difference, 'update_time'=>time()), array('id' => $data->id));

//                    $sql_update = "update price_difference set item_id_c5=".$item_id_c5.", price_c5=".$price.", update_time=".$time.", difference=".$difference_price." where id=".$data['id'];

                    $price = $price/100;

                }

            }

            $dom->clear();

        }

        return $price;

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