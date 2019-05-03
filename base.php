<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/26 0026
 * Time: 13:52
 */
class base {

    var $cookie_c5 ='bdshare_firstime=1495112656374; fp_ver=3.3.3; BSFIT_OkLJUJ=FFBqPVR-F9hmdg-zTUxNdxvoJUwJAI8P; BSFIT_DEVICEID=By3w4BbUbCpg3rijooGXLYUOhJ5DbIgY7h-9Iq6K7SZb_AljkrSOAS6Powiq7grc0HqpCUH1xMZgru0nAZ2ZnLPRyMZXmGGUrXUz64wskn5a4JSz8s_FtruUXmHE1xJuDslfpLXtqyXPhJa5Ld9qQjM1WfGOVVGd; MEIQIA_EXTRA_TRACK_ID=0wnpBv1NMrGhzg6IkdfVZB6AYSP; buyKnowNotice=close; C5Machines=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; C5buygame=Y; C5Appid=570; C5Lang=zh; C5NoticeBounces1555403740=close; C5Notice1555403740=close; C5NoticeBounces1555558523=close; C5Notice1555558523=close; C5Steamurl=true; C5SessionID=n5saim7bo5ausckfbtgc8tff01; C5Sate=29899df08071363644fe55e1e682693ad0d980eca%3A4%3A%7Bi%3A0%3Bs%3A6%3A%22253352%22%3Bi%3A1%3Bs%3A11%3A%2218758000957%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5Token=5cbbff88bf9db; C5Login=253352; C5_NPWD=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1555473868,1555560364,1555745175,1555824487; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1555832787';
    var $cookie_ig = 'distribution_channel=681a3905060164114876; notetop12563=close; my_steam_game=570; __cfduid=d173e9333e80a5a60245cc291762ff5dc1531462579; my_game=570; agree_sell_agreementlic666=true; gdxidpyhxdE=5H%2FL%2BY24%2Bl%5CImiJ7Ty4Dhn5J4N9eCZ3JvC2IAeItOEfJObYIUg7Pu51nR0W7uXZ2DwJPOt%5Cz1nqK28x%2FVS02Rd04mTJqhq%5CywcZi%2Bey0EIiu%5Cf0PWSmwhS2GWjYW3jVMMTbE1NxMYc%2FwOj3xBYNNLk%2F3yOUn%2ByYft9ItTaZoPuULOv8i%3A1555216691483; _9755xjdesxxd_=32; aliyungf_tc=AQAAAG5mVDfDIAQAI5K1PIijWE4jDixN; href=https%3A%2F%2Fwww.igxe.cn%2Flogin%2F%3Fnext%3D%2Fsold%2F570; token=c8f25b75-acce-44ee-80cd-a5c5b3f0cb26; not_pay_pwd_token=c8f25b75-acce-44ee-80cd-a5c5b3f0cb26; myDateMinutes=6; _ga=GA1.2.2062975550.1499832672; _gid=GA1.2.1876312458.1555215789; _gat=1; Hm_lvt_fe0238ac0617c14d9763a2776288b64b=1555914391,1555998612,1556167237,1556255489; Hm_lpvt_fe0238ac0617c14d9763a2776288b64b=1556266112; qimo_seosource_572d9ba0-d737-11e8-970c-a553533099d1=%E7%AB%99%E5%86%85; qimo_seokeywords_572d9ba0-d737-11e8-970c-a553533099d1=; accessId=572d9ba0-d737-11e8-970c-a553533099d1; pageViewNum=808; bad_id572d9ba0-d737-11e8-970c-a553533099d1=e95fabd1-3e39-11e9-a785-a5e06bca4f16; nice_id572d9ba0-d737-11e8-970c-a553533099d1=bf7ccb01-67e1-11e9-aed9-4f728b3039a0; csrftoken=GKuXFVffilpMkaBXNTs3yP3u1dwSqic6; sessionid=x9klsals3obc8m7f7t35g2bsw7lenf1o';
    var $pwd = '328928';

    function _construct($cookie_c5,$pwd){

        $this->cookie_c5 = $cookie_c5;
        $this->pwd = $pwd;

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


}