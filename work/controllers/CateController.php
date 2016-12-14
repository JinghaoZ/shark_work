<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\task\Goods;
use yii\data\Pagination;

class CateController extends Controller {

    public function actionBike()
    {
        $m_goods = new Goods();
        $goods_bike = $m_goods->find()->where(['status'=>0,'goods_type'=>'bike'])->all();
        return $this->renderPartial('bike',['goods_bike'=>$goods_bike]);
    }

    public function actionClothes()
    {
        $m_goods = new Goods();
        $goods_clothes = $m_goods->find()->where(['status'=>0,'goods_type'=>'clothes'])->all();
        return $this->renderPartial('clothes',['goods_clothes'=>$goods_clothes]);
    }

    public function actionBook()
    {
        $m_goods = new Goods();

        $data = Goods::find()->where(['status'=>0,'goods_type'=>'book']);

        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '6']);

        $goods_book = $data->offset($pages->offset)->limit($pages->limit)->all();

        return $this->renderPartial('book',['goods_book'=>$goods_book,'pages'=>$pages]);
    }

    public function actionArt()
    {
 
        $m_goods = new Goods();

        $data = Goods::find()->where(['status'=>0,'goods_type'=>'art']);

        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '6']);

        $goods_art = $data->offset($pages->offset)->limit($pages->limit)->all();

        return $this->renderPartial('art',['goods_art'=>$goods_art,'pages'=>$pages]);
    }
}