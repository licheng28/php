<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/22 0022
 * Time: 16:03
 */
namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\web\simple_html_dom;



class base extends Model
{

//    var $cookie_c5 = 'C5Lang=zh; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1556181926; C5NoticeBounces1556170168=close; C5Appid=570; C5SessionID=rcl4ss5tpvq9deieti9cfm80f7; C5Sate=9dac2228e8e1038ef95eb42cb26dd526540df83ba%3A4%3A%7Bi%3A0%3Bs%3A9%3A%22557376709%22%3Bi%3A1%3Bs%3A10%3A%22brave_five%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5Token=5cc174f589f60; C5Login=557376709; C5Machines=Wl4MOBJaQ0Fj%2F3qKBDxJGciO%2Bfd%2BvowCOflGnn8qGYs%3D; C5_NPWD=0QRrydA06t9FYzzO7qR%2FNA%3D%3D; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1556182330';
    public $cookie_c5 ='bdshare_firstime=1495112656374; fp_ver=3.3.3; BSFIT_OkLJUJ=FFBqPVR-F9hmdg-zTUxNdxvoJUwJAI8P; BSFIT_DEVICEID=By3w4BbUbCpg3rijooGXLYUOhJ5DbIgY7h-9Iq6K7SZb_AljkrSOAS6Powiq7grc0HqpCUH1xMZgru0nAZ2ZnLPRyMZXmGGUrXUz64wskn5a4JSz8s_FtruUXmHE1xJuDslfpLXtqyXPhJa5Ld9qQjM1WfGOVVGd; MEIQIA_EXTRA_TRACK_ID=0wnpBv1NMrGhzg6IkdfVZB6AYSP; buyKnowNotice=close; C5Machines=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; C5buygame=Y; C5Appid=570; C5Lang=zh; C5NoticeBounces1555403740=close; C5Notice1555403740=close; C5NoticeBounces1555558523=close; C5Notice1555558523=close; C5Steamurl=true; C5SessionID=n5saim7bo5ausckfbtgc8tff01; C5Sate=29899df08071363644fe55e1e682693ad0d980eca%3A4%3A%7Bi%3A0%3Bs%3A6%3A%22253352%22%3Bi%3A1%3Bs%3A11%3A%2218758000957%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5Token=5cbbff88bf9db; C5Login=253352; C5_NPWD=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1555473868,1555560364,1555745175,1555824487; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1555832787';
    public $cookie_ig = '_ga=GA1.2.2053708244.1523634691; distribution_channel=1249c251701509571840; _9755xjdesxxd_=32; agree_sell_agreementlic666=true; username=lic666; bad_id572d9ba0-d737-11e8-970c-a553533099d1=045e9372-3e7a-11e9-9a95-e726cc7fecda; __cfduid=d16d91c59d01d8b94b0766311e57a58091555174165; my_game=570; gdxidpyhxdE=u6Hbup64XajcPf%5CtdzlHaHtUG27mIzptAHN%5CA%2FM%2FhImkYMrSPBPvky%2FkESbXIM48TX6GL1AV%5CHK4UZr%2FVO1L6V5b31B5XyYtDEDYx0k1i%2Flf%2B4EmsxkRlXV2hPkJ%2Bh8oJKZfnGGrjhS%2FJoW3pPUw2HtmkZSHW58Uc2eE%5CQt%5CUXxKbZd4%3A1560171524628; _gid=GA1.2.1256594371.1561303816; accessId=572d9ba0-d737-11e8-970c-a553533099d1; not_pay_pwd_token=f1167720-6511-4e26-ac89-63c98bc5967f; aliyungf_tc=AQAAAEKEW30dOw8AFzLAc9dFDKUJGV77; Hm_lvt_fe0238ac0617c14d9763a2776288b64b=1561346871,1561348954,1561348972,1561426288; href=https%3A%2F%2Fwww.igxe.cn%2Flogin%2F%3Fnext%3D%2Fsold%2F570; nice_id572d9ba0-d737-11e8-970c-a553533099d1=f3e4fbc1-96e8-11e9-a8a4-1f1e1eff423b; csrftoken=Ww73s6M7R354gpPs8FoRmxpC243gkYAt; token=acb680e1-34ce-4e26-944d-0799220261e8; sessionid=h4tirws178eac4h5uoc1xamxoydus4qn; myDateMinutes=36; Hm_lpvt_fe0238ac0617c14d9763a2776288b64b=1561466270; _gat=1; qimo_seosource_572d9ba0-d737-11e8-970c-a553533099d1=%E7%AB%99%E5%86%85; qimo_seokeywords_572d9ba0-d737-11e8-970c-a553533099d1=; pageViewNum=134';
    public $pwd = '328928';
//    var $pwd = '679578';
    const C5 = 'c5';
    const IG = 'ig';

    public function updateInfo($id){

        $price_c5 = 0;
        $price_ig = 0;

        $data = PriceDifference::findOne($id);

        $is_sell = $this->isSell($data);

        $data->is_sell = $is_sell;

        $trans = Yii::$app->db->beginTransaction();

        try{

            $price_ig = $this->updateIgPrice($data);

            $data->price_igxe = $price_ig*100;

            $price_arr = $this->updateC5Price($data);

            $trans->commit();

        }catch(Exception $e){

            $trans->rollBack();

            return array('status' => 204, 'msg' => 'err');

        }

        $difference = $price_ig?$price_ig*100-$price_arr['price']*100:$price_arr['price']*100;

        $sell_msg = PriceDifference::getSellMsg($is_sell);

        return array(
            'c5' => $price_arr['price'],
            'ig' => $price_ig,
            'id' => $data->id,
            'difference' => (int)$difference,
            'sell' => $sell_msg,
            'price_p' => $price_arr['price_p'],
        );

    }

    public function updateIgPrice($data){

        $price = 0;

        if($data->item_id_igxe){

            $url = 'https://www.igxe.cn/purchase/product_info_'.$data->item_id_igxe.'_2?p_type=1';

            $html = $this->curl($url, array(), 'ig');

            $content = json_decode($html);

            if($content){

                if($content->{'succ'} == true){

                    $price = $content->{'min_price'};

                    $price = round($price, 2);

//                    $difference = $data->price_c5?($price-$data->price_c5/100)*100:-$price*100;

                    PriceDifference::updateAll(array('price_igxe'=>$price*100, 'update_time'=>time(), 'is_sell' => $data->is_sell), array('id' => $data->id));

                    return $price;

                }

            }

        }

        $url = 'https://www.igxe.cn/dota2/570?keyword='.$data->name;

        $url = str_replace(' ', '%20', $url);

        $html = $this->curl($url,array(),'ig', false);

        $dom = new simple_html_dom();

        $dom->load($html);

        foreach($dom->find('.dota') as $e){

            $name = $e->children(1)->innertext;

            if($name == $data->name){

                $href = $e->href;

                $href_array = explode('/', $href);

                $item_id = $href_array[3];

                $price1 = $e->children(2)->first_child()->children(1)->innertext;
                $price2 = $e->children(2)->first_child()->children(2)->innertext;

                $price = $price1.$price2;

//                $difference = $data->price_c5?($price-$data->price_c5/100)*100:-$price*100;

                PriceDifference::updateAll(array('price_igxe'=>$price*100, 'update_time'=>time(), 'is_sell' => $data->is_sell, 'item_id_igxe' => $item_id), array('id' => $data->id));

            }

        }

        $dom->clear();

        return $price;

    }

    public function updateC5Price($data){

        $price = $price_purchase = $difference = 0;

        if($data->item_id_c5&&Yii::$app->user->id){

            $url_purchase_item = 'https://www.c5game.com/api/purchase/item';

            $data_item = array(

                'id' => $data->item_id_c5

            );

            $html = $this->curl($url_purchase_item,$data_item);

            $content = json_decode($html);

            if(!$content){

                return false;

            }

            $price = $data->price_c5;

            $price_purchase = 0;

            if($content->{'status'} == 200){

                $price = $content->{'body'}->{'item'}->{'sell_min_price'};

                $price_purchase = $content->{'body'}->{'item'}->{'purchase_max_price'};

                $difference = $data->price_igxe?$data->price_igxe-($price*100):$price*100;

//            PriceDifference::model()->updateByPk($data->id,array('price_c5'=>$price*100, 'difference'=>$difference, 'update_time'=>time()));

                PriceDifference::updateAll(array('price_c5'=>$price*100, 'difference'=>$difference, 'purchase_c5' => $price_purchase*100, 'update_time'=>time()), array('id' => $data->id));

                return array('price' => $price, 'price_p' => $price_purchase);

            }

        }

        $item_id_c5 = 0;

        $name = $data->name;

        $url = 'https://www.c5game.com/dota.html?locale=zh&k='.$name;

        $url = str_replace(' ', '%20', $url);

        $html = $this->curl($url);

//            include_once  Yii::$app->basePath.\models\simple_html_dom.php;

        $dom = new simple_html_dom();

        $dom->load($html);

        foreach($dom->find('.selling') as $e){

            $name_c5 = $e->children(1)->first_child()->first_child()->innertext;

            if($name==$name_c5){

                $item_id_c5 = $this->getNum($e->first_child()->href, '*');

                $price = $e->children(2)->first_child()->first_child()->innertext;

                $price = $this->getNum($price);

                $price = $price*100;

                break;
//                    PriceDifference::updateAll(array('price_c5'=>$price, 'difference'=>$difference, 'update_time'=>time()), array('id' => $data->id));

//                    $sql_update = "update price_difference set item_id_c5=".$item_id_c5.", price_c5=".$price.", update_time=".$time.", difference=".$difference_price." where id=".$data['id'];
            }

        }

        $difference = $data->price_igxe?$data->price_igxe-($price):$price;

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

        PriceDifference::updateAll(array('purchase_c5'=>$price_purchase,'price_c5'=>$price, 'difference'=>$difference, 'update_time'=>time(), 'item_id_c5' => $item_id_c5), array('id' => $data->id));

        $price = $price/100;
        $price_purchase = $price_purchase/100;

        $dom->clear();

        return array('price' => $price, 'price_p' => $price_purchase);

    }

    public function curl($url,$data=array(),$type='c5',$use_cookie=true){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
//    curl_setopt($curl,CURLOPT_HEADER,1);
        if($type == 'ig'){

            if($use_cookie){

                $redis = Yii::$app->redis;

                $cookie_ig = $redis->get('cookie_ig'.Yii::$app->user->id);

                curl_setopt($curl, CURLOPT_COOKIE, $cookie_ig);

            }

        }else{

            $redis = Yii::$app->redis;

            $cookie_c5 = $redis->get('cookie_c5'.Yii::$app->user->id);

            curl_setopt($curl, CURLOPT_COOKIE, $cookie_c5);

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

        $user_id = Yii::$app->user->id;

        if(!$user_id){

            return array('status' => 206, 'msg' => '未登录');

        }

        $data = PriceDifference::findOne($id);

        if(!$data->c5_id){

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

            $row = PriceDifference::updateAll(array('c5_id'=>$c5_id), array('id' => $id));

            if(!$row){

                return array('status'=> 205, 'msg'=>'更新c5id失败');

            }

        }else{

            $c5_id = $data->c5_id;

        }

        $sell_url = "https://www.c5game.com/api/product/sale.json?id=".$c5_id."&quick=&gem_id=0&page=1&flag=&delivery=&sort=&b1=&style=";

        $list = $this->curl($sell_url);

        $list = json_decode($list);

        if($list->{'status'} == 200){

            $item_info = $list->{'body'}->{'items'}[0];

//            if($item_info->price>$data->price_c5/100){
//
//                return array('status'=> 204, 'msg'=>'价格过高，请刷新');
//
//            }

            $pay_url = "https://www.c5game.com/api/order/payment.json";

            $is_self_sell = $item_info->is_self_sell;

            if($is_self_sell){

                $method = 3;

            }else{

                $method = 1;

            }

            $redis = Yii::$app->redis;

            $pwd = $redis->get('pwd_c5'.$user_id);

            $data_array = array(

                'id' => $item_info->id,
                'paypwd' => $pwd,
                'is_nopass' => 'no',
                'price' => $item_info->price,
                'method' => $method

            );

            $res = $this->curl($pay_url, $data_array);

            $res = json_decode($res);

            if(!$res){

                return array('status' => 207, 'msg' => 'error');

            }

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

         if($res){

             if($res->{'succ'}){

                 foreach($res->{'show_data'} as $e){

                     if($e->{'name'} == $data->name){

                         return 1;

                     }

                 }

             }

             return 0;

         }

         return 2;

    }

    public function purchase($id)
    {

        $user_id = Yii::$app->user->id;

        if(!$user_id){

            return array('status' => 202, 'msg' => '未登录');

        }

        $data = PriceDifference::findOne($id);

        if($data->purchase_c5){

            if($data->purchase_c5/100>=100){

                $improve_price = 1;

            }else{

                $improve_price = 0.1;

            }

            $purchase_c5 = ceil($data->purchase_c5/10);

            $url_purchase_submit = 'https://www.c5game.com/api/purchase/submit';

            $redis = Yii::$app->redis;

            $pwd = $redis->get('pwd_c5'.$user_id);

            $purchase_data = array(

                'price' => $purchase_c5/10+$improve_price,
                'num' => 1,
                'paypwd' => $pwd,
                'delivery' => 'on',
                'id' => $data->item_id_c5,//item_id
                'appid' => 570,

            );

            $res = $this->curl($url_purchase_submit, $purchase_data);

            $res = json_decode($res);

            if(!$res){

                return array('status' => 203, 'msg' => 'error');

            }

            return array('status' => $res->{'status'}, 'msg' => $res->{'message'});

        }

        return array('status' => 201, 'msg' => '求购价未知');

    }

    /**
     * @param $day
     */

    public function updateReplenishInfo($day, $page=1)
    {

        $user_id = Yii::$app->user->id;

        if(!$user_id){

            return false;

        }

        $trans = Yii::$app->db->beginTransaction();

        try{

            $url = 'https://www.igxe.cn/inventory/api/get_sold_data/570?page_no='.$page.'&page_size=200&keyword=&status_locked=0&date_from='.$day.'&date_to=';

            $html = $this->curl($url, array(), 'ig');

            $content = json_decode($html);

            if(!$content){

                return false;

            }

            foreach($content->{'items'} as $data){

                $model = new Replenish();
                $model->fee = ceil($data->{'fee_money'}*100);
                $model->income_price = ceil($data->{'income_price'}*100);
                $model->sold_time = strtotime($data->{'last_updated'});
                $model->item_id_igxe = $data->{'product_id'};
                $model->create_time = time();
                $model->status = 1;

                $date = date('Y-m-d', strtotime($data->{'last_updated'}));
                $model->sell_day = strtotime($date);
                $model->user_id = $user_id;

                $model->save();

                $item_info = PriceDifference::find()->where('item_id_igxe = '.$data->{'product_id'})->all();

                if(!$item_info){

                    $difference = new PriceDifference();

                    $difference->name = $data->{'market_name'};
                    $difference->item_id_igxe = $data->{'product_id'};
                    $difference->price_igxe = ceil($data->{'min_price'}*100);
                    $difference->img = $data->{'icon_url'};
                    $difference->update_time = time();
                    $difference->creat_time = time();
                    $difference->difference = -ceil($data->{'min_price'}*100);

                    $difference->save();

                }

            }

            if($content->{'is_more'}){

                $this->updateReplenishInfo($day, $page+1);

            }

            $trans->commit();

        }catch(Exception $e){

            echo $e->getMessage();

            $trans->rollBack();

        }

    }

/**
 * @param $day
 * @param int $page
 */

    public function updateSold($day, $page=1, $lastSoldTime='')
    {
//        $end = date('Y-m-d', strtotime($day)+86400);

        $user_id = Yii::$app->user->id;

        if(!$user_id){

            return false;

        }

        $url = 'https://www.igxe.cn/inventory/api/get_sold_data/570?page_no='.$page.'&page_size=200&keyword=&status_locked=0&date_from='.$day.'&date_to='.$day;

        $html = $this->curl($url, array(), 'ig');

        $content = json_decode($html);

        if(!$content){

            return false;

        }


        if(!$lastSoldTime){

            $last = Replenish::find()->where('sell_day=:sell_day and user_id=:user_id', array(':sell_day'=>strtotime($day),':user_id'=>$user_id))->orderBy('sold_time desc')->one();

            if($last){

                $lastSoldTime = $last->sold_time;

            }

        }

        foreach($content->{'items'} as $data){

            if($lastSoldTime){

                if(strtotime($data->{'last_updated'}) == $lastSoldTime){

                    return true;

                }

            }

            $model = new Replenish();
//            $min_price = $data->{'min_price'};
            $model->fee = ceil($data->{'fee_money'}*100);
            $model->income_price = ceil($data->{'income_price'}*100);
            $model->sold_time = strtotime($data->{'last_updated'});
//            $name = $data->{'market_name'};
            $model->item_id_igxe = $data->{'product_id'};
            $model->create_time = time();
            $model->status = 1;

            $date = date('Y-m-d', strtotime($data->{'last_updated'}));
            $model->sell_day = strtotime($date);
            $model->user_id = $user_id;

            $model->save();

            $item_info = PriceDifference::find()->where('item_id_igxe = '.$data->{'product_id'})->all();

            if(!$item_info){

                $difference = new PriceDifference();

                $difference->name = $data->{'market_name'};
                $difference->item_id_igxe = $data->{'product_id'};
                $difference->price_igxe = ceil($data->{'min_price'}*100);
                $difference->img = $data->{'icon_url'};
                $difference->update_time = time();
                $difference->creat_time = time();
                $difference->difference = -ceil($data->{'min_price'}*100);

                $difference->save();

            }

        }

        if($content->{'is_more'}){

            $this->updateSold($day, $page+1, $lastSoldTime);

        }

    }

    public function updateBundle($type)
    {
        $m_type = PriceDifference::TYPE_DEFAULT;

        if($type==PriceDifference::TYPE_BUNDLE){

            $url = 'https://www.igxe.cn/dota2/570?tags_type_name=%E6%8D%86%E7%BB%91%E5%8C%85&tags_type_id=1027&is_buying=0&is_stattrak%5B%5D=0&is_stattrak%5B%5D=0&sort=2&ctg_id=0&type_id=0&page_no=1&page_size=1000&rarity_id=0&exterior_id=0&quality_id=0&capsule_id=0&_t=1556266391326';
            $m_type = PriceDifference::TYPE_BUNDLE;

        }elseif($type == PriceDifference::TYPE_UNIQUE){

            $url = 'https://www.igxe.cn/dota2/570?quality_name=%E6%A0%87%E5%87%86&is_buying=0&is_stattrak%5B%5D=0&is_stattrak%5B%5D=0&sort=2&ctg_id=0&type_id=0&page_no=1&page_size=2500&rarity_id=0&exterior_id=0&quality_id=954&capsule_id=0&_t=1556600696201';

        }elseif($type == PriceDifference::TYPE_GENUINE){

            $url = "https://www.igxe.cn/dota2/570?quality_name=%E7%BA%AF%E6%AD%A3&is_buying=0&is_stattrak%5B%5D=0&is_stattrak%5B%5D=0&sort=2&ctg_id=0&type_id=0&page_no=1&page_size=450&rarity_id=0&exterior_id=0&quality_id=1023&capsule_id=0&_t=1557129070760";

        }else{

            return false;

        }

        $html = $this->curl($url,array(),'ig');

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

                $model = new PriceDifference();

                $result = $model->find()->where('name=:name', array(':name'=>$name))->one();

                if($result){

                    $result->name = $name;
                    $result->item_id_igxe = $item_id;
                    $result->price_igxe = $price;
                    $result->update_time = time();
//                    $result->creat_time = time();
                    $result->img = $src;
                    $result->type = $m_type;
                    $difference = $result->price_c5?$price-$result->price_c5:-$price;
                    $result->difference = $difference;

                    if(!$result->save()){

                        throw new Exception('更新错误');

                    }

                }else{

                    $model->name = $name;
                    $model->item_id_igxe = $item_id;
                    $model->price_igxe = $price;
                    $model->update_time = time();
                    $model->creat_time = time();
                    $model->img = $src;
                    $model->type = $m_type;

                    if(!$model->save()){

                        throw new Exception('更新错误');

                    }

                }

            }catch (\Exception $e){

                echo $e->getMessage();

            }

        }

        $dom->clear();

    }

    public function updateBundleC5($type)
    {

        try{

            $m_type = PriceDifference::TYPE_DEFAULT;

            if($type == PriceDifference::TYPE_BUNDLE){

                $url = 'https://www.c5game.com/dota.html?type=bundle&sort=price.desc';
                $maxpage = 37;
                $m_type = PriceDifference::TYPE_BUNDLE;

            }elseif($type == PriceDifference::TYPE_UNIQUE){

                $url = 'https://www.c5game.com/dota.html?sort=price.desc&quality=unique';
                $maxpage = 101;

            }elseif($type == PriceDifference::TYPE_GENUINE){

                $url = "https://www.c5game.com/dota.html?quality=genuine&sort=price.desc";
                $maxpage = 27;

            }else{

                return false;
            }

            $page = 1;

            while($page<$maxpage){

                $url = $url.'&page='.$page;

                $html = $this->curl($url);

                $dom = new simple_html_dom();

                $dom->load($html);

                foreach($dom->find('.selling') as $e){

                    $name_c5 = $e->children(1)->first_child()->first_child()->innertext;

                    $price = $e->children(2)->first_child()->first_child()->innertext;

                    $price = $this->getNum($price);

                    $price = $price*100;

                    $item_id_c5 = $this->getNum($e->first_child()->href, '*');

                    $update_time = time();

                    $src = $e->first_child()->children(1)->src;

                    $model = new PriceDifference();

                    $result = $model->find()->where('name=:name', array(':name'=>$name_c5))->one();

                    if($result){

                        $difference = $result->price_igxe?$result->price_igxe-$price:$price;
                        $result->difference = $difference;
                        $result->name = $name_c5;
                        $result->item_id_c5 = $item_id_c5;
                        $result->price_c5 = $price;
                        $result->update_time = $update_time;
//                        $result->creat_time = $update_time;
                        $result->img = $src;
                        $result->type = $m_type;

                        $result->save();
                    }else{

                        $model->name = $name_c5;
                        $model->item_id_c5 = $item_id_c5;
                        $model->price_c5 = $price;
                        $model->update_time = $update_time;
                        $model->creat_time = $update_time;
                        $model->img = $src;
                        $model->type = $m_type;

                        $model->save();
                    }

                }

                $page++;
            }

        }catch (Exception $e){

            echo $e->getMessage();

        }
    }

}