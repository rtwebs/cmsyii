<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => false,
            // Disable site/ from the URL
            'rules' => [
                '<id:\d+>/<alias:[A-Za-z0-9 -_.]+>' => 'articles/categories/view',
                '<cat>/<id:\d+>/<alias:[A-Za-z0-9 -_.]+>' => 'articles/items/view',
            ],
        ],
        'authManager' => [
                           'class' => 'yii\rbac\DbManager',
                           'defaultRoles' => ['guest'],
          ],
    ],
    'modules' => [
        'user' => [
    	        'class' => 'dektrium\user\Module',
    	        'enableUnconfirmedLogin' => true,
    	        'admins' => ['sroot']
    	    ],
    	    
    	'articles' => [
            'class' => 'cinghie\articles\Articles',
            'userClass' => 'dektrium\user\models\User',

            // Select Languages allowed
            'languages' => [ 
                "it-IT" => "it-IT", 
                "en-GB" => "en-GB" 
            ],          

            // Select Editor: no-editor, ckeditor, imperavi, tinymce, markdown
            'editor' => 'ckeditor',

            // Select Image Name: categoryname, original, casual
            'imageNameType' => 'categoryname',
            // Select Image Types allowed
            'imageType'     => 'jpg,jpeg,gif,png',
            // Select Image Types allowed
            'attachType'    => 'application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, .csv, .pdf, text/plain, .jpg, .jpeg, .gif, .png',
            // Thumbnails Options
            'thumbOptions'  => [ 
                'small'  => ['quality' => 100, 'width' => 150, 'height' => 100],
                'medium' => ['quality' => 100, 'width' => 200, 'height' => 150],
                'large'  => ['quality' => 100, 'width' => 300, 'height' => 250],
                'extra'  => ['quality' => 100, 'width' => 400, 'height' => 350],
            ],
        ],
        'gii' => [
            'class' => 'yii\gii\Module',  
            'allowedIPs' => ['104.156.228.84']
        ],
        // Module Kartik-v Grid
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],

        'rbac' => [
                'class' => 'dektrium\rbac\Module',
            ],
        // Module Kartik-v Markdown Editor
        'markdown' => [
            'class' => 'kartik\markdown\Module',
        ],

	],

];
