$("#testCheck").on('click', function(){

    var checkData = {
        'url'       : $('input[name=url]').val(),
        'selector'  : $('input[name=selector]').val(),
        '_token'    : $('input[name=_token]').val(),
    };
    $("#ajaxerror").remove();
    $("#selector").removeClass("has-error has-success has-feedback");
    $("#status-icon").removeClass("fa-check fa-close");
    // process the form
    $.ajax({
            type        : 'POST',
            url         : '/home/test',
            data        : checkData,
            dataType    : 'json',
            encode          : true
        })
        .done(function(data) {

           if(data > 0) {
               $("#selector").addClass("has-success has-feedback");
               $("#status-icon").addClass("fa-check");
           } else {
               $("#selector").addClass("has-error has-feedback");
               $("#status-icon").addClass("fa-close");
           }

        })
        .fail(function(data){
            showError(data.statusText);
        });


});

var showError = function(msg) {

    var errorMsg = '<div id="ajaxerror" class="row"><div class="col-md-10 col-md-offset-1"><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + msg + '</div></div></div>';
    $("body > .container").append(errorMsg);
}