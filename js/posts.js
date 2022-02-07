$(function () {

    $('#postImageInput').on('change', function () {
        const [file] = $(this).prop('files');

        if (file) {
            $("#postImagePreview img").prop('src', URL.createObjectURL(file));

        }
    });

    $('#postTrumbowyg').trumbowyg();

});