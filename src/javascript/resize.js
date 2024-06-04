$(document).ready(function () {
    // ドラッグ可能な機能を適用する関数
    function applyResizable(element) {
        console.log('合')
         var currentWindowWidth = $(window).width()
         var currentWindowHeight = $('body').height()
         console.log(currentWindowHeight)
         console.log(currentWindowWidth)
       $( ".img" ).resizable({
            stop: function (event, ui) {
                // リサイズ終了時の処理
                var width = $(this).width()
                var height = $(this).height()
                var registerId = $(this)
                    .closest('.parent')
                    .find('input[name="register_id"]')
                    .val()
                var data = {
                    width: width,
                    height: height,
                    registerId: registerId,
                    windowWidth: currentWindowWidth,
                    windowHeight: currentWindowHeight,
                }
                $.ajax({
                    url: '/resize',
                    method: 'POST',
                    data: { data: data },
                    success: function (response) {
                        console.log('Success:', response)
                        responsiveDesign()
                    },
                    error: function (xhr, status, error) {
                        console.log('Error:', error)
                    },
                })
            },
        })
    }

    // ドキュメントが読み込まれた時に実行される初期化処理
    $(function () {
        // 既存の要素にドラッグ可能な機能を適用する
        applyResizable($('.img'))

        // ドキュメント内に新しい要素が挿入された時に実行されるイベントリスナー
        $(document).on('DOMNodeInserted', function (e) {
            var target = $(e.target)
            if (target.hasClass('registerde')) {
                // 新しい要素が.imgクラスを持つ場合、その要素にもドラッグ可能な機能を適用する
                console.log('合')
                applyResizable(target)
            }
        })
    })
})
