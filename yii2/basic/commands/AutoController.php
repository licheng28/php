<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/29 0029
 * Time: 13:01
 */
namespace app\commands;

use app\models\base;
use app\models\PriceDifference;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\web\simple_html_dom;

class AutoController extends Controller
{

    public function actionIndex()
    {

        $base = new base();

        $sell_url = 'https://www.c5game.com/user/sell/index.html';

        $html = $base->curl($sell_url);

        $dom = new simple_html_dom();

        $dom->load($html);

        $id_arr = array();

        foreach($dom->find('.keys') as $e){



        }

    }

}