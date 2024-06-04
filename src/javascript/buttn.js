$(document).ready(function () {
    // リスト項目がクリックされたときの処理を定義
    function animateListItemOnClick() {
        $('#buttn').on('click', 'li', function () {
            var hiddenValue = $(this).find("input[type='hidden']").val()
            // クリックされたリスト項目の親要素にクラスを追加
            console.log(hiddenValue)
            $("input[name='register_id'][value='" + hiddenValue + "']")
                .parent()
                .addClass(
                    'animate-ping animate-thrice animate-ease-linear animate-normal animate-fill-both',
                )

            // 3秒後にクラスを削除するタイマーを設定
            setTimeout(function () {
                $("input[name='register_id'][value='" + hiddenValue + "']")
                    .parent()
                    .removeClass(
                        'animate-ping animate-thrice animate-ease-linear animate-normal animate-fill-both',
                    )
            }, 3000) // 3000ミリ秒 = 3秒
        })
    }

    // 関数を呼び出し
    animateListItemOnClick()

    $('#buttn').on('DOMNodeInserted', 'li', function () {
        console.log('ファイナルフラッシュ')
        animateListItemOnClick()
    })
})
