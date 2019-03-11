$('#comment-form').on('click', function(e) {
    e.preventDefault();
    var form_data = $(this).serialize();
    $.ajax({
        url: 'http://localhost:8000/article/sed-omnis',
        type: 'POST',
        cache: false,
        data: $(this).serialize(),
        dataType:"JSON",
        success: function (data) {
            if(data.error != '') {
                $('#comment-form')[0].reset();
                $('#App_comment_content').html(data.error);
            }
        }
    });
});
