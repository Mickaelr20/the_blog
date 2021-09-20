$(function () {
    $.ajax({
        url: '/test',
        type: 'POST',
        async: true,
        cache: false,
        dataType: 'json',
        success: function (d) {
            console.log(d);

        },
        error: function (error) {// error
            console.log(error);
        }
    });

});