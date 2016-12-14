<?php

namespace app\controllers;

use app\models\task\Goods;
use app\models\task\Order;
use app\models\task\User;
use yii\helpers\Url;
use yii\web\Controller;

class OrderController extends Controller {

    public $enableCsrfValidation = false;

    public function actionAdd()
    {
        $goods_id = \Yii::$app->request->get('goods_id');
        $username = \Yii::$app->session->get('username');
        $content = User::findOne(['username'=>$username]);

        $goods = Goods::find()->where(['username'=>$username,'status'=>0])->all();
        $order = new Order();

        if(\Yii::$app->request->isPost) {
            $order->attributes = \Yii::$app->request->post('Order');
            if($order->process()) {
                $this->redirect(Url::toRoute(['order/show','order_id'=>$order->id]));
            }
        }
        return $this->renderPartial('add',['content'=>$content,'goods'=>$goods,'order'=>$order,'goods_id'=>$goods_id]);
    }


    public function actionShow()
    {
        $order_id = \Yii::$app->request->get('order_id');

        $goods_id1 = Order::findOne(['id'=>$order_id])->goods_id1;
        $goods_id2 = Order::findOne(['id'=>$order_id])->goods_id2;


        $username1 = Goods::findOne(['id'=>$goods_id1])->username;
        $u1_tel = User::findOne(['username'=>$username1])->tel;
        $goods_name1 = Goods::findOne(['id'=>$goods_id1])->goods_name;
        $desc1 = Goods::findOne(['id'=>$goods_id1])->goods_desc;

        $username2 = Goods::findOne(['id'=>$goods_id2])->username;
        $u2_tel = User::findOne(['username'=>$username2])->tel;
        $goods_name2 = Goods::findOne(['id'=>$goods_id2])->goods_name;
        $desc2 = Goods::findOne(['id'=>$goods_id2])->goods_desc;


        $data['order_id'] = $order_id;
        $data['username1'] = $username1;
        $data['username2'] = $username2;

        $data['u1_tel'] = $u1_tel;
        $data['u2_tel'] = $u2_tel;

        $data['goods_name1'] = $goods_name1;
        $data['goods_name2'] = $goods_name2;

        $data['desc1'] = $desc1;
        $data['desc2'] = $desc2;


        return $this->renderPartial('show',['data'=>$data]);
    }

    public function actionShowOrder()
    {
        $ids = \Yii::$app->request->get('order_ids') ? \Yii::$app->request->get('order_ids') : [];
        //如果ids为空
        if(!$ids) {
            return $this->renderPartial('show-noorder');
        }

        foreach($ids as $id) {
            $data[] = Order::find()->where(['id'=>$id])->asArray()->one();
        }

        $bbb = [];
        foreach($data as $v){
            $goods_id1 = $v['goods_id1'];
            $goods_id2 = $v['goods_id2'];

            $username1 = Goods::findOne(['id'=>$goods_id1])->username;
            $u1_tel = User::findOne(['username'=>$username1])->tel;
            $goods_name1 = Goods::findOne(['id'=>$goods_id1])->goods_name;
            $desc1 = Goods::findOne(['id'=>$goods_id1])->goods_desc;

            $username2 = Goods::findOne(['id'=>$goods_id2])->username;
            $u2_tel = User::findOne(['username'=>$username2])->tel;
            $goods_name2 = Goods::findOne(['id'=>$goods_id2])->goods_name;
            $desc2 = Goods::findOne(['id'=>$goods_id2])->goods_desc;


            $aaa['order_id'] = $v['id'];

            $aaa['status'] = $v['status'];
            $aaa['username1'] = $username1;
            $aaa['username2'] = $username2;

            $aaa['goods_id1'] = $goods_id1;
            $aaa['goods_id2'] = $goods_id2;

            $aaa['u1_tel'] = $u1_tel;
            $aaa['u2_tel'] = $u2_tel;

            $aaa['goods_name1'] = $goods_name1;
            $aaa['goods_name2'] = $goods_name2;

            $aaa['desc1'] = $desc1;
            $aaa['desc2'] = $desc2;


            $bbb[] = $aaa;
        }


        return $this->renderPartial('show-order',['bbb'=>$bbb]);
    }


    public function actionAjaxSubmit()
    {
        $order_id =  \Yii::$app->request->get('order_id');
        $res = \Yii::$app->request->get('res');

        if($res == 0) {
            $order = Order::findOne(['id'=>$order_id]);
            $order->status = 0;
            if($order->save()) {
                echo 0;exit;
            }
            exit;
        }

        $order = Order::findOne(['id'=>$order_id]);
        $order->status = 1;
        if($order->save()) {
            echo 1;
        }
    }

    public function actionAjaxStatus() {
        $order_id =  \Yii::$app->request->get('order_id');
        $order = Order::findOne(['id'=>$order_id]);
        echo $order->status;
    }

}