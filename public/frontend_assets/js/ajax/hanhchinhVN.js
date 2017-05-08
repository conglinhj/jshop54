/**
 * Created by nclin on 5/7/2017.
 */
$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var select_county = $('#billing_county');
    var select_township = $('#billing_township');

    $('#billing_city').on('change', function () {
        select_county.find('option').not(':first').remove();
        select_township.find('option').not(':first').remove();
        var first_option = select_county.find('option:first-child');
        var first_option_text = first_option.text();

        $.ajax({
            type : 'GET',
            url : $(this).data('url'),
            dataType : 'JSON',
            data : {
                city_id : $(this).val()
            },
            beforeSend : function () {
                first_option.text("Đang tải...");
            },
            complete : function () {
                first_option.text(first_option_text);
            },
            success : function (counties) {
                $.each(counties, function (key, list) {
                    $.each(list, function (id, county) {
                        select_county.append("<option value='"+ county.id +"'>"+ county.name +"</option>");
                    })
                });
            },
            error : function (message) {
                var mes = $.parseJSON(message.responseText);
                console.log(mes);
            }
        })
    });

    select_county.on('change', function () {
        select_township.find('option').not(':first').remove();
        var first_option = select_township.find('option:first-child');
        var first_option_text = first_option.text();

        $.ajax({
            type : 'GET',
            url : $(this).data('url'),
            dataType : 'JSON',
            data : {
                county_id : $(this).val()
            },
            beforeSend : function () {
                first_option.text("Đang tải...");
            },
            complete : function () {
                first_option.text(first_option_text);
            },
            success : function (townships) {
                $.each(townships, function (key, list) {
                    $.each(list, function (id, township) {
                        select_township.append("<option value='"+ township.id +"'>"+ township.name +"</option>");
                    })
                });
            },
            error : function (message) {
                var mes = $.parseJSON(message.responseText);
                console.log(mes);
            }
        })
    })

})