<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

use rmrevin\yii\fontawesome\FA;



?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<?php $this->beginBody() ?>


<div class="wrap">
    
    <div class="blog-masthead">
    <?php
    NavBar::begin([
        'brandLabel' => 'eCMS',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'blog-nav',
            'data-author' => 'Alan',
        ],
    ]);
    $icon_home = FA::icon('home');
//    $menuItems = [
//        ['label' => $icon_home.'Home', 'url' => ['/site/index']],
//
//        //['label' => 'About', 'url' => ['/site/about']],
//        //['label' => 'Contact', 'url' => ['/site/contact']],
//    ];

    $menuItems[] = Html::a( $icon_home.' Inicio', ['/site/index'],  ['class'=>'blog-nav-item'] );
    
    $icon_home = FA::icon('list');
    
    $menuItems[] = Html::a( $icon_home.' Posts', ['/posts/all'],  ['class'=>'blog-nav-item '.(Yii::$app->controller->id=='posts' ? 'active' : '') ]  );
    
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Signup', 'url' => ['/user/registration/register']];
        
        $icon_home = FA::icon('plus');
        
        $menuItems[] = Html::a( $icon_home.' Sign up', ['/user/registration/register'],  ['class'=>'blog-nav-item '.(Yii::$app->controller->id=='registration' ? 'active' : '')] );
        
        $icon_home = FA::icon('sign-in');
        
        //$menuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];
        
        $menuItems[] = Html::a( $icon_home.' Sign in', ['/user/security/login'], ['class'=>'blog-nav-item '.(Yii::$app->controller->id=='security' ? 'active' : '')] );
        
        //Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-user']) . ' Sign Up ', ['site/signup'], ['class' => 'btn btn-black', 'title' => 'Sign Up'])
        
    } else {
        $icon_home = FA::icon('sign-in');
        $menuItems[] = ''
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                $icon_home.' Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link blog-nav-item']
            )
            . Html::endForm()
            . '';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    
    </div>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left hide">&copy; eCMS <?= date('Y') ?></p>

        <p class="pull-right">With <i class="fa fa-heart" style="color: #428bca"></i> by <strong>eCMS</strong></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
