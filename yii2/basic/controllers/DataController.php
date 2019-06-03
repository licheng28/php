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




class DataController extends Controller
{
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

       $k = Yii::$app->request->get('k');

       if($k){

           if(is_numeric($k)){

               $data = PriceDifference::find()->where(['>', 'difference', $k*100])->orderBy('difference');

           }else{

               $data = PriceDifference::find()->where(['like', 'name', $k])->orderBy('difference');

           }


       }else{

           $data = PriceDifference::find()->orderBy('difference');

       }

       $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
       $model = $data->offset($pages->offset)->limit($pages->limit)->all();

       return $this->render('index',[
           'model' => $model,
           'pages' => $pages,
           'k'=>$k
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
        $k = Yii::$app->request->get('k');

        $day =  date('Y-m-d');

        $time = strtotime($day);

        $data = Replenish::find()->where('sell_day ='.$time);

        if($data->count() == 0){

            $base = new base();

            $base->updateReplenishInfo($day);

            $data = Replenish::find()->where('sell_day ='.$time);

        }

        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
        $model = $data->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('replenish', array(

            'model' => $model,
            'pages' => $pages,
            'k'=>$k

        ));

    }

    public function actionUpdateReplenish()
    {

        $item_id_igxe = Yii::$app->request->post('id');
        $base = new base();

        $itemInfo = PriceDifference::find()->where('item_id_igxe='.$item_id_igxe)->all();

        $data = $base->updateInfo($itemInfo->id);

        echo json_encode($data);

    }


}
