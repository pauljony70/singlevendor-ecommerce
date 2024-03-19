var code_ajax = $("#code_ajax").val();
$('#topbarUploadForm').parsley();
$('#videoUploadForm').parsley();
$('#imageUploadForm').parsley();
$('#buttonUploadForm').parsley();

var topbarUploadModal = $('#topbarUploadModal');
var videoUploadModal = $('#videoUploadModal');
var imageUploadModal = $('#imageUploadModal');
var buttonUploadModal = $('#buttonUploadModal');
var topbarUploadForm = $('#topbarUploadForm');
var videoUploadForm = $('#videoUploadForm');
var imageUploadForm = $('#imageUploadForm');
var buttonUploadForm = $('#buttonUploadForm');

function uploadTopbar(event) {
    event.preventDefault();

    // Find the closest ancestor button element
    var button = $(event.target).closest('button');

    // Set values of hidden inputs
    var id = button.data('id');
    var type = button.data('type');
    var link = button.data('link');
    var linkText = button.data('link-text');

    // Set values in the modal
    topbarUploadForm.find('#uploadId').val(id);
    topbarUploadForm.find('#uploadLink').val(link);
    topbarUploadForm.find('#bannerType').val(type);
    topbarUploadForm.find('#image').val(linkText);

    // Open the modal
    topbarUploadModal.modal('show');
}

function uploadTopVideo(event) {
    event.preventDefault();

    var button = $(event.target).closest('button');

    // Set values of hidden inputs
    var id = button.data('id');
    var type = button.data('type');
    var link = button.data('link');

    // Set values in the modal
    videoUploadForm.find('#uploadId').val(id);
    videoUploadForm.find('#bannerType').val(type);
    videoUploadForm.find('#uploadLink').val(link);

    // Open the modal
    videoUploadModal.modal('show');
}

function uploadBanner(event) {
    event.preventDefault();

    var button = $(event.target).closest('button');

    // Set values of hidden inputs
    var id = button.data('id');
    var type = button.data('type');
    var link = button.data('link');

    // Set values in the modal
    imageUploadForm.find('#uploadId').val(id);
    imageUploadForm.find('#bannerType').val(type);
    imageUploadForm.find('#uploadLink').val(link);

    // Open the modal
    imageUploadModal.modal('show');
}

function uploadButton(event) {
    event.preventDefault();

    // Find the closest ancestor button element
    var button = $(event.target).closest('button');

    // Set values of hidden inputs
    var id = button.data('id');
    var type = button.data('type');
    var link = button.data('link');
    var linkText = button.data('link-text');

    // Set values in the modal
    buttonUploadForm.find('#uploadId').val(id);
    buttonUploadForm.find('#uploadLink').val(link);
    buttonUploadForm.find('#bannerType').val(type);
    buttonUploadForm.find('#image').val(linkText);

    // Open the modal
    buttonUploadModal.modal('show');
}

topbarUploadForm.submit(function (e) {
    e.preventDefault();
    $.busyLoadFull("show");
    // Append the CSRF token to form data
    var formData = new FormData(topbarUploadForm[0]);
    formData.append('form_type', 'buttonUpload');
    formData.append('code', code_ajax);

    $.ajax({
        type: topbarUploadForm.attr('method'),
        url: topbarUploadForm.attr('action'),
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $.busyLoadFull("hide");
            // Handle the response here (update UI, show messages, etc.)
            console.log(response);
            successmsg(response.message);
            var type = topbarUploadForm.find('#bannerType').val();
            $('#' + type).text(response.data.linkText);
            $('#' + type).attr('href', response.data.link);
            $('button[data-type="' + type + '"]').data('link', response.data.link);
            $('button[data-type="' + type + '"]').data('link-text', response.data.linkText);
            // Close the modal if needed
            topbarUploadModal.modal('hide');
            // Reset the form
            $('#topbarUploadForm').parsley().reset();
            topbarUploadForm[0].reset();
        },
        error: function (error) {
            $.busyLoadFull("hide");
            console.error(error);
        }
    });
});

videoUploadForm.submit(function (e) {
    e.preventDefault();
    $.busyLoadFull("show");
    // Append the CSRF token to form data
    var formData = new FormData(videoUploadForm[0]);
    formData.append('form_type', 'imageUpload');
    formData.append('code', code_ajax);

    $.ajax({
        type: videoUploadForm.attr('method'),
        url: videoUploadForm.attr('action'),
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $.busyLoadFull("hide");
            // Handle the response here (update UI, show messages, etc.)
            console.log(response);
            successmsg(response.message);

            // Add a cache-busting parameter to the video URL
            // var cacheBuster = new Date().getTime();
            // var videoUrl = $('#base_url').val() + 'media/' + response.filePath + '?cache=' + cacheBuster;

            // $('#' + videoUploadModal.find('#bannerType').val()).find('video').attr('src', videoUrl);

            var type = videoUploadModal.find('#bannerType').val();
            $('#' + type).find('video').attr('src', $('#base_url').val() + 'media/' + response.data.filePath);
            $('button[data-type="' + type + '"]').data('link', response.data.link);

            // Close the modal if needed
            videoUploadModal.modal('hide');
            // Reset the form
            $('#videoUploadForm').parsley().reset();
            videoUploadForm[0].reset();
        },
        error: function (error) {
            $.busyLoadFull("hide");
            console.error(error);
        }
    });
});

imageUploadForm.submit(function (e) {
    e.preventDefault();
    $.busyLoadFull("show");
    // Append the CSRF token to form data
    var formData = new FormData(imageUploadForm[0]);
    formData.append('form_type', 'imageUpload');
    formData.append('code', code_ajax);

    $.ajax({
        type: imageUploadForm.attr('method'),
        url: imageUploadForm.attr('action'),
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $.busyLoadFull("hide");
            // Handle the response here (update UI, show messages, etc.)
            console.log(response);
            successmsg(response.message);
            var type = imageUploadForm.find('#bannerType').val();
            $('#' + type).find('img').attr('src', $('#base_url').val() + 'media/' + response.data.filePath);
            $('button[data-type="' + type + '"]').data('link', response.data.link);
            // Close the modal if needed
            imageUploadModal.modal('hide');
            // Reset the form
            $('#imageUploadForm').parsley().reset();
            imageUploadForm[0].reset();
        },
        error: function (error) {
            $.busyLoadFull("hide");
            console.error(error);
        }
    });
});

buttonUploadForm.submit(function (e) {
    e.preventDefault();
    $.busyLoadFull("show");
    // Append the CSRF token to form data
    var formData = new FormData(buttonUploadForm[0]);
    formData.append('form_type', 'buttonUpload');
    formData.append('code', code_ajax);

    $.ajax({
        type: buttonUploadForm.attr('method'),
        url: buttonUploadForm.attr('action'),
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $.busyLoadFull("hide");
            // Handle the response here (update UI, show messages, etc.)
            console.log(response);
            successmsg(response.message);
            var type = buttonUploadForm.find('#bannerType').val();
            $('#' + type).find('div').text(response.data.linkText);
            $('#' + type).attr('href', response.data.link);
            $('button[data-type="' + type + '"]').data('link', response.data.link);
            $('button[data-type="' + type + '"]').data('link-text', response.data.linkText);
            // Close the modal if needed
            buttonUploadModal.modal('hide');
            // Reset the form
            $('#buttonUploadForm').parsley().reset();
            buttonUploadForm[0].reset();
        },
        error: function (error) {
            $.busyLoadFull("hide");
            console.error(error);
        }
    });
});

