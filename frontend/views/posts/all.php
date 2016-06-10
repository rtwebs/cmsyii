<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
use dosamigos\ckeditor\CKEditorInline;
$this->title = 'Posts';

?>
<div class="container">
    
    <div class="blog-header">
        <h1 class="blog-title"><?=Yii::$app->name?></h1>
        <p class="lead blog-description">Cms desarrollado bajo Yii2 en Ecuador.</p>
    </div>
      
    <div class="col-sm-8 blog-main">
    
        <?php
        if( sizeof($posts) > 0 ):
            
            //echo '<ul class="timeline">';
            foreach( $posts as $post ):
              
              
              
        ?>
            <div class="blog-post" >
              
              <h2 class="blog-post-title"><?=Html::a( ucfirst($post['post_title']) , '/posts/view/&id='.$post['post_id'], ['class' => '', 'title' => 'Ver post'])?></h2>
              
              <p class="blog-post-meta"><?=date('M d, Y', strtotime($post['post_created']))?> by <a href="javascript:;" onclick="getUserInfo(<?=$post['puid'];?>)"><?=( !empty($post['pname']) ? $post['pname'] : $post['username'])?></a></p>
              
              <p><?php echo Html::decode($post['post_content'] )?></p>
              
              
              
              <!-- Funcion::Tags -->
              <?php
                    if( !empty($post['post_tags']) ){
                      echo '<hr class="blog-post-divider">';
                      $tags = explode(',', $post['post_tags']);
                      echo '<ul class="tags">';
                      foreach( $tags as $tag ){
                        
                        if( !empty($tag))
                          echo '<li><a>'.$tag.'</a></li> ';
                        
                      }
                      
                      echo '</ul>';
                    }
                  ?>
              
              <!-- Opciones de cada Post segun roles -->
              <div class="post_options">
                <?=Html::a('<i class="fa fa-eye"></i> Leer m&aacute;s', '/posts/view/&id='.$post['post_id'], ['class' => 'btn btn-info', 'title' => 'Ver post'])?>
              </div>
              
              <br>
              <hr class="blog-post-divider">
              
              
            </div>
        
        <?php
            endforeach;
            
            
        else:
          
          echo '<div class="alert alert-warning">No existen publicaciones aun!!</div>';
          
        endif;
        ?>
            
          
    </div>
    
    <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
      
      
      <div class="sidebar-module sidebar-module-inset">
            <h4>Acerca de eCMS</h4>
            <p>eCMS, se desarrolla bajo yii2 framework, en una version de Desarrollo (BETA) por ahora.</p>
      </div>
      
      <div class="sidebar-module">
            <h4>Categor&iacute;as</h4>
            <ol class="list-unstyled">
              <?php
              if( sizeof($categories) > 0 ){
                foreach( $categories as $cat ){
                  echo '<li><a href="#">'.$cat['c_name'].' ('.$cat['nposts'].')</a></li>';
                }
              }else{
                echo '';
              }
              ?>
              
              
            </ol>
          </div>
      
    </div>
    
</div>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Perfil de usuario</h4>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
  
  function getUserInfo( userid ){
    $.ajax({
         url: '<?php echo Yii::$app->request->baseUrl. 'index.php?r=posts/ajaxuinfo' ?>',
         type: 'post',
         data: {
                   uid: userid , 
                   _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
               },
         success: function (data) {
            dt = data.userdata;
            $('#userModal').find('.modal-body').html(dt);
            $('#userModal').modal('show');
            
            
         }
    });
  }
</script>