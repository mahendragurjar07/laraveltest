    /* image cropper functions*/
    function setImage(input) {        
        var fileTypes = ['jpg', 'jpeg', 'png'];  //acceptable file types
        $('#crop_image').attr('src', '');
        if (input.files && input.files[0]) {

            var extension = input.files[0].name.split('.').pop().toLowerCase(), //file extension from input file
                    isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types
            if (isSuccess) { //yes
                if (input.files[0].size >= 5120000) {
                    errorToaster('Image may not be greater then 5MB.');                    
                } else {
                    var reader = new FileReader();
                    reader.onload = function (e) {                        
                        //Initiate the JavaScript Image object.
                        var image = new Image();
                        //Set the Base64 string return from FileReader as source.
                        image.src = e.target.result;
                        var image = new Image();
                        //Set the Base64 string return from FileReader as source.
                        image.src = e.target.result;
                        //Validate the File Height and Width.
                        image.onload = function () {
                          var imageHeight = this.height;
                          var imageWidth = this.width;
                          // check the height and widht of image
                         
                            $("#imageCropperModal").modal("show");
                            $('#crop_image').attr('src', e.target.result);
                            $('#imageBaseCode').val(e.target.result);
                            setTimeout(function () {
                                loadCropper();
                            }, 150);                              
                        };                                                
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            } else {
                errorToaster('Please select jpg, jpeg, png image only.');  
            }

        }
    }
    $('#imageCropperModal').on('hidden.bs.modal', function (e) {
        var $image = $("#crop_image");
        var input = $("#cropImageInput");
        input.replaceWith(input.val('').clone(true));
        $image.cropper("destroy");
    })

    //cropper
    function loadCropper() {
        var $image = $("#crop_image");
        $image.cropper({
            viewMode: 1,
            dragMode: 'move',
            aspectRatio: 1,
            movable: false,
            zoomable: true,
            rotatable: true,
            center: true,
            responsive: true,
            cropBoxResizable: true,
            minCropBoxWidth:200,
            minCropBoxHeight:200
        });
    }
    $("#cropButton").click(function () {         
        var $image = $("#crop_image");
        showButtonLoader('cropButton','Save','disable');         
        $('#btnCancelCropper').prop('disabled',true);
        $('#btnCloseCropper').prop('disabled',true);
        var imageBaseCode = $('#imageBaseCode').val();
        var imageType = $("#imageType").val();
        var imageCropedData = $image.cropper('getData');
        var croppedWidth = imageCropedData.width;
        var croppedHeight = imageCropedData.height;
        var croppedX = imageCropedData.x;
        var croppedY = imageCropedData.y;
        var rotate = imageCropedData.rotate;
        var url = uploadImageUrl; /* this global variable defined on the top of this imported script for {{url('save-profile-image')}}*/
        var bar = $('.bar123');
        //var percent = $('.percent');
        var status = $('.progress123');
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'JSON',
            data: {
                imageBaseCode: imageBaseCode,
                imageType: imageType,
                croppedWidth: croppedWidth,
                croppedHeight: croppedHeight,
                croppedX: croppedX,
                croppedY: croppedY,
                rotate: rotate,
                imageFor: imageFor,
                _token: csrfToken /* this global variable declaired on the top of this imported script for {{csrf_token()}}*/
            },
            beforeSend: function () {
                status.show();
                var percentVal = '0%';
                bar.width(percentVal);
                //percent.html(percentVal);
            },
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', progress, false);
                }
                return myXhr;
            },
            success: function (response) {
                status.hide();
                bar.width('0%');
                if (response.success) {
                    $("#imageCropperModal").modal("hide");
                    $image.cropper('destroy');
                    showButtonLoader('cropButton','Save','enable');      
                    $('#btnCancelCropper').prop('disabled',false);
                    $('#btnCloseCropper').prop('disabled',false);                    
                    $('#'+imagePreview).attr('src', response.data.filePath);
                    $('#'+hdnFileInput).val(response.data.fileName);
                    // successToaster('Profile image is changed successfully.');                      
                }
            }
        });
    });
    function progress(e) {
        var bar = $('.bar123');
        //var percent = $('.percent');
        var status = $('.progress123');
        if (e.lengthComputable) {
            var max = e.total;
            var current = e.loaded;
            var Percentage = (current * 100) / max;
            var percentVal = Percentage + '%';
            bar.width(percentVal);
            if (Percentage >= 100)
            {

            }
        }
    }
    $('#imageCropperModal').on('hidden.bs.modal', function (e) {
        $('#crop_image').attr('src', '');
        var $image = $("#crop_image");
        var input = $("#cropImageInput");
        input.replaceWith(input.val('').clone(true));
        $image.cropper("destroy");
    });
        
    /* image cropper functions end*/