$(function () {

    $('#postImageInput').on('change', function (e) {
        const [file] = $(this).prop('files');

        if (file) {
            $("#postImagePreview img").prop('src', URL.createObjectURL(file));

        }
    });

    $('#postTrumbowyg').trumbowyg();

});