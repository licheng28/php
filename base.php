<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/26 0026
 * Time: 13:52
 */
class base {

    var $cookie_c5 ='bdshare_firstime=1495112656374; fp_ver=3.3.3; BSFIT_OkLJUJ=FFBqPVR-F9hmdg-zTUxNdxvoJUwJAI8P; BSFIT_DEVICEID=By3w4BbUbCpg3rijooGXLYUOhJ5DbIgY7h-9Iq6K7SZb_AljkrSOAS6Powiq7grc0HqpCUH1xMZgru0nAZ2ZnLPRyMZXmGGUrXUz64wskn5a4JSz8s_FtruUXmHE1xJuDslfpLXtqyXPhJa5Ld9qQjM1WfGOVVGd; MEIQIA_EXTRA_TRACK_ID=0wnpBv1NMrGhzg6IkdfVZB6AYSP; buyKnowNotice=close; C5Machines=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; C5buygame=Y; C5Appid=570; C5Lang=zh; C5NoticeBounces1555403740=close; C5Notice1555403740=close; C5NoticeBounces1555558523=close; C5Notice1555558523=close; C5Steamurl=true; C5SessionID=n5saim7bo5ausckfbtgc8tff01; C5Sate=29899df08071363644fe55e1e682693ad0d980eca%3A4%3A%7Bi%3A0%3Bs%3A6%3A%22253352%22%3Bi%3A1%3Bs%3A11%3A%2218758000957%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5Token=5cbbff88bf9db; C5Login=253352; C5_NPWD=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1555473868,1555560364,1555745175,1555824487; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1555832787';
    var $cookie_ig = '_ga=GA1.2.2053708244.1523634691; distribution_channel=1249c251701509571840; _9755xjdesxxd_=32; agree_sell_agreementlic666=true; username=lic666; bad_id572d9ba0-d737-11e8-970c-a553533099d1=045e9372-3e7a-11e9-9a95-e726cc7fecda; __cfduid=d16d91c59d01d8b94b0766311e57a58091555174165; my_game=570; gdxidpyhxdE=inGqYqiqzoXCKrnoT%2B%2BscHzIhS3ItmPoqit8P3PmjO38Iv0WIqcVr0c9%2BcntBR5QGf15H%5CEaV6au1Q%2F4Wt%2FWwcnrKwp1QoEljaEaO%2FnGMDtM%5CRxuxXLsV5v%2F7GSwL04q1VPqwSdS81JckDyJ9kbP2%5Can1hwjspBqEdRBJEMfV1%5CuV%2FXD%3A1559301382617; not_pay_pwd_token=3ed4cc33-bf34-4891-a4d1-a1dd7268db60; accessId=572d9ba0-d737-11e8-970c-a553533099d1; _gid=GA1.2.620232262.1559838935; aliyungf_tc=AQAAAFTFbkjWEAMAN2Xbc4QN0mX08+6u; Hm_lvt_fe0238ac0617c14d9763a2776288b64b=1559740883,1559838935,1559871709,1559889300; qimo_seosource_572d9ba0-d737-11e8-970c-a553533099d1=%E7%AB%99%E5%86%85; qimo_seokeywords_572d9ba0-d737-11e8-970c-a553533099d1=; href=https%3A%2F%2Fwww.igxe.cn%2Flogin%2F%3Fnext%3D%2Fsold%2F570; nice_id572d9ba0-d737-11e8-970c-a553533099d1=5f3b3322-88ee-11e9-97fb-e5908bcaecf8; csrftoken=vCPRdiGQ1oB4CALrboFsxf4ux4Isnq7y; token=964b5680-6964-4ac7-872e-3c2917333199; sessionid=pb5o1b414uy05t7kk99v9ey58mncvynd; myDateMinutes=45; pageViewNum=19; _gat=1; Hm_lpvt_fe0238ac0617c14d9763a2776288b64b=1559889970';
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