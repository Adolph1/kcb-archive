<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Advance Search');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-9" style="margin-left: 20px">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-search"></i><strong> <?= strtoupper($this->title);?></strong></h3>
    </div>
</div>
<hr>
<div class="col-md-12 pull-right">
    <div class="btn-group btn-group-justified">
        <?= Html::a(Yii::t('app', '<i class="fa fa-plus text-white"></i> Add new box'), ['create'], ['class' => 'btn btn-primary btn-block']) ?>
        <?= Html::a(Yii::t('app', '<i class="fa fa-search text-white"></i> Advance search'), ['advancesearch'], ['class' => 'btn btn-primary btn-block']) ?>
        <?= Html::a(Yii::t('app', ' <i class="fa fa-eye text-white"></i> View Box List'), ['index'], ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <hr></div>

<div class="item-index">
    <legend class="scheduler-border" style="color:#005DAD">Search criteria</legend>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    if(isset($_GET['ItemSearch'])) {

        ?>
        <legend class="scheduler-border" style="color:#005DAD">Search Results</legend>
        <?= \fedemotta\datatables\DataTables::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',

                'item_name',
                'year',
                'description:ntext',
                //'shelve_id',
                [
                    'attribute' => 'location_id'
                    , 'value' => 'location.location_name',
                ],
                'item_reference',
                [
                    'attribute' => 'branch_id'
                    , 'value' => 'branch.branch_name',
                ],
                [
                    'attribute' => 'department_id'
                    , 'value' => 'department.dept_name',
                ],

                // 'status',
                // 'maker_id',
                // 'maker_time',


                [
                    'class'=>'yii\grid\ActionColumn',
                    'header'=>'Actions',
                    'template'=>'{view}',
                    'buttons'=>[
                        'view' => function ($url, $model) {
                            $url=['view','id' => $model->id];
                            return Html::a('<span class="fa fa-eye"></span>', $url, [
                                'title' => 'View',
                                'data-toggle'=>'tooltip','data-original-title'=>'Save',
                                'class'=>'btn btn-info',

                            ]);


                        },

                    ]
                ],
            ],
        ]);
    }
    ?>
</div>


