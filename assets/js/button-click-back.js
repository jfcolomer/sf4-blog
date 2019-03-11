$('#login-form').on('submit', function () {
    var translation = $('button:submit.button').data('trans');
    $('button:submit.button').prop("disabled", true).html(translation);
});

$('#comment-form').on('submit', function () {
    $('button:submit.button').prop("disabled", true);
});
