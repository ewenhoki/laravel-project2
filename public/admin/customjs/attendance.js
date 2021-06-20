$('.deletelecturer').click(function(){
    var attendance_id = $(this).attr('attendance-id');
    var title = $(this).attr('title');
    swal({   
        title: "Yakin ?",   
        text: "Hapus bimbingan dengan judul "+title+"?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Ya",   
        cancelButtonText: "Tidak",   
        closeOnConfirm: false,   
        closeOnCancel: false 
    })
    .then(function(WillDelete){
        if(WillDelete.value){
            window.location = "/student/delete_attendance/"+attendance_id;
        }
    });
});
$(document).on("click", ".modal-edit1", function () {
    var id = $(this).attr('lecturer-id');
    var name = $(this).attr('lecturer-name');
    $(".modal-content #lecturer_id").val( id );
    $(".modal-content #lecturer_name").val( name ); 
});
$(document).on("click", ".modal-edit2", function () {
    var id_attend = $(this).attr('attendance-id');
    var name = $(this).attr('lecturer-name');
    var title = $(this).attr('title');
    var description = $(this).attr('description');
    var time = $(this).attr('time');
    $(".modal-content #attendance_id").val( id_attend );
    $(".modal-content #lecturer_name_edit").val( name ); 
    $(".modal-content #title_edit").val( title );
    $(".modal-content #description_edit").val( description );
    $(".modal-content #time_edit").val( time );
});
$(document).ready(function(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today =  yyyy + '-' + mm + '-' + dd;
    jQuery.datetimepicker.setLocale('id')
    $('#time').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i',
        hours12: false,
        defaultDate: today,
        step: 15,
        lang: 'id',
    });
    $('#time_edit').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i',
        hours12: false,
        step: 15,
        lang: 'id',
    });
});
$(function() {
    $(".formValidate1").validate({
        rules: {
            title: {
                required: true,
                minlength: 5,
            },
            description: {
                required: true,
            },
            date_time: {
                required: true,
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        invalidHandler: function(e, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                $('.error-alert-bar').show();
            }
        },
    });
});
$(function() {
    $(".formValidate2").validate({
        rules: {
            title: {
                required: true,
                minlength: 5,
            },
            description: {
                required: true,
            },
            date_time: {
                required: true,
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        invalidHandler: function(e, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                $('.error-alert-bar').show();
            }
        },
    });
});