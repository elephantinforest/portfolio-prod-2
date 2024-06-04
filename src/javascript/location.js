$(document).ready(function () {
    // ボタンがクリックされた時の処理
    // 入力フォームの値を取得
    var inputValue = $('.header_locationname').text()
    console.log(666)
    console.log(inputValue.indexOf('ロケーションは登録されていません'))
    // 条件に応じて処理を行う
    if (inputValue.includes('ロケーションは登録されていません')) {
        // 条件がtrueの場合の処理
        $('.register').hide()
    }
    $('#locationSpot').change(function () {
        console.log('おれだおれだおれだ')
    })

    $('#locationSpot').on('input', function () {
        console.log($(this).val())
    })
})
