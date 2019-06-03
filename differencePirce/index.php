<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/6 0006
 * Time: 13:27
 */
index();

function index(){

    try{



        $pdo = new PDO("mysql:host=localhost;dbname=lic","root","root");

        $pdo->exec('set names utf8');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select * from price_difference where difference>5 and price_c5<200 order by difference+0 limit 20";

        $res = $pdo->query($sql);

        $result = $res->fetchAll(PDO::FETCH_ASSOC);

        include("indexHtml.php");


    }catch (PDOException $e) {

        echo $e->getMessage();

    };



}

function buy(){

    return 123;

}
