<?php

namespace app\controllers;

use app\models\task\Admin;
use app\models\task\Goods;
use app\models\task\Order;
use app\models\task\User;
use yii\helpers\Url;
use yii\web\Controller;
use yii\data\Pagination;


class AdminController extends Controller{

    public $enableCsrfValidation = false;

    public function actionLogin(){

        $admin = new Admin();

        if(\Yii::$app->request->isPost){
            $admin->attributes = \Yii::$app->request->post('Admin');

            if($admin->login()) {
                return $this->redirect(Url::toRoute(['admin/index']));
            }
        }
        return $this->renderPartial('login',['model'=>$admin]);
    }


    public function actionIndex()
    {
        $order = Order::find()->asArray()->all();
        $aaa = [];

    foreach($order as $v) {
            $data['id'] = $v['id'];

            if(Goods::findOne(['id'=>$v['goods_id1']])) {
                $username1 = Goods::findOne(['id'=>$v['goods_id1']])->username;
            }else{
                $username1 = '';
            }

            if(Goods::findOne(['id'=>$v['goods_id1']])) {
                $username2 = Goods::findOne(['id'=>$v['goods_id2']])->username;
            }else{
                $username2 = '';
            }

            if(Goods::findOne(['id'=>$v['goods_id1']])) {
                $goods_name1 = Goods::findOne(['id'=>$v['goods_id1']])->goods_name;
            }else {
                $goods_name1 = '';
            }

            if(Goods::findOne(['id'=>$v['goods_id2']])) {
                $goods_name2 = Goods::findOne(['id'=>$v['goods_id2']])->goods_name;
            }else{
                $goods_name2 = '';
            }

            $data['username1'] = $username1;
            $data['username2'] = $username2;

            $data['goods_name1'] = $goods_name1;
            $data['goods_name2'] = $goods_name2;

            $data['add_time'] = $v['add_time'];

            $aaa[] = $data;
        }
        

        return $this->renderPartial('index',['data'=>$aaa]);
    }

    public function actionUser(){
       /* $users = User::find()->all();
        return $this->renderPartial('user',['users'=>$users]);*/

        $data1 = User::find();
        $pages = new Pagination(['totalCount' =>$data1->count(), 'pageSize' => '6']);

        $data = $data1->offset($pages->offset)->limit($pages->limit)->all();
        return $this->renderPartial('user',['users'=>$data,'pages'=>$pages]);
    }



    public function actionGoods(){
        $data1 = Goods::find()->where(['status'=>0]);
        $pages = new Pagination(['totalCount' =>$data1->count(), 'pageSize' => '6']);

        $data = $data1->offset($pages->offset)->limit($pages->limit)->all();

        return $this->renderPartial('goods',['data'=>$data,'pages'=>$pages]);
    }

    public function actionUserDelete() {

        $user_id = \Yii::$app->request->get('user_id');
        $user = User::findOne(['id'=>$user_id]);
        if($user->delete()){
            return $this->redirect(['admin/index']);
        }else {
            return $this->redirect(['admin/index']);
        }
    }


    public function actionOrderDelete(){
        $order_id = \Yii::$app->request->get('id');

        $order = Order::findOne(['id'=>$order_id]);
        $order->delete();
        return $this->redirect(['admin/index']);

    }


    public function actionLogout() {
        unset(\Yii::$app->session['admin']);
        \Yii::$app->session->destroy();
        return $this->redirect(Url::toRoute(['admin/login']));
    }


    public function actionSearchUser() {
        $goods_name = \Yii::$app->request->post('goods_name');

        if($goods_name) {
            $sql = 'select * from task_user where username like "%'.$goods_name.'%"';

            $data = User::findBySql($sql)->asArray()->all();

            return $this->renderPartial('find-user',['data'=>$data]);
        }
        return $this->redirect(Url::toRoute(['admin/user']));
    }


    public function actionSearchOrder() {
        $goods_name = \Yii::$app->request->post('goods_name');
        $data = [];
        if($goods_name) {
            //通过goods_id1 和 goos_id2 查看
            $sql1 = 'select * from task_goods where goods_name like "%'.$goods_name.'%"';

            $res1 = Goods::findBySql($sql1)->asArray()->all();

            foreach($res1 as $v) {
                $sql2 = 'select * from task_order where goods_id1 ='.$v["id"] .' or goods_id2 = '. $v['id'];
                $data = Order::findBySql($sql2)->asArray()->all();
            }
            $aaa = [];

            foreach($data as $v) {
                $data['id'] = $v['id'];

                $username1 = Goods::findOne(['id'=>$v['goods_id1']])->username;
                $username2 = Goods::findOne(['id'=>$v['goods_id2']])->username;

                $goods_name1 = Goods::findOne(['id'=>$v['goods_id1']])->goods_name;
                $goods_name2 = Goods::findOne(['id'=>$v['goods_id2']])->goods_name;

                $data['username1'] = $username1;
                $data['username2'] = $username2;

                $data['goods_name1'] = $goods_name1;
                $data['goods_name2'] = $goods_name2;

                $data['add_time'] = $v['add_time'];

                $aaa[] = $data;
            }

            return $this->renderPartial('find-order',['data'=>$aaa]);
        }
        return $this->redirect(Url::toRoute(['admin/index']));
    }


    public function actionSearchGoods() {
        $goods_name = \Yii::$app->request->post('goods_name');
        if($goods_name) {
            $sql = 'select * from task_goods where goods_name like "%'.$goods_name.'%" or username like "%'.$goods_name.'%"';

            $data = Goods::findBySql($sql)->asArray()->all();

            return $this->renderPartial('find-goods',['data'=>$data]);
        }
        return $this->redirect(Url::toRoute(['admin/goods']));
    }

}