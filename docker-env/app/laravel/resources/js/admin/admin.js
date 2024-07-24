
$('#manufacture_select').on('change',function () {
    $('#type_select').val('');
    $('#search_type_select').val('');
    $('#kind_select option').remove();
});

$(window).on('load', function (){
    if($('#type_select').val() !== ''){
        let manufacture_id = $('#manufacture_select').val();
        let type = $('#type_select').val();

        console.log(manufacture_id);
        console.log(type);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/getContent',
        type: 'GET',
        data: {
            'manufacture_id' : manufacture_id,
            'type' : type,
        },
        datatype: 'json',
    })
    .done(function(data) {
        console.log(data);
        let old = $('#kind_select').val();
        console.log(old);
        $('#kind_select option').remove();
        $.each(data, function(key, value) {
        if(key === old){
            $('#kind_select').append($('<option>').text(value).attr('value', key).prop('selected',true));
        }else{
          $('#kind_select').append($('<option>').text(value).attr('value', key));
        }
    })
    })
    .fail(function() {
        console.log('失敗');
    });
    }
});



$('#type_select').on('change',function () {
    let manufacture_id = $('#manufacture_select').val();
    let type = $(this).val();
    console.log(manufacture_id);
    console.log(type);
    $('#kind_select').prop('disabled', false );

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/getContent',
        type: 'GET',
        data: {
            'manufacture_id' : manufacture_id,
            'type' : type,
        },
        datatype: 'json',
    })
    .done(function(data) {
        $('#kind_select option').remove();
        console.log(data);
        $.each(data, function(key, value) {
            $('#kind_select').append($('<option>').text(value).attr('value', key));
        });
    })
    .fail(function() {
        console.log('失敗');
    });

});
