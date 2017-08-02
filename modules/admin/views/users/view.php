<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
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


        ],
    ]) ?>

</div>
