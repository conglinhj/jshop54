/**
 * Created by nclin on 4/16/2017.
 */
$(document).ready(function () {

    $('#new-specs-input').on('click', function () {
        var formSpecs = $('#specs_form');
        if(formSpecs.is(":hidden")){
            $(this).html('Cancel');
        }else {
            $(this).html('+ Thêm mới');
        }
        formSpecs.toggle(400);
    });

    /**
     * add new specs
     */
    $('#submit-button').on('click', function () {

        $('#specs-block').removeClass('has-error');
        $('#specs-message').html('');

        $.ajax({
            type : 'POST',
            url : $(this).data('url'),
            data : $('#specs_form').serialize(),
            beforeSend : function () {
                $('.loading-block').show();
            },
            complete : function () {
                $('.loading-block').hide();
            },
            success : function () {
                location.reload();
            },
            error : function (message) {
                var mes = $.parseJSON(message.responseText);
                $('#specs-block').addClass('has-error');
                $('#specs-message').html(mes.name);
            }
        });
    });

    /**
     * change status
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("input[name~='status']").on('change', function () {
        $input_status = $(this);
        if ( this.checked ){
            $status = 1;
        }else {
            $status = 0;
        }
        $.ajax({
            type : "POST",
            url : $input_status.data('url'),
            data : {
                specsId : $input_status.attr('data-specsId'),
                status : $status
            },
            beforeSend : function () {
                $('.loading-block').show();
            },
            complete : function () {
                $('.loading-block').hide();
            },
            success : function () {
                location.reload();
            },
            error : function (oj) {
                console.log('loi : ' + oj);
            }
        });
    });
    /**
     * change spotlight
     */
    $("input[name^='spotlight']").on('change', function () {
        $input_spotlight = $(this);
        if ( this.checked ){
            $spotlight = 1;
        }else {
            $spotlight = 0;
        }
        $.ajax({
            type : "POST",
            url : $input_spotlight.data('url'),
            data : {
                specsId : $input_spotlight.attr('data-specsId'),
                spotlight : $spotlight
            },
            beforeSend : function () {
                $('.loading-block').show();
            },
            complete : function () {
                $('.loading-block').hide();
            },
            success : function () {
                location.reload();
            },
            error : function () {
                console.log('loi : ' + oj);
            }
        });
    });

    /**
     * show input for update specs
     */
    $('.editspecs-button').on('click', function () {
        var specs_block = $(this).parent().parent().prev().prev().prev();
        specs_block.children().toggle();
        if (specs_block.children('.specs-name-input').is(':hidden')){
            $(this).removeClass('btn-warning').addClass('btn-success').html('<i class="fa fa-edit"></i>');
        }else {
            $(this).removeClass('btn-success').addClass('btn-warning').html('Cancel');
        }
    });
    $('.specs-submit-button').on('click', function () {
        $.ajax({
            type : 'POST',
            url : $(this).data('url'),
            data :{
                 id : $(this).attr('data-specsId'),
                 name : $(this).prev().val()
            },
            beforeSend : function () {
                $('.loading-block').show();
            },
            complete : function () {
                $('.loading-block').hide();
            },
            success : function () {
                location.reload();
            },
            error : function (message) {
                var mes = $.parseJSON(message.responseText);
                $('#specs-block').addClass('has-error');
                $('#specs-message').html(mes.name);
            }
        });
    });
    $('.deletespecs-button').on('click', function () {
        $.ajax({
            type : 'POST',
            url : $(this).data('url'),
            data :{
                 id : $(this).attr('data-specsId')
            },
            beforeSend : function () {
                $('.loading-block').show();
            },
            complete : function () {
                $('.loading-block').hide();
            },
            success : function () {
                location.reload();
            }
        });
    });

});