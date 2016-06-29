<script>
var currentSlugRequest = null;
$("#post-title").on('keyup', function() {
    if (this.value.length > 0) {
        currentSlugRequest = $.ajax({
                url : '{{route("pageslug")}}',
                type: 'POST',
                dataType : "json",
                data: {title: this.value},
                headers: {"X-CSRF-TOKEN":"{!! csrf_token() !!}"},
                beforeSend : function()    {
            if(currentSlugRequest != null) {
                currentSlugRequest.abort();
            }
        }
            })
                    .done(function(data){
            console.log(data);
            $('#slug').html(data);
        })
        .fail( function(data, status){
            if (status !== 'abort') {
                console.log('Error:', data);
            }

        });
        } else {
        $('#slug').html('');
    }

});
</script>