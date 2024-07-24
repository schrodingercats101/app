$(function () {
    $('#like_btn').on('click', function () {
      let photo_id = $('#like_toggle').data('photo-id');

      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/like',
        type: 'POST',
        data: {
          'photo_id': photo_id
        },
        datatype: 'json',
      })

      .done(function (data) {
        console.log(data);
        $('#like_toggle').toggleClass('liked');
      })
      .fail(function () {
        console.log('fail');
      });
    });
});
