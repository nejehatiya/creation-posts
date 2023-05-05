jQuery(document).ready(function($){
    /**
     * init vars
     */
    let ajax_creation_send = null;
    /**
     * submit creation post 
     */
    $(document).on('click','.form-creation-post button',function(e){
        // prevent default submit form
        e.preventDefault();
        // init vars and get values and filter content script and styles
        let titre = $('.form-creation-post input#titre').val();
        let text =  $('.form-creation-post textarea#text').val();
        // check if titre length
        if(titre.length){
            // function to send data via ajax
            createPost(titre,text);
        }
    });
    // function creation post
    function createPost(titre,text){
        // vider message content
        $('.form-creation-post .response').html('').removeClass('message-success').removeClass('message-error');
        // anuuler submit creation post
        if(ajax_creation_send!=null){
            ajax_creation_send.abort();
        }
        // start loading
        $(".form-creation-post button").addClass('show');
        // init ajax creation send
        ajax_creation_send = $.ajax({
            url:ajax_vars.url,
            type:'Post',
            data:{
                titre : titre,
                text : text,
                action:'creation_post',
            },
            error:function(error){
                console.log(error);
                //show error message
                $('.form-creation-post .response').html(error.message).removeClass('message-success').addClass('message-error');
                // end loading
                $(".form-creation-post button").removeClass('show');
            },
            success:function(response){
                // parse response
                response = JSON.parse(response);
                // traiter le reponse
                if(response.success){
                    // on success
                    $('.form-creation-post .response').html(response.message).addClass('message-success').removeClass('message-error');
                }else{
                    // on fail
                    $('.form-creation-post .response').html(response.message).removeClass('message-success').addClass('message-error');
                }
                // end loading
                $(".form-creation-post button").removeClass('show');
                console.log(response);
            }
        });
    }
});