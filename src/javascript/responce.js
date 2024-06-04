$(document).ready(function () {
    // 特定の要素が存在するかどうかをチェック
    if ($('#registersItem').length > 0) {
        width() // 特定の要素が存在する場合は関数を実行
    }

    width()
    // $(window).on('beforeunload', function (event) {
    //     // ウィンドウの幅と高さを取得
    //     // event.preventDefault() // デフォルトのリンク動作を防止

    //     var windowWidth = $(window).width()
    //     var windowHeight = $('body').height()

    //     // フォームの値を設定
    //     // $('#windowWidthInput').val(windowWidth)
    //     // $('#windowHeightInput').val(windowHeight)

    //     // フォームデータを取得
    //     var formData = {
    //         window_width: windowWidth,
    //         window_height: windowHeight,
    //     }

    //     // sendBeaconを使ってデータを送信
    //     navigator.sendBeacon('/login', JSON.stringify(formData))
    //     console.log(123455666)
    // })

})

// width関数
function width() {
    // var widthValue = $(window).width() // ウィンドウの幅を取得
    // var currentWindowHeight = $('body').height()
    // console.log(widthValue)
    // $('#width').val(widthValue) // 隠しフィールドのvalue属性に設定
    // $('#height').val(currentWindowHeight) // 隠しフィールドのvalue属性に設定
}
$('#loginLink').click(function (event) {
    event.preventDefault() // デフォルトのリンク動作を防止
    $('.windowWidthInput').val($(window).width())
    $('.windowHeightInput').val($('body').height())
    $('#loginForm').submit() // フォームを送信
})
