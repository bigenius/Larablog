@push('scripts')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready( function() {
        fetchComments();

        $("#submit-comment").on('click', function(){
            $.ajax({
                type: 'post',
                url: "{{route('postcomment',$post->id)}}",
                data: $( "#comment-form" ).serialize(),
                dataType: 'json',
                success: function(data){
                    console.log("success");
                    fetchComments();
                    toggleThankyou();
                },
                error: function(data){
                    var errors = data.responseJSON;
                        grecaptcha.reset()
                        $("#submit-comment").addClass('disabled');
                        $('.help-block').html('');
                    $.each( errors, function( key, value) {

                        if(key === 'g-recaptcha-response') {
                            $("recaptcha-help-block").html(value.toString());
                        } else {
                            $(':input[name="'+ key +'"]').parent().addClass('has-error').append('<span class="help-block">'+value.toString()+'</span>');
                        }

                    });
                }
            });

        });
    });

    var verifyCallback = function(response) {
        $("#submit-comment").removeClass('disabled');
    }
    var fetchComments = function() {
        $(".spinner").show();
        $("#commentlist").empty();
        $.ajax({
            url : '{{route("comments",$post->id)}}',
            type: 'GET',
            dataType : "json",
        })
            .done(function(data){
                data = data || [];
                if (data.length > 0) {
                    var i = 0;

                    var loopComments = setInterval(function() {
                        var item = data[i++];
                        obj = '<li class="comment media">' +
                                '<div class="media-left media-top">' +
                                    '<img alt="" src="https://www.gravatar.com/avatar/' + item.author_email_hash + 'data?s=32&d=identicon" class="media-object avatar">' +
                                '</div>' +
                                '<div class="media-body">' +
                                    '<cite class="media-heading">' + item.author_name + '</cite> Says:' +
                                    '<small class="commentmeta">' + item.updated_at + '</small>' +
                                    '<p class="comment-body">' + item.body + '</p>' +
                                '</div>' +
                            '</li>';

                        $(obj).appendTo("#commentlist").show('slow');
                        if(i >= data.length) clearInterval(loopComments);
                    }, 100);




                } else {
                    $("#commentlist").append("<li class='no-comments'>No comments</li>").fadeIn();
                }
            })
            .fail( function(data, status){
                if (status !== 'abort') {
                    console.log('Error:', data);
                }

            })
            .always( function(){
                $(".spinner").fadeOut();
            });
    }

    var toggleThankyou = function() {
        $("#comment-form").fadeOut(500,function(){ $("#form-thankyou").hide().removeClass('hidden').fadeIn(); });
    }
</script>
@endpush
<div class="comments-container">
    <h3>Comments</h3>
    <div id="comments">
        <div class="spinner">

        </div>
        <ul id="commentlist" >

        </ul>
    </div>
    <h4>Leave a reply</h4>
    <form id="comment-form">
        <div class="form-group">
            <label >Name (required)</label>
            <input name="author_name" type="text" class="form-control" id="commentName" placeholder="Name">
        </div>
        <div class="form-group">
            <label >Email address (required, won't be published)</label>
            <input name="author_email" type="email" class="form-control" id="commentEmail" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Comment</label>
            <textarea name="body" class="form-control" id="commentBody" ></textarea>
        </div>
        {!! Recaptcha::render([ 'lang' => config('app.locale'), 'callback' => 'verifyCallback' ]) !!}
        <div id="recaptcha-help-block" class="help-block"></div>
        <a class="btn btn-default disabled"  id="submit-comment">Submit</a>

    </form>
    <div class="hidden" id="form-thankyou">Din kommentar kommer att granskas av en administratör innan den visas.</div>
</div>
