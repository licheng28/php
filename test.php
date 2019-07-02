<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/5 0005
 * Time: 11:38
 */
$s = array(
  0=>1,
    1=>2,
    2=>3
);
$a = implode('-',$s);
$b = explode('.',$a);
$c = 'skjdhfasdfkl';
trim($c);
$checkmail="/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";
$d = "/^[\w\.]+@[\w]+(\.[a-zA-Z]+){1,3}$/";
$f = "/^1[87][\d]{8}$/";
//echo preg_match($f,"1875800095",$match);
//$file = fopen('yii2.txt', 'r');
//
//$size = filesize('yii2.txt');
//
//$content = fread($file,$size);
//
//fclose($file);
//
//echo file_get_contents('yii2.txt');

$dir = opendir('D:\workspace\php');

while(($name=readdir($dir))!==false){

    if($name!='.'&&$name!='..'){

        echo $name.'</br>';

        if(filetype($name)=='dir'){

            $dir_c = opendir($name);

            while(($name_c=readdir($dir_c))!==false){

                echo $name_c.'*<br>';

            }

        }

    }

}




//date_default_timezone_set("Asia/Shanghai");
//echo  date("Y-m-d h:i:sa");;
//$cookie = 'C5Machines=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; C5Lang=zh; C5Appid=570; C5Notice1558575896=close; C5Sate=29899df08071363644fe55e1e682693ad0d980eca%3A4%3A%7Bi%3A0%3Bs%3A6%3A%22253352%22%3Bi%3A1%3Bs%3A11%3A%2218758000957%22%3Bi%3A2%3Bi%3A259200%3Bi%3A3%3Ba%3A0%3A%7B%7D%7D; C5SessionID=oqmjotlbf6flvv3tgpt9smm1r5; C5Token=5cebe430de6b7; C5Login=253352; Hm_lvt_86084b1bece3626cd94deede7ecf31a8=1558891615,1558891662,1558891775,1558963252; C5_NPWD=fbmKgZj2PmMmtu%2BOOyePtg%3D%3D; Hm_lpvt_86084b1bece3626cd94deede7ecf31a8=1558974326';
//
//$url_purchase_item = 'https://www.c5game.com/api/purchase/item';
//
//$data_item = array(
//
//    'id' => 2626
//
//);
//
//$curl = curl_init();
//curl_setopt($curl, CURLOPT_URL, $url_purchase_item);
//curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
//curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
////    curl_setopt($curl,CURLOPT_HEADER,1);
//curl_setopt($curl, CURLOPT_COOKIE, $cookie);
//curl_setopt($curl,CURLOPT_POSTFIELDS,$data_item);
//
//$html =  curl_exec($curl);
//
//curl_close($curl);
//
//$content = json_decode($html);
//
//$min_price = $content->{'body'}->{'item'}->{'min_price'};
//
//
//
//    if($min_price>=100){
//
//        $price = ceil($min_price);
//
//    }else{
//
//
//        $price = ceil(($min_price*10))/10;
//
//    }
//
//    echo $price;die;
//
//    $url_purchase_submit = 'https://www.c5game.com/api/purchase/submit';
//
//    $purchase_data = array(
//
//        'price' => $price,
//        'num' => 1,
//        'paypwd' => $pwd,
//        'delivery' => 'on',
//        'id' => $item_id,//item_id
//        'appid' => 570,
//
//    );
//
//
//    $message = $message .'  发布求购成功,物品名称 = '.$name.',花费金额:'.$purchase_data['price'];

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