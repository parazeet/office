$(document).ready(function () {
    function send(url,
                  success = function () {
                  },
                  type = 'post',
                  data = {},
                  error = null
    ) {
        $.ajax({
            url: url,
            method: type,
            async: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: success,
            error: function (response) {
                if (error) {
                    error.call(this, response);
                } else {
                    alertify.error('Ошибка');
                }
            },
            complete: function () {
            }
        });
    }

    $('#add').on('click', function () {
        var me = $(this);
        var sum = $('#sum').val();
        var type = $('#type').val();
        var comment = $('#comment').val();
        var url = me.data('router');

        if (!sum.length) {
            $('#sum').css("border","red solid 1px");
            return;
        }
        if (!type.length) {
            $('#type').css("border","red solid 1px");
            return;
        }

        var data = {
            sum: sum,
            type: type,
            comment: comment
        };
        send(url,function (response) {
            if (response['success']) {
                var dataTable = response.data.lastTen;
                var trHTML = '';

                $.each(dataTable, function (i, item) {
                    let type = item.type == 'costs' ? 'Расход' : 'Доход';
                    trHTML += '<tr><td>' + item.sum + '</td><td>' + type + '</td><td>' + item.comment + '</td><td>' + item.created_at + '</td></tr>';
                });

                $('#table').html(trHTML);
                $('#incomeAll').html(response.data.incomes);
                $('#costsAll').html(response.data.costs);
                $('#difference').html(response.data.difference);

                $('#sum').val('');
                $('#type').val('');
                $('#comment').val('');
            } else if (response['validation']) {
                alert(
                    "Ошибки валидации: \n" +
                    response['validation'].join('\n')
                );
            } else {
                alert('Не удалось сохранить')
            }
        }, 'post', data)
    });
});
