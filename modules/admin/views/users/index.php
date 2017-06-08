<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email',
            'phone',
            ['attribute'=>'ФИО',
                'format'=>'raw',
                'value'=>function($data){
        return $data->firstname.' '.$data->name;
                }],
[
    'attribute'=>'Роль',
    'format'=>'raw',
    'value'=>function($data){
        switch ($data->role_id) {
            case User::ADMIN:
                return 'Админ';
                break;
            case User::MANAGER:
                return 'Менеджер';
                break;
            case User::BUYER:
                return 'Покупатель';
                break;
        }
    }
],
            [
                'attribute'=>'Статус',
                'format'=>'raw',
                'value'=>function($data){
                                switch ($data->flags){
                                    case 0:
                                        return 'Не активен';
                                        break;
                                    case 1:
                                        return 'Активен';
                                        break;
                                }
                }
            ],
            [
                'attribute'=>'Купоны',
                'format'=>'raw',
                'value'=>function($data){
                   return Html::a('Перейти', '/admin/coupon/view?id='.$data->id);
                    }

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
