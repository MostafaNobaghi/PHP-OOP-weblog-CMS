$(document).ready(function(){
    
    
    
    


    
    
    // chang height og image items automatically in photos.php
    $(window).bind("load resize", function(){
        $('.div_thumbnail_container').each(function(index, element){
            var div_thumbnail_container_width =  $(element).width();
            var img_thumbnail_container_height = $(element).children('a').children('img').height();
            var calculated_margin = (div_thumbnail_container_width - img_thumbnail_container_height)/ 2;
            $(element).children('a').children('img').css('margin-top', calculated_margin);
            $(element).children('a').children('img').css('margin-bottom', calculated_margin);  
        });
    });// END chang height og image items automatically in photos.php
    
    
    
    
    
    
    
    
    
    
    



    
    /******* Modal library functions *****/
    $('.modal_thumbnails').click(function(){
        var user_href;
        var user_href_splitted;
        var user_id;
        
        var image_src;
        var image_src_splitted;
        var image_name;
        var post_id;
        $('#set_item_image').prop('disabled', false);
        
        user_href = $('#item-id').prop('href');
        user_href_splitted = user_href.split('=');
        user_id = user_href_splitted[user_href_splitted.length-1];
        
        image_src = $(this).prop('src');
        image_src_splitted = $(this).prop('src').split('/');
        image_name = image_src_splitted[image_src_splitted.length-1];
        post_id = $(this).attr('data');
        

        $.ajax({
            url  : "includes/ajax_code.php",
            data : {post_id: post_id},
            type : "POST",
            success: function (data) {
                $('#modal_slidebar').html(data);
            }
            
        });

        $('#set_item_image').click(function(){
            $.ajax({
                url  : "includes/ajax_code.php",
                data : {image_name: image_name, user_id: user_id},
                type : "POST",
                 success: function (data) {
                     if(!data.error){
                         $('#user-image').prop('src', data);
                         $('.alert-success').toggleClass('hidden');
                         $('.alert-success h3').html('User image updated succesfully');
                     }
                 }
            }) ;
        });

    }); /////// End Modal library functions *****/
    
    
    
    
    
    ////////////collapse right sidebar in post edit page
    $('.info-box-header').click(function(){
        $('.inside').slideToggle('fast');
        $('#toggle').toggleClass('glyphicon glyphicon-menu-down , glyphicon glyphicon-menu-up')
    })//////////// end collapse right sidebar in post edit page
    
    
    
    //////////// delete confirmation
    $('.btn-danger, .text-danger').click(function(){
        return confirm('Are you sure you want to delete this item?');
    });//////////// delete confirmation
    
    
    
    
    
    
    
    
    

    
//    tinymce.init({ selector:'textarea'});  

//    tinymce.init({
//      selector: 'textarea',
//      subfolder:"",
//      allow_html_in_named_anchor: true,
//      valid_elements : 'img',
//      allow_unsafe_link_target: true,
//      height: 500,
//      menubar: true,
//      plugins: [
//         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
//         "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
//         "table contextmenu directionality emoticons paste textcolor filemanager"
//   ],
//    image_advtab: true,
//      
////      imagetools_cors_hosts: ['localhost:81', 'localhost:81/gallery(weblog)/admin'], 
////      imagetools_proxy: 'proxy.php',
//      
//      toolbar: "insert_image | undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code",
//      content_css: [
//        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
//        '//www.tinymce.com/css/codepen.min.css'],
//
//        setup: function (editor) {
//            editor.addButton('insert_image', {
//              text: 'Insert Image',
//              icon: 'mce-ico mce-i-image',
//              onclick: function () {
//                $('#photo-library-post').modal(function(){
//                    alert('dsfsdf');
//                });
//                
//                
//                
//                
//                
//                                           /******* Modal post library functions *****/
//    $('.modal_thumbnails_post').click(function(){
////        var img_src;
//        var image_src_splitted;
//        var image_name;
//        
////        img_src = $(this).prop('src');
//        image_src_splitted = $(this).prop('src').split('/');
//        image_name = image_src_splitted[image_src_splitted.length-1];
//        tinyMCE.execCommand('mceInsertContent', true    , '<img alt="Smiley face" height="42" width="42" src="' + image_name + '"/>');
//    });
//                
//                
//                
//                
//                
//                
//    
//                
//                
//
//    
//    
//    
//              }
//            });
//          }


//    });


    var description;
    $('.modal_thumbnails_post').click(function(){
//        var img_src;
        var image_src_splitted;
        var image_name;
        
//        img_src = $(this).prop('src');
        image_src_splitted = $(this).prop('src').split('/');
        image_name = image_src_splitted[image_src_splitted.length-1];
        alert('sdfsdf');
        $('#txta').append("<img alt='Smiley face' height='42' width='42' src='  image_name  '/>");
//        tinyMCE.execCommand('mceInsertContent', true    , '<img alt="Smiley face" height="42" width="42" src="' + image_name + '"/>');
    });
    
    

    
    
    
});


 


//#mceu_41-inp

//$('.mce-textbox').click(function(){
//    alert('dsff');
//});
