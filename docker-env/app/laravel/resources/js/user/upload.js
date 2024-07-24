
$(function() {
    $('#dropzone-file').on('change', function() {
        let file_input = $('#dropzone-file');
        let file = file_input[0].files[0];

        // EXIF.getDataでexif情報を解析
        EXIF.getData(file, function() {
            let result = '';
            let speed = '';
            let make = '';
            let model = '';

            // EXIF.getTag(this, "[exifのタグ名]")で、値を取得
            make += EXIF.getTag(this, "Make");
            model += EXIF.getTag(this, "Model");
            result += 'ISO感度:' + EXIF.getTag(this, "ISOSpeedRatings");
            result += "\n";
            result += '撮影モード:' + EXIF.getTag(this, "ExposureProgram");
            result += "\n";
            speed += Math.floor(Number(EXIF.getTag(this, "ShutterSpeedValue")));
            if(speed == 0){
                speed = '1秒';
            }else if(speed == 1)
                {
                speed = '1/2秒';
            }
            else if(speed == 2){
                speed = '1/4秒';
            }
            else if(speed == 3){
                speed = '1/8秒';
            }
            else if(speed == 4){
                speed = '1/15秒';
            }
            else if(speed == 5){
                speed = '1/30秒';
            }
            else if(speed == 6){
                speed = '1/60秒';
            }
            else if(speed == 7){
                speed = '1/125秒';
            }
            else if(speed == 8){
                speed = '1/250秒';
            }
            else if(speed == 9){
                speed = '1/500秒';
            }
            else if(speed == 10){
                speed = '1/1000秒';
            }
            else if(speed == 11){
                speed = '1/2000秒';
            }
            else if(speed == 12){
                speed = '1/4000秒';
            }
            else if(speed == 13){
                speed = '1/8000秒';
            }else{
                speed = '';
            }
            result += 'シャッタースピード:' + speed;
            $('#setting').text(result);
            $('#manufacture_text').text(make);
            $('#kind_text').text(model);
            $('#manufacture_select,#kind_select,#type_area').hide();
            $('#manufacture_select,#kind_select').removeAttr('name');
            $('#manufacture_input').attr('name','manufacture_id');
            $('#kind_input').attr('name','kind_id');
            $('#manufacture_show,#kind_show').css('display','flex');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/searchContent',
                    type: 'GET',
                    data: {
                        'kind_name' : model,
                        'manufacture_name' : make,
                    },
                datatype: 'json',
            })
            .done(function(data) {
                // 子カテゴリのoptionを一旦削除
                // $('#kind_select option').remove();
                // DBから受け取ったデータを子カテゴリのoptionにセット
                console.log(data);
                let id = Object.keys(data);
                $('#manufacture_input').attr('value',id[0]);
                $('#kind_input').attr('value',id[1]);
            })
            .fail(function() {
                $('#manufacture_show,#kind_show').hide();
                $('#manufacture_select,#kind_select,#type_area').show();
                $('#manufacture_input,#kind_input').removeAttr('name');
                $('#manufacture_select').attr('name','manufacture_id');
                $('#kind_select').attr('name','kind_id');
                $('#setting').val('');
                $('.error').remove();
                console.log('失敗');
            });
        });
    });
});

$('#dropzone-file').on('change',function() {
    if ( !this.files.length ) {
        return;
    }
    let file = $(this).prop('files')[0];
    let fr = new FileReader();
    fr.onload = function() {
        $('#preview').attr('src', fr.result ).css('display','inline');
    }
    fr.readAsDataURL(file);
    $('#dropzone').hide();
    $('#show-image').css('display','flex');
    $('#delete-area').css('display','flex');
});

$('#delete-btn').on('click',function() {
    $('#preview').attr('src','');
    $('#dropzone').show();
    $('#delete-area').css('display','none');
    $('#dropzone-file').val('');
    $('#manufacture_text,#kind_text').text('');
    $('#manufacture_select,#kind_select,#type_area').val('');
    $('#manufacture_select,#kind_select,#type_area').show();
    $('#manufacture_show,#kind_show').hide();
    $('.error').remove();
    });

$('#change_btn').on('click',function() {
    $('#manufacture_show,#kind_show').hide();
    $('#manufacture_select,#kind_select,#type_area').show();
    $('#manufacture_input,#kind_input').removeAttr('name');
    $('#manufacture_select').attr('name','manufacture_id');
    $('#kind_select').attr('name','kind_id');
    $('.error').remove();
});


$('#manufacture_select').on('change',function () {
    $('#type_select').val('');
    $('#search_type_select').val('');
    $('#kind_select option').remove();
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


$('#uploadForm').validate({
    rules: {
        // file: { required: true },
        name: { required: true },
        manufacture_id : { required: true },
        type : {required: true },
        kind_id : { required: true },
        category : { required: true },
        setting : { required: true },
    },
    messages: {
        // file: { required: '作品名を入力してください' },
        name: { required: '作品名を入力してください' },
        manufacture_id : { required: 'メーカー名を選択してください' },
        type : { required: '種類を選択してください' },
        kind_id : { required: '機種名を選択してください' },
        category : { required: 'カテゴリーを選択してください' },
        setting : { required: '設定を入力してください' },
        },
        errorPlacement: function(error, element){
            element.before(error);
        }
});


