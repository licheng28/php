<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/5 0005
 * Time: 16:42
 */
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;



class DefaultController extends Controller
{

    public function actionIndex()
    {

        return $this->render('index');

    }



}