export function fetchRegistersName() {
    var locatioId = $('#locationSpot').val()
    $.ajax({
        url: '/pagenation',
        type: 'POST',
        data: { location_id: locatioId },
        dataType: 'json',
        beforeSend: function () {
            console.log('Before send: Ajax requeAst is about to be sent.')
            console.log('実行')
        },
        success: function (data) {
            console.log('Success: Ajax request succeeded.')
            if (data.success) {
                var registers = JSON.parse(data.registersName)
                pagenation(registers)
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
    function pagenation(registersName) {
        var registerName = registersName
        $('#registers-all-pager').pagination({
            dataSource: registerName,
            pageSize: 8,
            showPageNumbers: false,
            showNavigator: true,
            className: 'paginationjs-theme-yellow',
            callback: function (data, pagination) {
                console.log(pagination)
                // 新しいデータを追加する前に、コンテンツをクリアする
                $('#registers-all-contents').empty()

                // データをループしてHTMLに追加
                $.each(data, function (index, element) {
                    console.log(element)
                    $('#registers-all-contents').append(makeButtnList(element))
                })
            },
        })
    }

    // function template(dataArray) {
    //     // dataArray.map(function (data) {
    //     //      makeButtnList(data)
    //     // })
    //     var lists = $.map(dataArray, function (register) {
    //       return  makeButtnList(register)
    //        $.each(data.registers, function (index, element) {
    //            $('#registersItem').append(makeRegisterList(element))
    //            $('#buttn').append(makeButtnList(element))
    //        })
    //     })
    //     return lists
    // }
}
//ブラウザで読み込んだ時にページネーション処理
$(document).ready(function () {
    fetchRegistersName()
})
