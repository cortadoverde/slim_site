$(function(){
  console.log(base_url);
  var url = '/admin/upload';

  $('#fileupload').fileupload({
        url: '/admin/upload',
        dataType: 'json',
        done: function (e, data) {
            console.log(data);
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            console.log(data);
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    })
})
