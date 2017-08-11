<?php 
//require_once 'includes/init.php';
    $photos = Photo::find_all();
?>
<!--<pre>
</pre>-->

<div class="modal fade" id="photo-modal-post" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"> 
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Choose an image</h4>
        </div>
        <div class="modal-body">
            <div class="col-md-9">
                <div class="thumbnails row">
                    <!--php loop -->
                    <?php foreach($photos as $photo): ?>


                    
                    <div class="col-xs-2">
                        <a role="checkbox" aria-checked="false" tabindex="0" id="" href="#" class="thumbnail">
                            <img class="modal_thumbnails_post img-responsive" src="<?php echo $photo->picture_path(); ?>" data="<?php echo $photo->id; ?>" >
                        </a>
                        <div class="post-id hidden"></div>
                    </div>
                    
                    <?php endforeach; ?>
                    <!-- !End php loop -->
                </div>
            </div> <!-- !end col-md-9 -->



            <div class="col-md-3">
                <div id="modal_slidebar"></div>
            </div>



        </div> <!-- !end modal body -->
            <div class="modal-footer">
                <div class="row">
                    <button id="set_item_image" type="button" class="btn btn-primary" data-dismiss="modal" disabled="true">Apply Selections</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->