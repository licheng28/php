<?php

namespace app\controllers;

use app\models\base;
use app\models\PriceDifference;
use app\models\Replenish;
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

               $data = PriceDifference::find()->where(['like', 'name', $k]);

           }


       }else{

           $data = PriceDifference::find();

       }

       if($bundle){

           $data->andWhere('type = :type', array(':type' => PriceDifference::TYPE_BUNDLE));

       }

       $data->orderBy('difference');

       $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
       $model = $data->offset($pages->offset)->limit($pages->limit)->all();

       return $this->render('index',[
           'model' => $model,
           'pages' => $pages,
           'k'=>$k,
           'bundle' => $bundle

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



        $get = Yii::$app->request->get();

        $day =  date('Y-m-d');

        if(isset($get['start_time'])){

            if($get['start_time']){

                $day = $get['start_time'];

            }
        }

        $time = strtotime($day);

        $sum = Replenish::find()->join('left join','price_difference', 'replenish.item_id_igxe=price_difference.item_id_igxe')->where('replenish.sell_day>='.$time)->sum('price_difference.difference');

        $data = Replenish::find()->where('sell_day >='.$time)->orderBy('sold_time desc');

        if($data->count() == 0){

            $base = new base();

            $base->updateReplenishInfo($day);

            $data = Replenish::find()->where('sell_day >='.$time)->orderBy('sold_time desc');

        }

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

        $get = Yii::$app->request->get();

        $day = $get['start_time'];

        $base = new base();

        $base->updateSold($day);

        $this->redirect('index.php?r=data/replenish&start_time='.$day);
    }

    public function actionUpdateAll()
    {
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

        $base->updateBundle();

        $base->updateBundleC5();

        $this->redirect('index.php');

    }
}
