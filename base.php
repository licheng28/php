<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/26 0026
 * Time: 13:52
 */
class base {

    var $cookie_c5 ='bdshare_firstime=1495112656374; fp_ver=3.3.3; BSFIT_OkLJUJ=FFBqPVR-F9hmdg-zTUxNdxvoJUwJAI8P; BSFIT_DEVICEID=By3w4BbUbCpg3rijooGXLYUOhJ5DbIgY7h-9Iq6K7SZb_AljkrSOAS6Powiq7grc0HqpCUH1xMZgru0nAZ2ZnLPRyMZXmGGUrXUz64wskn5a4JSz8s_FtruUXmHE1xJuDslfpLXtqyXPhJa5Ld9qQjM1WfGOVVGd; MEIQIA_EXTRA_TRACK_ID=0wnpBv1NMrGhzg6IkdfVZB6AYSP; buyKnowNotice=close; C5Machines=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; C5buygame=Y; C5Appid=570; C5Lang=zh; C5NoticeBounces1555403740=close; C5Notice1555403740=close; C5NoticeBounces1555558523=close; C5Notice1555558523=close; C5Steamurl=true; C5SessionID=n5saim7bo5ausckfbtgc8tff01; C5Sate=29899df08071363644fe55e1e682693ad0d980eca%3A4%3A%7Bi%3A0%3Bs%3A6%3A%22253352%22%3Bi%3A1%3Bs%3A11%3A%2218758000957%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5Token=5cbbff88bf9db; C5Login=253352; C5_NPWD=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1555473868,1555560364,1555745175,1555824487; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1555832787';
    var $cookie_ig = "_ga=GA1.2.2053708244.1523634691; distribution_channel=1249c251701509571840; _9755xjdesxxd_=32; my_steam_game=433850; agree_sell_agreementlic666=true; username=lic666; bad_id572d9ba0-d737-11e8-970c-a553533099d1=045e9372-3e7a-11e9-9a95-e726cc7fecda; __cfduid=d16d91c59d01d8b94b0766311e57a58091555174165; gdxidpyhxdE=J2kvOfpR9z9Mgj%2BtfHzMQHG1xhEfTwHLtYcrAwJ0BMvJvTVrrXMXLQWEWtkiSymwqxsiN%5C30XcjW1CSTmIdlt9fIEX13UmqmMbcG3iez03JXzV%2FHYR7%2Be5JCqwx2LvS%2BviXf6jAt78kQ93%2Bm0ysRckBaTz%5Copm38K11omfURvDZP3t%5C%2F%3A1555249514578; my_game=570; _gid=GA1.2.1462298995.1557675607; accessId=572d9ba0-d737-11e8-970c-a553533099d1; not_pay_pwd_token=52099be5-184f-4b86-94c3-261ffb640c32; aliyungf_tc=AQAAAMj3oFe05gcAHRltfWP1dd0upFgm; Hm_lvt_fe0238ac0617c14d9763a2776288b64b=1558575721,1558611586,1558662844,1558699576; href=https%3A%2F%2Fwww.igxe.cn%2Flogin%2F%3Fnext%3D%2Fsold%2F570; nice_id572d9ba0-d737-11e8-970c-a553533099d1=547664a2-7e1c-11e9-acac-513c32136d3b; csrftoken=znXgHuGgAlBHoyhmMci9sgTxDQoVvvdv; token=0d21f32f-5a2a-4b91-984c-31c1bd004124; sessionid=nyledr335c0tprz9q68zwjteix7vluld; myDateMinutes=18; _gat=1; qimo_seosource_572d9ba0-d737-11e8-970c-a553533099d1=%E7%AB%99%E5%86%85; qimo_seokeywords_572d9ba0-d737-11e8-970c-a553533099d1=; pageViewNum=598; Hm_lpvt_fe0238ac0617c14d9763a2776288b64b=1558707579";
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