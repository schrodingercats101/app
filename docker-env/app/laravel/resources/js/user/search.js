    //検索画面用

    $(window).on('load', function (){
        if($('#search_type_select').val() !== ''){
                let manufacture_id = $('#manufacture_select').val();
                let type = $('#search_type_select').val();
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
                    $.each(data, function(key, value) {
                    if(key == old){
                        $('#kind_select').append($('<option>').text(value).attr('value', key).prop('selected',true));
                    }else{
                      $('#kind_select').append($('<option>').text(value).attr('value', key));
                    }
                    });
                })
                .fail(function() {
                    console.log('失敗');
                });
        }
        });
    console.log($('#kind_select').val());

    $('#search_type_select').on('change',function () {
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
            console.log(data);
            $.each(data, function(key, value) {
                $('#kind_select').append($('<option>').text(value).attr('value', key));
                if($('kind_select option').val == "<?php echo $old['kind_id']; ?>"){
                    $(this).prop('selected',true);
                }
            });
        })
        .fail(function() {
            console.log('失敗');
        });

    });
