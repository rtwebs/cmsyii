<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name'=>'eCMS',
    'basePath' => dirname(__DIR__),
    //'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        // 'log' => [
        //     'traceLevel' => YII_DEBUG ? 3 : 0,
        //     'targets' => [
        //         [
        //             'class' => 'yii\log\FileTarget',
        //             'levels' => ['error', 'warning'],
        //         ],
        //     ],
        // ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
                           'class' => 'yii\rbac\DbManager',
                           'defaultRoles' => ['guest'],
          ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
    'modules' => [
        'user' => [
        'class'  => 'dektrium\user\Module',
            // following line will restrict access to admin controller from frontend application
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
        'articles' => [
            // Select Path To Upload Category Image
            'categoryImagePath' => '@webroot/img/articles/categories/',
            // Select URL To Upload Category Image
            'categoryImageURL'  => '@web/img/articles/categories/',
            // Select Path To Upload Category Thumb
            'categoryThumbPath' => '@webroot/img/articles/categories/thumb/',
            // Select URL To Upload Category Image
            'categoryThumbURL'  => '@web/img/articles/categories/thumb/',

            // Select Path To Upload Item Image
            'itemImagePath' => '@webroot/img/articles/items/',
            // Select URL To Upload Item Image
            'itemImageURL'  => '@web/img/articles/items/',
            // Select Path To Upload Item Thumb
            'itemThumbPath' => '@webroot/img/articles/items/thumb/',
            // Select URL To Upload Item Thumb
            'itemThumbURL'  => '@web/img/articles/items/thumb/',

            // Show Titles in the views, 
            'showTitles' => true,
        ],
    ],
];
