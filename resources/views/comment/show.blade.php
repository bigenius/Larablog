@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready( function() {

        $.ajax({
            url : '{{route("comments",$post->id)}}',
            type: 'GET',
            dataType : "json",
            headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function(data){
            data = data || [];
            if (data.length > 0) {

                jQuery.each(data, function(i,item) {
                    obj = '<li class="comment">' +
                            '<img alt="" src="https://www.gravatar.com/avatar/' + item.author_email_hash + 'data?s=32&d=identicon" class="avatar">' +
                            '<cite>' + item.author_name + '</cite> Says:' +
                            '<small class="commentmeta">' + item.updated_at + '</small>' +
                            '<p class="comment-body">' + item.body + '</p>' +
                            '</li>';

                    setTimeout( function(){
                        $("#commentlist").append(obj).show('slow');
                    },1000);

                });

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
    });
</script>
@endpush
<div class="comments-container">
    <h3>Comments</h3>
    <div id="comments">
        <div class="spinner">

        </div>
        <ul id="commentlist">
    </div>


    </ul>
    <h4>Leave a reply</h4>
    <form>
        <div class="form-group">
            <label >Name (required)</label>
            <input type="text" class="form-control" id="commentName" placeholder="Name">
        </div>
        <div class="form-group">
            <label >Email address (required, won't be published)</label>
            <input type="email" class="form-control" id="commentEmail" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Comment</label>
            <textarea class="form-control" id="commentBody" ></textarea>
        </div>

        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>
