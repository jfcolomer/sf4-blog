$("#comment-form").submit(function(e) {
    e.preventDefault();
    const comment = $('.textarea').val();
    const DATA = comment;
    const url = $("#comment-form").attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: DATA,
        dataType:"JSON",
        cache: false,
        success: function(data) {
            console.log(data);
        }
    });

});
