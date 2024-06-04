$(document).ready(function () {
    //ポストした時の処理
    // $('.uploadRegister').on('click', function () {
    //     var windowSizeValue = $('input[name="windowSize"]').val()
    //     console.log('windowSize:', windowSizeValue)
    //     var formData = new FormData($('.uploadFormRegister')[1])
    //     console.log(formData)
    //     var locationValue = $('#locationSpot').val()
    //     var windowWidth = $(window).width()
    //     var windowHeight = $('body').height()
    //     formData.append('location_id', locationValue)
    //     formData.append('window_width', windowWidth)
    //     formData.append('window_height', windowHeight)
    //     $.ajax({
    //         url: '/register',
    //         type: 'POST',
    //         data: formData,
    //         dataType: 'json',
    //         contentType: false,
    //         processData: false,
    //         beforeSend: function () {
    //             console.log('Before send: Ajax request is about to be sent.')
    //             $('#buttn').hide()
    //             $('.pager').hide()
    //             showLoadingAnimation()
    //         },
    //         success: function (data) {
    //             console.log('Success: Ajax request succeeded.')
    //             hideLoadingAnimation()
    //             if (data.success) {
    //                 var imageUrl = data.imageUrl
    //                 var registerId = data.registerId
    //                 $('#imageContainer').show()
    //                 $('#imageContainer').html(
    //                     '<div  id="uploaded_image"  class="object-cover ui-sortable-handle" ><img class=" rounded-lg grayscale hover:contrast-200 hover:grayscale-0"src="' +
    //                         imageUrl +
    //                         '" alt="Uploaded Image" style="width: 90px;  height: 100px;">' +
    //                         '<input type="hidden" id="register_id" name="register_id" value="' +
    //                         registerId +
    //                         '"> </div>',
    //                 )
    //             } else {
    //                 $('#buttn').show()
    //                 $('.pager').show()
    //                 sendAlert(data.errors)
    //             }
    //         },
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             console.error(
    //                 'Error: Ajax request failed.',
    //                 textStatus,
    //                 errorThrown,
    //             )
    //         },
    //         complete: function () {
    //             // $('#slideImage').addClass('dropLocation')
    //             $('#uploaded_image').draggable({
    //                 // ドラッグ開始時の処理
    //                 start: function (event, ui) {
    //                     // ドラッグされた要素をオリジナルの位置から移動
    //                     $(this).css('z-index', 9999)
    //                 },
    //                 // ドラッグ終了時の処理
    //                 stop: function (event, ui) {
    //                     // ドロップ後にオリジナルの位置に戻す
    //                     $(this).css('z-index', 1)
    //                     var position = $(this) // 対象の要素を適切なセレクタで取得
    //                     var position = position.offset() // 要素の位置を取得
    //                     // var parentWidth = element.parent().width() // 親要素の幅を取得
    //                     // var parentHeight = element.parent().height() // 親要素の高さを取得

    //                     var parentWidth = $(window).width() // 親要素の幅を取得
    //                     var leftPercentage = (position.left / parentWidth) * 100 // 左端位置をパーセンテージで計算
    //                     var topPercentage = position.top // 上端位置をパーセンテージで計算
    //                     var locationValue = $('#locationSpot').val()
    //                     var registerID = $('#register_id').val()
    //                     $.ajax({
    //                         url: '/register/location',
    //                         type: 'POST',
    //                         data: {
    //                             locationId: locationValue,
    //                             registerId: registerID,
    //                             x: leftPercentage,
    //                             y: topPercentage,
    //                         },
    //                         dataType: 'json',
    //                         beforeSend: function () {
    //                             console.log(
    //                                 'Before send: Ajax request is about to be sent.',
    //                             )
    //                         },
    //                         success: function (data) {
    //                             console.log('Success: Ajax request succeeded.')
    //                             if (data.success) {
    //                                 var imageUrl = data.imageUrl
    //                                 var registerId = data.registerId
    //                                 var registerName = data.registerName
    //                                 var x = data.x
    //                                 var y = data.y
    //                                 const register = {
    //                                     left_position: x,
    //                                     top_position: y,
    //                                     file_path: imageUrl,
    //                                     register_id: registerId,
    //                                     name: registerName,
    //                                     width: 90,
    //                                     height: 100,
    //                                 }
    //                                 $('#registersItem').append(
    //                                     makeRegisterList(register),
    //                                 )
    //                                 $('#imageContainer').empty()
    //                                 $('#slider').removeClass('dropLocation')
    //                                 $('#uploadFormRegister')[0].reset()
    //                             } else {
    //                                 alert('Image upload failed.')
    //                             }
    //                         },
    //                         error: function (jqXHR, textStatus, errorThrown) {
    //                             console.error(
    //                                 'Error: Ajax request failed.',
    //                                 textStatus,
    //                                 errorThrown,
    //                             )
    //                         },
    //                         complete: function () {
    //                             console.log(
    //                                 'Complete: Ajax request completed (after success or error).',
    //                             )
    //                             $('.pager').show()
    //                             $('#buttn').show()
    //                             $('#buttn').empty()
    //                             fetchRegistersName()
    //                             responsiveDesign()
    //                         },
    //                     })
    //                 },
    //             })
    //             console.log(
    //                 'Complete: Ajax request completed (after success or error).',
    //             )
    //         },
    //     })
    // })

    //ドラッグした時の処理
    function makeDraggable(element) {
        element.draggable({
            stop: function (event, ui) {
                // ドラッグ停止時の座標を取得
                var x = ui.position.left
                var y = ui.position.top
                var windowWidth = $(window).width()
                var windowHeight = $('body').height()
                console.log(x, y)
                var register_id = $(this).find('input').val()
                var position = $(this).position()
                var parentWidth = $(window).width()
                console.log(position.top)
                var leftPercentage = (position.left / parentWidth) * 100
                var topPercentage = y
                console.log('Left Position Percentage: ' + leftPercentage + '%')
                console.log('Top Position Percentage: ' + topPercentage + '%')
                // Ajaxリクエストを送信
                $.ajax({
                    url: '/position',
                    type: 'POST',
                    data: {
                        x: leftPercentage,
                        y: topPercentage,
                        register_id: register_id,
                        windowWidth: windowWidth,
                        windowHeight: windowHeight,
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        console.log(
                            'Before send: Ajax request is about to be sent.',
                        )
                    },
                    success: function (data) {
                        console.log('Success: Ajax request succeeded.')
                        console.log(data)
                        if (data.success === true) {
                            console.log('座標の更新完了')
                            searchNumber(data.position)
                            console.log(data.position)
                        } else {
                            sendAlert(data)
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
                        responsiveDesign()
                    },
                })
            },
        })
    }
    $('.wideUploadRegister').on('click', function () {
        const formType = '.wideUploadFormRegister'
        handleFormSubmission(formType)
    })
    $('.smallUploadRegister').on('click', function () {
        const formType = '.smallUploadFormRegister'
        handleFormSubmission(formType)
    })

    function handleFormSubmission(formSelector) {
        var formData = new FormData($(formSelector)[0])
        var locationValue = $('#locationSpot').val()
        var windowWidth = $(window).width()
        var windowHeight = $('body').height()
        formData.append('location_id', locationValue)
        formData.append('window_width', windowWidth)
        formData.append('window_height', windowHeight)

        $.ajax({
            url: '/register',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function () {
                console.log('Before send: Ajax request is about to be sent.')
                // $('#buttn').hide()
                $('#fixedContainer').show()
                $('.registerde').show()
                // $('.pager').hide()
                $('.pageButtn').hide()
                $('header').hide()
                showLoadingAnimation()
            },
            success: function (data) {
                console.log('Success: Ajax request succeeded.')
                hideLoadingAnimation()
                if (data.success) {
                    var imageUrl = data.imageUrl
                    var registerId = data.registerId
                    // $('#imageContainer').show()
                    $('#imageContainer').html(
                        '<div id="uploaded_image" class="fixed top-0 left-0 w-full z-50 object-cover ui-sortable-handle"><img class="rounded-lg grayscale hover:contrast-200 hover:grayscale-0" src="' +
                            imageUrl +
                            '" alt="Uploaded Image" style="width: 90px; height: 100px;">' +
                            '<input type="hidden" id="register_id" name="register_id" value="' +
                            registerId +
                            '"></div>',
                    )
                } else {
                    $('#buttn').show()
                    $('.pager').show()
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
                $('#uploaded_image').draggable({
                    start: function (event, ui) {
                        $(this).css('z-index', 9999)
                    },
                    stop: function (event, ui) {
                        $(this).css('z-index', 1)
                        var position = $(this).offset()
                        var parentWidth = $(window).width()
                        var leftPercentage = (position.left / parentWidth) * 100
                        var topPercentage = position.top
                        var locationValue = $('#locationSpot').val()
                        var registerID = $('#register_id').val()
                        $.ajax({
                            url: '/register/location',
                            type: 'POST',
                            data: {
                                locationId: locationValue,
                                registerId: registerID,
                                x: leftPercentage,
                                y: topPercentage,
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
                                    var imageUrl = data.imageUrl
                                    var registerId = data.registerId
                                    var registerName = data.registerName
                                    var x = data.x
                                    var y = data.y
                                    const register = {
                                        left_position: x,
                                        top_position: y,
                                        file_path: imageUrl,
                                        register_id: registerId,
                                        name: registerName,
                                        width: 90,
                                        height: 100,
                                    }
                                    $('#registersItem').append(
                                        makeRegisterList(register),
                                    )
                                    $('#imageContainer').empty()
                                    $('#slider').removeClass('dropLocation')
                                    $(formSelector)[0].reset()
                                } else {
                                    alert('Image upload failed.')
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

                                if (parentWidth < 1020) {
                                    $('.content').hide()
                                    $('header').show()
                                    // $('#buttn').empty()
                                    $('.pageButtn').show()

                                    // $('#buttn').show()
                                    fetchRegistersName()
                                    responsiveDesign()
                                    $('.registerHide').css('width', '100%')
                                } else {
                                    $('.register').hide()
                                    $('.content').hide()
                                    $('.wideLocationButtn').show()
                                    $('.register').show()
                                    $('.pageButtn').show()
                                    $('header').show()
                                    // $('#buttn').empty()
                                    $('.pageButtn').show()

                                    // $('#buttn').show()
                                    fetchRegistersName()
                                    responsiveDesign()
                                }
                            },
                        })
                    },
                })
                console.log(
                    'Complete: Ajax request completed (after success or error).',
                )
            },
        })
    }

    $(function () {
        // 初期の要素に対してドラッグ可能な状態にする
        makeDraggable($('.registerde'))

        // ページ内の要素が動的に追加された場合に対応するため、新しい要素にもドラッグ可能な状態にする
        $(document).on('DOMNodeInserted', function (e) {
            var element = $(e.target)
            if (element.hasClass('registerde')) {
                makeDraggable(element)
            }
        })
    })

    function showLoadingAnimation() {
        $('#loading').removeClass('hidden')
    }

    // ロード中のアニメーションを非表示にする関数
    function hideLoadingAnimation() {
        $('#loading').addClass('hidden')
    }
})
