<?php

namespace app\controllers;

use app\models\task\Goods;
use yii\web\Controller;

class IndexController extends Controller{

    public function actionIndex()
    {
        $m_goods = new Goods();

        //衣服数据
        $goods_clothes = $m_goods->find()->where(['status'=>0,'goods_type'=>'clothes'])->limit(7)->all();
        $clo_num = $m_goods->find()->where(['status'=>0,'goods_type'=>'clothes'])->count();

        //Bicycle数据
        $goods_bike = $m_goods->find()->where(['status'=>0,'goods_type'=>'bike'])->limit(7)->all();
        $bike_num = $m_goods->find()->where(['status'=>0,'goods_type'=>'bike'])->count();

        //Books数据
        $goods_book = $m_goods->find()->where(['status'=>0,'goods_type'=>'book'])->limit(6)->orderBy('add_time desc')->all();
        $book_num = $m_goods->find()->where(['status'=>0,'goods_type'=>'book'])->count();

        //Furniture数据
        $goods_art = $m_goods->find()->where(['status'=>0,'goods_type'=>'art'])->limit(7)->all();
        $art_num = $m_goods->find()->where(['status'=>0,'goods_type'=>'art'])->count();

        return $this->renderPartial('index',['goods_clothes'=>$goods_clothes,'goods_art'=>$goods_art,'goods_book'=>$goods_book,'goods_bike'=>$goods_bike,'clo_num'=>$clo_num,'bike_num'=>$bike_num,'book_num'=>$book_num,'art_num'=>$art_num]);
    }

    public function actionDetail()
    {
        $id = \Yii::$app->request->get('id');
        $content = Goods::findOne(['id'=>$id]);
        return $this->renderPartial('detail',['content'=>$content]);
    }
}