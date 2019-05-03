<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/5 0005
 * Time: 11:38
 */
//date_default_timezone_set("Asia/Shanghai");
//echo  date("Y-m-d h:i:sa");;

$t = '斯卡迪';
$s = '斯卡迪';

if($t==$s){

    echo 1;
}else{

    echo 2;
}

//$file  = 'D:\workspace\log.txt';//要写入文件的文件名（可以是任意文件名），如果文件不存在，将会创建一个
// $content = "第一次写入的内容";
//
// if($f  = file_put_contents($file, $content."\n",FILE_APPEND)){// 这个函数支持版本(PHP 5)
//     echo "写入成功。<br />";}
// $content = "第二次写入的内容";
// if($f  = file_put_contents($file, $content,FILE_APPEND)){// 这个函数支持版本(PHP 5)
//         echo "写入成功。<br />";  }


//echo "hellow world";die;
//$pdo = new PDO("mysql:host=localhost;dbname=lic","root","");
//$rs = $pdo -> query("select content from lic_first");
//$row = $rs -> fetch();
//echo '<pre>';
//print_r(array($row));
//die;
//echo "<html>
//    <input type='input'value='test'>
//    <select >
//        <option>1</option>
//        <option>12</option>
//        <option>13</option>
//    </select>
//    <input type='button' value='确定'>
//    <img src='https://i.c5game.com/image/u-2533525aee8cac1b09c.jpg@300w_300h_1e_1c' >
//</html>";
////$utf8 = @preg_replace("/\\\u([0-9a-f]{4})/ie", "iconv('UTF-16BE', 'UTF-8', pack('H4','\\1'))", '\u4fee\u6539\u9970\u54c1\u4ef7\u683c\u6210\u529f0\u4ef6,\u5931\u8d251\u4ef6');
////echo $utf8;
//die;


//$cookie = 'bdshare_firstime=1495112656374; fp_ver=3.3.3; BSFIT_OkLJUJ=FFBqPVR-F9hmdg-zTUxNdxvoJUwJAI8P; BSFIT_DEVICEID=By3w4BbUbCpg3rijooGXLYUOhJ5DbIgY7h-9Iq6K7SZb_AljkrSOAS6Powiq7grc0HqpCUH1xMZgru0nAZ2ZnLPRyMZXmGGUrXUz64wskn5a4JSz8s_FtruUXmHE1xJuDslfpLXtqyXPhJa5Ld9qQjM1WfGOVVGd; MEIQIA_EXTRA_TRACK_ID=0wnpBv1NMrGhzg6IkdfVZB6AYSP; buyKnowNotice=close; C5Machines=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; C5buygame=Y; C5Appid=570; C5Lang=zh; C5NoticeBounces1555403740=close; C5Notice1555403740=close; C5Sate=29899df08071363644fe55e1e682693ad0d980eca%3A4%3A%7Bi%3A0%3Bs%3A6%3A%22253352%22%3Bi%3A1%3Bs%3A11%3A%2218758000957%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5NoticeBounces1555558523=close; C5Notice1555558523=close; C5Steamurl=true; C5SessionID=7497ijne25hdsv9o941hljupc1; C5Token=5cbac9959fe30; C5Login=253352; C5_NPWD=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1555302944,1555473868,1555560364,1555745175; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1555745726=';
//
//$url = 'https://www.c5game.com/api/purchase/cancel';//取消求购
//$url = 'https://www.c5game.com/api/sell/changePrice.json?appid=570';//改价
//$url = 'https://www.c5game.com/api/purchase/submit';//求购


//$curl = curl_init();
//curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
//curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
//curl_setopt($curl,CURLOPT_HEADER,1);
//curl_setopt($curl,CURLOPT_POST,1);
//改价
//$data = array(
//            'verify_code' => '',
//            'price[]' => '18.94',
//            'id[]' => '726202320',
//            'note[]' => '',
//            'memo[]' => ''
//);

//取消求购
//$data = array(
//    'id' => 729716567,
//);

//求购
//$data = array(
//
//    'price' => 1,
//    'num' => 1,
//    'paypwd' => 666666,
//    'delivery' => 'on',
//    'id' => '553468481',//item_id
//    'appid' => 570,
//
//);

//curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
//
//curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
//curl_setopt($curl, CURLOPT_COOKIE, $cookie);
//
//$res = curl_exec($curl);
//print_r(json_decode($res));
