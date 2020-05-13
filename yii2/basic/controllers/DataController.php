<?php

namespace app\controllers;

use app\models\base;
use app\models\Csgo;
use app\models\PriceDifference;
use app\models\Replenish;
use app\models\UserConfig;
use Codeception\Module\Redis;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\Pagination;
use yii\web\simple_html_dom;
use yii\helpers\Html;




class DataController extends Controller
{

    public $enableCsrfValidation=false;


   public function actionIndex()
   {

//       $sql = "select * from price_difference where difference>2 order by difference+0";
//
//       $res = Yii::$app->db->createCommand($sql);
//
//       $data = $res->queryAll();

//       $data = PriceDifference::findBySql($sql);
//
//       $data = PriceDifference::find()->andFilterWhere(['>','difference','10'])->orderBy([new \yii\db\Expression('FIELD (difference, difference+0)')]);

       $bundle = Yii::$app->request->get('bundle');
//
//       print_r($_GET);die;

       $k = Yii::$app->request->get('k');

       if($k){

           if(is_numeric($k)){

               $data = PriceDifference::find()->where(['>', 'difference', $k*100]);

           }else{

               $k = trim($k);

               $data = PriceDifference::find()->where(['like', 'name', $k]);

           }


       }else{

           $data = PriceDifference::find();

       }

       if(Yii::$app->request->get('H1Z1')){

           $data->andWhere('appid = :appid', array(':appid' => 433850));

       }else{

           if($bundle){

               $data->andWhere('type = :type', array(':type' => PriceDifference::TYPE_BUNDLE));

           }elseif(Yii::$app->request->get('immortal')){

               $data->andWhere('type = :type', array(':type' => PriceDifference::TYPE_IMMORTAL));

           }elseif(Yii::$app->request->get('unique')){

               $data->andWhere('type = :type', array(':type' => PriceDifference::TYPE_UNIQUE));

           }

           $data->andWhere('appid = :appid', array(':appid' => 570));

       }

       if(Yii::$app->request->get('sort')){

           $data->orderBy('name');

       }else{

           $data->orderBy('difference');

       }

       $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
       $model = $data->offset($pages->offset)->limit($pages->limit)->all();

       return $this->render('index',[
           'model' => $model,
           'pages' => $pages,
           'k'=>$k,
           'bundle' => $bundle,
           'immortal' => Yii::$app->request->get('immortal'),
           'unique' => Yii::$app->request->get('unique'),
           'H1Z1' => Yii::$app->request->get('H1Z1'),
           'sort' => Yii::$app->request->get('sort'),

       ]);

   }

    public function actionUpdate()
    {

        $id = Yii::$app->request->post('id');
        $base = new base();

        $data = $base->updateInfo($id);

        echo json_encode($data);

    }

    public function actionBuy()
    {

        $id = Yii::$app->request->post('id');
        $base = new base();

        $data = $base->c5Buy($id);

        echo json_encode($data);
    }

    public function actionPurchase()
    {

        $id = Yii::$app->request->post('id');
        $base = new base();

        $data = $base->purchase($id);

        echo json_encode($data);

    }

    public function actionReplenish()
    {

        if(Yii::$app->user->isGuest){

            $this->redirect('index.php?r=site/login');

        }

        $user_id = Yii::$app->user->id;

        $get = Yii::$app->request->get();

        $day =  date('Y-m-d');

        if(isset($get['start_time'])){

            if($get['start_time']){

                $day = $get['start_time'];

            }
        }

        $time = strtotime($day);

        $data = Replenish::find()->where('sell_day >=:sell_day and user_id=:user_id', array(':sell_day'=> $time, ':user_id'=>$user_id))->orderBy('sold_time desc, id');

        if($data->count() == 0){

            $base = new base();

            $base->updateReplenishInfo($day);

            $data = Replenish::find()->where('sell_day >=:sell_day and user_id=:user_id', array(':sell_day'=> $time, ':user_id'=>$user_id))->orderBy('sold_time desc, id');

        }

        $sum = Replenish::find()->join('left join','price_difference', 'replenish.item_id_igxe=price_difference.item_id_igxe')->where('replenish.sell_day>=:sell_day and replenish.user_id=:user_id', array(':sell_day'=>$time, 'user_id'=>$user_id))->sum('price_difference.difference');

        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '12']);
        $model = $data->offset($pages->offset)->limit($pages->limit)->all();

        $id_arr = array();

        foreach($model as $e){

            $id_arr[] = $e->itemInfo['id'];

        }

        $id_str = implode(',', $id_arr);


        return $this->render('replenish', array(

            'model' => $model,
            'pages' => $pages,
            'day' => $day,
            'sum' => $sum,
            'idstr' => $id_str,
        ));

    }

    public function actionUpdateSold()
    {

//        Yii::$app->getSession()->setFlash('success', 'This is the message');

        $get = Yii::$app->request->get();

        $day = $get['start_time'];

        $base = new base();

        $base->updateSold($day);

        $this->redirect('index.php?r=data/replenish&start_time='.$day);
    }

    public function actionUpdateAll()
    {
        set_time_limit(0);
        $idstr = Yii::$app->request->post('idstr');
        $base = new base();

        $idarr = explode(',', $idstr);

        foreach($idarr as $id){

            $base->updateInfo($id);

        }

        echo json_encode(array('status' => 200));
    }

    public function actionBundle()
    {
        set_time_limit(0);

        $base = new base();

        $type = Yii::$app->request->get('type');

        $base->updateBundle($type);

        $base->updateBundleC5($type);

        $this->redirect('index.php');

    }

    public function actionCreate()
    {
        $cookie = Yii::$app->request->get('cookie');

        $name = Yii::$app->request->get('name');

        if(!$name)
        {
            return $this->renderAjax('create');

        }else{

            if($cookie){

                $user_id = Yii::$app->user->id;

                if($user_id){

                    $pwd = Yii::$app->request->get('pwd');

                    $data = UserConfig::find()->where('user_id =:user_id and web =:web', array(':user_id' => $user_id, ':web' => $name))->one();

                    if($data){

                        $data->cookie = $cookie;
                        $data->pwd = $pwd;

                        $data->save();


                    }else{

                        $user_config = new UserConfig();

                        $user_config->user_id = $user_id;
                        $user_config->cookie = $cookie;
                        $user_config->web = $name;
                        $user_config->pwd = $pwd;

                        $user_config->save();

                    }

//                        $key = 'cookie_ig'.$user_id;
//                        $redis->set($key, $cookie);
//                        $redis->expire($key, 84600*30);

                }

                Yii::$app->getSession()->setFlash('success', 'update infomation success');

            }else{

                Yii::$app->getSession()->setFlash('error', 'update error');

            }

            $this->redirect('index.php?r=data/replenish');

        }

    }

    public function actionChangePrice()
    {

        $base = new base();

        $sell_url = 'https://www.c5game.com/user/sell/index.html?appid=433850';

        $html = $base->curl($sell_url);

        $dom = new simple_html_dom();

        $dom->load($html);

        foreach($dom->find('.keys') as $e){

            preg_match_all('/<span>.*?<\/span>/', $e->innertext , $res);

        }

        $dom->clear();

        $str = '?self_sell_type=1&appid=433850';

        foreach($res[0] as $v){

            $v = $base->getNum($v);

            $str .= '&id[]='.$v;

        }

        $info_url = 'https://www.c5game.com/api/sell/changePriceQuick'.$str;

        $info = $base->curl($info_url);

        $info = json_decode($info);

        foreach($info->{'body'}->{'items'} as $i){

            if(ceil($i->money_min_sell*100) == $i->price){

                $base = new base();

                $price_t = $base->confirmPrice($i->item_id);

                if($price_t != $i->price){

                    $id[] = $i->id;

                    $price[] = ($price_t-1)/100;

                }

                continue;

            }

            $id[] = $i->id;

            $min = $i->money_min_sell-0.01;

            if(!$min){

                $min = 0.01;
            }

            $price[] = $min;

        }

        $data = array(

            'verify_code' => '',
            'price_policy' => 1,
            'id' => $id,
            'price' => $price,

        );

        $change_url = 'https://www.c5game.com/api/sell/changePrice.json?appid=';

        $data = http_build_query($data);

        $callback = $base->curl($change_url, $data);

        $callback = json_decode($callback);

        print_r($callback->message);
    }


    public function actionAutosp()
    {

        $k = Yii::$app->request->get('k');

        $sql = "SELECT * FROM `price_difference` WHERE appid = 433850 and price_c5-purchase_c5>400 and price_c5<15000  ORDER BY (price_c5-purchase_c5)";

        $res = Yii::$app->db->createCommand($sql);

        $data = $res->queryAll();

//        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
//        $model = $data->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('autosp',[

            'model' => $data,
            'k' => $k,
//            'pages' => $pages,

        ]);
    }

    public function actionUpdateh1z1()
    {
        set_time_limit(0);
//        $data = PriceDifference::find('id')->where('appid = :appid', array(':appid' => 433850))->all();

        $sql = "SELECT * FROM `price_difference` WHERE appid = 433850 and price_c5-purchase_c5>400 and price_c5<15000  ORDER BY (price_c5-purchase_c5)";

        $res = Yii::$app->db->createCommand($sql);

        $data = $res->queryAll();

        $base = new base();

        foreach($data as $e){

            $base->updateInfo($e['id']);

        }

        echo json_encode(array('status' => 200));

    }

    public function actionTest()
    {

        $base = new base();

        $base->updateBundleBuff();

    }

    public function actionCsgo()
    {

        $data = Csgo::find();

        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '8']);
        $model = $data->offset($pages->offset)->limit($pages->limit)->all();


        return $this->render('csgo', array(

            'model' => $model,
            'pages' => $pages,

        ));

    }

    public function actionUpdatecsgo()
    {

        $base = new base();

        $base->updateCsgoC5();

    }
}
