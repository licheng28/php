<?php

/**
 * Created by PhpStorm.
 * User: licheng
 * Date: 2020/5/19
 * Time: 10:42
 */
date_default_timezone_set("Asia/Shanghai");
set_time_limit(0);
index();

function index()
{

//    $url = "https://buff.163.com/api/market/buy_order/history?game=dota2&page_num=1&page_size=24";
//
//    $cookie = 'csrf_token=IjEwN2YwMGU5MzdmYmEwYWIzZmZiNzk0MzFkY2Q5ZDk2ODFmZjhkOTQi.EaVYaw.SoWLeyWsNosKotIIvLP537HP0pA; session=1-8LLcKufxSDKyNOvAMZi39cxUbN1TpXK6JBYX34rGSRls2044910128';

    $url = 'https://www.igxe.cn/rest/app/user/my_product';

    $cookie = 'aliyungf_tc=AQAAAKIl90G+ZgwAzAZtfSeI18PT0cjf';
//    $data = array('token' => 'fe12acb24c128cdeb4ac2cf0463965ff18baf91a70a648b6a6bee5de13281c2e');

    $data = '{"bot_steam_uid":"76561198087820560","favorite_id":0,"page_size":10,"source_type":3,"show_type":2,"steam_uid":"","sort":0,"product_type_id":0,"status_type":9,"tags_quality_id":0,"sort_rule":1,"app_id":570,"max_quality_id":0,"type":0,"tags_rarity_id":0,"tags_exterior_id":0,"product_category_id":0,"sort_key":2,"item_id":0,"trade_type":2,"page_no":1,"client_type":3,"market_name":"","search":"","is_fresh":0}';

    $header = array('Content-Type: application/json', 'User-Agent: IGXEAssistant/2.5.0 (iPhone; iOS 12.2; Scale/3.00)','token: fe12acb24c128cdeb4ac2cf0463965ff18baf91a70a648b6a6bee5de13281c2e');

    $html = curl($url,$cookie,$data,$header);

    $html = json_decode($html);

    foreach($html->{'data'}->{'rows'} as $value){

        $name = $value->{'name'};
        $product_id = $value->{'product_id'};
        $price = $value->{'unit_price'};
        $min_price = $value->{'reference_price'};
        $id = $value->{'id'};

        if($price > $min_price){

            $url_c5 = 'https://open.c5game.com/v1/store?keyword='.$name.'&only=0&page=1';

            $res = json_decode(curl($url_c5));

            $price_c5 = 0;

            foreach($res->{'data'}->{'list'} as $r){

                if($r->{'name'} == $name){

                    $price_c5 = $r->{'price'};

                }

            }

            if(!$price_c5){

                $url_c5_2 = 'https://open.c5game.com/v1/store?keyword='.$name.'&only=0&page=2';

                $res = json_decode(curl($url_c5_2));

                foreach($res->{'data'}->{'list'} as $r){

                    if($r->{'name'} == $name){

                        $price_c5 = $r->{'price'};

                    }

                }

            }

            $change_price = '';

            if($min_price-0.01>$price_c5*.97&&$price_c5){

                $change_price = $min_price-0.01;

            }

        }else{

            $url_ig = 'https://www.igxe.cn/rest/app/product/product_sale_list';

            $data_ig = '{"key":0,"favorite_id":0,"page_size":2,"paint_type":0,"fishpond_user_id":0,"duration":1,"fishpond_id":0,"sort":0,"market_hash_name":"Catalyst Cap","buy_method":0,"app_id":570,"type":0,"comment_id":0,"product_id":'.$product_id.',"tags_exterior_id":0,"showShopCartButton":true,"exterior_end":1,"gem_attribute_id":0,"item_id":0,"page_no":1,"client_type":3,"gem_id":0,"exterior_start":0,"shop_id":0}';

            $html_ig = json_decode(curl($url_ig, $cookie, $data_ig, $header));

            $price_ig = 0.1;

            if(isset($html_ig->{'data'}->{'rows'}[1])){

                $price_ig = $html_ig->{'data'}->{'rows'}[1]->{'unit_price'};

            }

            $change_price = '';

            if($price<$price_ig-0.01){

                $change_price = $price_ig-0.01;

            }

        }

        if(!$change_price){ echo $name.'取消修改';continue;}

//        $comfir_curl = 'https://www.igxe.cn/rest/app/product/sell/confirm/info HTTP/1.1';
//
//        $change_data = '{"app_id":570,"client_type":3,"type":2,"products":[{"unit_price":'.$change_price.',"qty":1,"product_id":'.$product_id.'}],"sale_type":"1"}';
//
//        $comfir_msg = curl($comfir_curl,$cookie,$change_data,$header);
//
//        print_r($comfir_msg);die;

//        $change_url = 'https://www.igxe.cn/rest/app/product/change/price';
//
//        $change_data = '{"trades":[{"id":'.$id.',"unit_price":'.$change_price.',"desc":"","fee_price":0.06}],"app_id":570,"client_type":3}';
//
//        $res_msg = curl($change_url,$cookie,$change_data,$header,'put');
//
//        print_r($res_msg);die;
//
//        echo $res_msg->{'message'}.'名称：'.$name.' 原价：'.$price.' 改价：'.$change_price;
//        die;

//下架

        $url_d = "https://www.igxe.cn/rest/app/user/update_product_sale_status";

        $d_data = '{"bot_steam_uid":"76561198087820560","favorite_id":0,"page_size":10,"source_type":3,"ids":["'.$id.'"],"show_type":2,"steam_uid":"","sort":0,"product_type_id":0,"status_type":9,"app_id":570,"max_quality_id":0,"type":0,"sort_key":1,"trade_type":2,"item_id":0,"page_no":2,"client_type":3,"is_fresh":0}';

//        $header = array(
//            'Content-Type: application/json',
//            'User-Agent: IGXEAssistant/2.5.0 (iPhone; iOS 12.2; Scale/3.00)',
//            'token: fe12acb24c128cdeb4ac2cf0463965ff18baf91a70a648b6a6bee5de13281c2e',
//            'Accept-Encoding: br, gzip, deflate',
//            'Cookie: aliyungf_tc=AQAAAKIl90G+ZgwAzAZtfSeI18PT0cjf',
//            'versions: 206',
//            'Connection: keep-alive',
//            'Accept: */*',
//            'Accept-Language: zh-Hans-CN;q=1, en-CN;q=0.9, ja-CN;q=0.8, zh-Hant-CN;q=0.7',
//            'Content-Length: 427',
//        );

        $res_msg = curl($url_d,$cookie,$d_data,$header,'put');

        print_r($res_msg);die;


    }

}

function curl($url, $cookie='',$data=array(),$header=array(),$type='post'){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
//    curl_setopt($curl,CURLOPT_HEADER,1);
    if($cookie){

        curl_setopt($curl, CURLOPT_COOKIE, $cookie);

    }
    if($data){

        if($type == 'post'){

            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);

        }else{

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'put');
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        }

    }

    if($header){

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    }

    $html =  curl_exec($curl);

    curl_close($curl);

    return $html;

}