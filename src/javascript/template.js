// export function makeRegisterList(register) {
//     return `<li id="registerde" class="registerde  ui-sortable-handle" style="position: absolute; left: ${register['left_position']}%; top: ${register['top_position']}%;">
//                         <a class="parent" href="/update?id=${register['register_id']}">
// <div class="ui-wrapper" style="overflow: hidden; position: relative; width: 60px; height: 70px; top: 0px; left: 0px; margin: 0px;">
//                             <img id="registerContainer" class="img opacity-85 rounded-lg grayscale hover:contrast-200 hover:grayscale-0  " alt="画像の説明" src="${register['file_path']}" style="width: ${register['width']}px !important; height: ${register['height']}px !important;">
//                             <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div>
//                             <div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div>
//                             <div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div>
//                     </div>
//                             <input type="hidden" name="register_id" value="${register['register_id']}">
//                         </a>
//                     </li>`
// }

export function makeRegisterList(register) {
    return `<li id="registerde" class="registerde  z-30 ui-sortable-handle" style="position: absolute; left: ${register['left_position']}%; top: ${register['top_position']}px;  width: ${register['width']}px; height:  ${register['height']}px ;">
                        <a class="parent" href="/update?id=${register['register_id']}" style="width: ${register['width']}px; height:${register['height']}px;">
                            <img id="registerContainer" class="img opacity-85 rounded-lg grayscale hover:contrast-200 hover:grayscale-0  " alt="画像の説明" src="${register['file_path']}" style="width: ${register['width']}px ; height: ${register['height']}px;">
                            <input type="hidden" name="register_id" value="${register['register_id']}">
                        </a>
                        <input type="hidden" name="window_width" value="${register['window_width']}">
                        <input type="hidden" name="window_height" value="${register['window_height']}">
                    </li>`
}

export function makeButtnList(register) {
    return `<li class="delete text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 cursor-pointer">
                            <input type="hidden" name="label_register" value="${register['register_id']}">
                            ${register['name']}
                        </li>`
}

export function sendAlert(errors) {
    if (typeof errors === 'string') {
        alert(errors)
    } else {
        let mesage = []
        $.each(errors, function (index, element) {
            mesage.push(element) // 配列に要素を追加
            mesage.push('\n') // 段落を区切るための改行を追加
        })
        alert(mesage)
    }
}
// $(document).ready(function () {
//     var initialWindowWidth = $(window).width()
//     var initialWindowHeight = $('body').height()
//     console.log('Initial Window Height:', initialWindowHeight)

//     var $element = $(
//         '.registerde.ui-sortable-handle[style*="position: absolute;"]',
//     )
//     console.log('Initial Top Value:', $element.css('top'))

//     var leftValue =
//         (parseFloat($element.css('left')) / initialWindowWidth) * 100
//     var initialTopPercentage = parseInt($element.css('top'), 10)

//     console.log('Initial Left Percentage:', leftValue)
//     console.log('Initial Top Percentage:', initialTopPercentage)

//     $(window).on('resize', function () {
//         var currentWindowWidth = $(window).width()
//         var currentWindowHeight = $('body').height()

//         var scaleX = currentWindowWidth / initialWindowWidth
//         var scaleY = currentWindowHeight / initialWindowHeight

//         console.log('Current Window Height:', currentWindowHeight)
//         console.log('Scale Y:', scaleY)

//         var newLeft = leftValue * scaleX + '%'
//         var newTop = initialTopPercentage * scaleY + 'px'

//         console.log('New Left Percentage:', newLeft)
//         console.log('New Top Pixel Value:', newTop)

//         $('.registerde').css({
//             top: newTop,
//         })

//         $('.img').css({
//             width: 90,
//             height: 100,
//         })

//         console.log('Height')
//         console.log(currentWindowHeight)
//         console.log(initialWindowHeight)
//         applyResizable($('.img'))
//     })

//     $('#registersItem').on('resize', function (event) {
//         event.stopPropagation()
//     })
// })

function applyResizable(element) {
    console.log('合')
    var currentWindowWidth = $(window).width()
    var currentWindowHeight = $('body').height()
    console.log(currentWindowHeight)
    console.log(currentWindowWidth)
    $('.img').resizable({
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

export function responsiveDesign() {
    $('ul')
        .find('li')
        .each(function () {
            var currentLi = $(this) // 現在のli要素を指す変数
            console.log(currentLi)
            var initialWindowWidth = $(window).width()
            var initialWindowHeight = $('body').height()
            var initialWidth = currentLi.width()
            var initialHeight = currentLi.height()
            console.log('Initial Window Height:', initialWindowHeight)

            var $element = $(
                '.registerde.ui-sortable-handle[style*="position: absolute;"]',
            )
            console.log('Initial Top Value:', currentLi.css('top'))

            var leftValue =
                (parseFloat(currentLi.css('left')) / initialWindowWidth) * 100
            var initialTopPercentage = parseInt(currentLi.css('top'), 10)
            console.log('Initial Left Percentage:', leftValue)
            console.log('Initial Top Percentage:', initialTopPercentage)
            console.log('くらった')

            $(window).on('resize', function () {
                var currentWindowWidth = $(window).width()
                var currentWindowHeight = $('body').height()
                console.log('initial: ' + currentWindowHeight)

                var topScaleY = currentWindowWidth / initialWindowWidth
                var scaleX = currentWindowWidth / initialWindowWidth
                var scaleY = currentWindowHeight / initialWindowHeight
                var newLeft = leftValue * scaleX + '%'
                var newTop = initialTopPercentage * topScaleY + 'px'

                currentLi.css('top', newTop) // topの値を変更
                console.log('width::' + currentLi.width())
                console.log('height::' + currentLi.height())

                // 新しい幅と高さを計算
                var newWidth = initialWidth * scaleX
                var newHeight = initialHeight * scaleY
                console.log('X::' + scaleX)
                console.log('Y::' + scaleY)

                var imgWidth = newWidth + 'px'
                var imgHeight = newHeight + 'px'
                console.log('width:' + imgWidth)
                console.log('height:' + imgHeight)
                // 幅と高さの値を設定
                currentLi.css({
                    width: imgWidth,
                    height: imgHeight,
                })

                currentLi.find('.ui-wrapper').css({
                    width: imgWidth,
                    height: imgHeight,
                })
                currentLi.find('.img').css({
                    width: imgWidth,
                    height: imgHeight,
                })
                currentLi.find('.parent').css({
                    width: imgWidth,
                    height: imgHeight,
                })

                applyResizable($('.img'))
                $('.windowWidthInput').val(currentWindowWidth)
                $('.windowHeightInput').val(currentWindowHeight)
                console.log(
                    'Window Width Input Value: ' + $('.windowWidthInput').val(),
                )
                console.log(
                    'Window Height Input Value: ' +
                        $('.windowHeightInput').val(),
                )
                currentLi.find('.window_width').val(currentWindowWidth)
                currentLi.find('.window_height').val(currentWindowHeight)
            })

            $('#registersItem').on('resize', function (event) {
                event.stopPropagation()
            })
        })
}
export function searchNumber(positions) {
    var parentLi = $(
        'input[name="register_id"][value="' + positions.registerId + '"]',
    ).closest('li')

    // li タグが見つかった場合、left の値を変更する
    if (parentLi.length > 0) {
        parentLi.css('left', positions.x + '%')
    } else {
        console.log(
            '指定された register_id を持つ li タグが見つかりませんでした。',
        )
    }
}

export function resizableWindow() {
    // 対象の要素（registerdeクラスを持つ要素）に対して操作を行う
    $('.registerde').each(function () {
        var currentLi = $(this)

        var windowHeight = currentLi.find('input[name="window_height"]').val()
        var windowWidth = currentLi.find('input[name="window_width"]').val()

        console.log('window_height: ' + windowHeight)
        console.log('window_width: ' + windowWidth)

        var initialTopPercentage = parseInt(currentLi.css('top'), 10)
        var currentWindowWidth = $(window).width()
        var currentWindowHeight = $('body').height()
        var scaleX = currentWindowWidth / windowWidth
        var scaleY = currentWindowHeight / windowHeight
        var newTop = initialTopPercentage * scaleY + 'px'

        currentLi.css('top', newTop)
        console.log('width::' + currentLi.width())
        console.log('height::' + currentLi.height())

        var newWidth = currentLi.width() * scaleX
        var newHeight = currentLi.height() * scaleY
        console.log('newWidth::' + newWidth)
        console.log('newHeight::' + newHeight)

        var imgWidth = newWidth - 6 + 'px'
        var imgHeight = newHeight - 6 + 'px'
        console.log('width:' + imgWidth)
        console.log('height:' + imgHeight)

        // currentLi.find('width').css({
        //     width: imgWidth,
        //     height: imgHeight,
        // })
        currentLi.css('width', imgWidth)
        currentLi.css('height', imgHeight)

        currentLi.find('.ui-wrapper').css({
            width: imgWidth,
            height: imgHeight,
        })
        currentLi.find('.img').css({
            width: imgWidth,
            height: imgHeight,
        })
        currentLi.find('.parent').css({
            width: imgWidth,
            height: imgHeight,
        })

        applyResizable(currentLi.find('.img'))
        // $('.windowWidthInput').val(currentWindowWidth)
        // $('.windowHeightInput').val(currentWindowHeight)
    })

    // 操作が完了したら要素を再表示する
    setTimeout(function () {
        $('.registerde').removeClass('hidden')
    }, 100) // 必要に応じて遅延時間を調整
}

$(document).ready(function () {
    // ボタンがクリックされた時の処理
    $('#omae').click(function () {
        // aria-expanded属性の値をトグルする
        $(this).attr('aria-expanded', function (index, attr) {
            return attr === 'true' ? 'false' : 'true'
        })

        // oreの表示状態を切り替える
        $('.ore').removeClass('translate-x-full')
        $('#closeButtn').show()
        $('#search').hide()
        $('#inputButtn').hide()
    })
    $('#closeButtn').click(function () {
        // aria-expanded属性の値をトグルする
        $(this).attr('aria-expanded', function (index, attr) {
            return attr === 'true' ? 'false' : 'true'
        })
        console.log('ositade')
        // oreの表示状態を切り替える
        $('.ore').addClass('translate-x-full')
        $('#closeButtn').hide()
        $('#search').show()
        $('#inputButtn').show()
    })

    $('.smallLocationButtn').click(function () {
        let window123 = $(window).width()
        // oreの表示状態を切り替える
        var isHidden = $('.smallRegisterButtn').is(':hidden')
        var inputValue = $('.header_locationname').text()
        if (
            $('.moveLocation').is(':hidden') &&
            inputValue.includes('ロケーションは登録されていません')
        ) {
            $('.moveLocation').show()
            $('.registerHide').show()
            $('#closeButtn').show()
        } else if (inputValue.includes('ロケーションは登録されていません')) {
            $('.registerButtn').hide()
            $('#closeButtn').hide()
            $('.moveLocation').hide()
            $('.registerHide').hide()
        } else {
            if (window123 < 870) {
                if (isHidden) {
                    $('.moveLocation').show()
                    $('.registerHide').show()
                    $('.smallRegisterButtn').show()
                    $('#closeButtn').show()
                    $('.registerde').show()
                } else if (!isHidden) {
                    $('#closeButtn').hide()
                    $('.smallRegisterButtn').hide()
                    $('.moveLocation').hide()
                    $('.registerHide').hide()
                    $('.registerde').hide()
                }
            }
        }

        $('.locationButtn').click(function () {})
        // if ($('.registerButtn').length && window123 < 870) {

        // } else if (!$('.registerButtn').length) {
        //     // 要素が存在しない場合の処理
        //     console.log('要素が存在しません')
        //     $('.registerButtn').show()
        // }
    })

    $('.smallRegisterButtn').click(function () {
        let window123 = $(window).width()
        var isHidden = $('.smallLocationButtn').is(':hidden')
        console.log(isHidden)
        if (isHidden) {
            $('.moveLocation').show()
            $('.smallLocationButtn').show()
            $('.locationHide').show()
            $('#closeButtn').show()
            $('.registerHide').addClass('mr-10')
            $('.registerde').show()
        } else if (!isHidden) {
            $('.smallLocationButtn').hide()
            $('.locationHide').hide()
            $('#closeButtn').hide()
            // $('.locationButtn').hide()
            $('.moveLocation').hide()
            $('.registerHide').removeClass('mr-10')
            $('.registerde').hide()
        }
    })
    $('.registerButtn').click(function () {
        var isHidden = $('.locationButtn').is(':hidden')
        console.log(isHidden)
        if (isHidden) {
            $('.pageButtn').show()
            $('.locationHide').show()
            $('.registerHide').addClass('mr-10')
            $('.registerde').show()
            if (!$('.formRegister').is(':hidden')) {
                $('.formRegister').slideUp()
            }

            console.log(4545)
        } else if (!isHidden) {
            $('.pageButtn').hide()
            $('.locationHide').hide()
            // $('.moveLocation').hide()
            if ($('.formRegister').is(':hidden')) {
                $('.formRegister').slideDown()
            }
            $('.registerHide').removeClass('mr-10')
            $('.registerde').hide()
            console.log(6969)
        }
    })
    $('.wideLocationButtn').click(function () {
        // const buttn = '.register'
        // buttnController(buttn)
        console.log(66666)
        var isHidden = $('.registerButtn').is(':hidden')
        console.log(isHidden)

        if (isHidden) {
            $('.registerHide').show()
            $('.registerButtn').show()
            $('.registerde').show()
            $('.pageButtn').show()
            var inputValue = $('.header_locationname').text()
            if (inputValue.includes('ロケーションは登録されていません')) {
                // 条件がtrueの場合の処理
                $('.register').hide()
            }
            console.log(66666)
        } else if (!isHidden) {
            $('.registerButtn').hide()
            $('.registerHide').hide()
            $('.registerde').hide()
            $('.pageButtn').hide()
            // $('.formLocation').show()
            var inputValue = $('.header_locationname').text()
            if (!inputValue.includes('ロケーションは登録されていません')) {
                // 条件がtrueの場合の処理
                console.log('反応したぜ')
                $('.register').hide()
                // $('.formLocation').hide()
            }
            console.log(9009)
        }
    })

    $('.register').click(function () {
        const buttn = '.wideLocationButtn'
        buttnController(buttn)
    })

    addSize()
    resizableWindow()
    responsiveDesign()

    function buttnController(buttn) {
        const isHidden = $(buttn).css('display') === 'none'
        const windowWidth = $(window).width()
        let elementsToToggle

        if (windowWidth < 1020) {
            elementsToToggle = $('.registerde,' + buttn)
        } else {
            elementsToToggle = $('.registerde, .pageButtn,' + buttn)
        }

        if (isHidden) {
            elementsToToggle.show()
            $('#userLocation').removeClass('hidden')
        } else {
            $('#userLocation').addClass('hidden')
            elementsToToggle.hide()
        }
    }

    function addSize() {
        var currentWindowWidth = $(window).width()
        var currentWindowHeight = $('body').height()
        $('.windowWidthInput').val(currentWindowWidth)
        $('.windowHeightInput').val(currentWindowHeight)
    }
    function handleWidthChange(className) {
        // 監視する要素の初期の幅を取得
        var initialWidth = $('.' + className).width()

        // 要素の幅が変更されたときに実行される関数
        function checkWidth() {
            // 現在の幅を取得
            var currentWidth = $('.' + className).width()

            // 初期の幅と現在の幅が異なる場合は、幅を100%に設定する
            if (initialWidth !== currentWidth) {
                // 幅を100%に設定する
                $('.' + className).css('width', '100%')
            }
        }

        // ウィンドウのリサイズイベントを監視して、幅が変更されたら対処する
        $(window).on('resize', checkWidth)
    }

    // クラス名を引数として関数を呼び出す
    handleWidthChange('registerHide')
    handleWidthChange('locationHide')
    function observeWidthChanges(targetSelector) {
        // 監視する要素を取得
        var targetElement = $(targetSelector)[0]

        // 初期の幅を取得
        var initialWidth = $(targetElement).width()

        // CSSの変更を監視する関数
        function observeCssChanges() {
            // 現在の幅を取得
            var currentWidth = $(targetElement).width()

            // 幅が0pxに変更された場合、幅を100%に戻す
            if (currentWidth === 0) {
                $(targetElement).css('width', '100%')
            }
        }

        // 一定の間隔でCSSの変更を監視
        setInterval(observeCssChanges, 500) // 500ミリ秒ごとに監視
    }

    // 関数を呼び出して、監視する要素のセレクタを渡す
    observeWidthChanges('.registerHide')
    observeWidthChanges('.locationHide')

    // 監視する要素のセレクタ
    // function observeWidthChanges(targetSelector) {
    //     // 初期の幅を取得
    //     var initialWidth = $(targetSelector).width()

    //     // 定期的に要素の幅をチェックする関数
    //     function checkWidth() {
    //         var currentWidth = $(targetSelector).width()
    //         // 幅が変更された場合の処理
    //         if (initialWidth !== currentWidth) {
    //             console.log('Widthが変更されました:', currentWidth)
    //             // ここにイベントを実行するコードを追加
    //             // 幅が変更されたら、幅を100%に設定
    //             $(targetSelector).css('width', '100%')
    //             // 幅が変更されたら、再び初期の幅を更新する
    //             initialWidth = $(targetSelector).width()
    //         }
    //     }

    //     // 一定の間隔で幅をチェックするためのタイマーをセット
    //     setInterval(checkWidth, 100) // 100ミリ秒ごとにチェック
    // }

    // // 関数を呼び出して、監視する要素のセレクタを渡す
    // observeWidthChanges('.registerHide')
})
