$(document).ready(function () {
    $('#drop').droppable({
        over: function (event, ui) {
            $(this).addClass('grayscale')
        },
        out: function (event, ui) {
            $(this).removeClass('grayscale')
        },
        drop: function (event, ui) {
            // ドロップイベントが発生した時の処理を記述する
            $(this).removeClass('grayscale')

            ui.draggable.find('input').each(function (index, element) {
                // ここで子要素のインプットに対する処理を行う
                var registerId = $(element).val() // 例: インプットの値をコンソールに出力

                $.ajax({
                    url: '/delete',
                    type: 'POST',
                    data: {
                        register_id: registerId,
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        console.log(
                            'Before send: Ajax request is about to be sent.',
                        )
                    },
                    success: function (data) {
                        console.log('Success: Ajax request succeeded.')
                        if (data.success) {
                            ui.draggable.remove()

                            $('#drop').addClass(
                                'animate-shake animate-thrice animate-ease-linear animate-normal animate-fill-both',
                            )
                            setTimeout(function () {
                                // この中に3秒後に実行したいコードを書きます
                                $('#drop').removeClass(
                                    'animate-shake animate-thrice animate-ease-linear animate-normal animate-fill-both',
                                )
                            }, 1000) // 3000ミリ秒 = 3秒
                            $(
                                "input[name='label_register'][value='" +
                                    registerId +
                                    "']",
                            )
                                .parent()
                                .remove()
                        } else {
                            sendAlert(data.errors)
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(
                            'Error: Ajax request failed.',
                            textStatus,
                            errorThrown,
                        )
                    },
                    complete: function () {
                        console.log(
                            'Complete: Ajax request completed (after success or error).',
                        )
                    },
                })
            })
        },
    })
    
})
