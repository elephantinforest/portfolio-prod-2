// $(document).ready(function () {
//     const targetElement = document.querySelector('.slideImage')

//     const observere = new MutationObserver((mutations) => {
//         mutations.forEach((mutation) => {
//             if (mutation.attributeName === 'class') {
//                 // class要素が変更されたときの処理を記述
//                 $('.dropLocation').droppable({
//                     drop: function (event, ui) {
//                         console.log('つうか')
//                         var referenceElement = $('.dropLocation') // 新しい基準点となる要素
//                         var referenceOffset = referenceElement.offset() // 基準点の座標

//                         // var x = ui.position.left - referenceOffset.left
//                         // var y = ui.position.top - referenceOffset.top
//                         var x = ui.position.left
//                         var y = ui.position.top
//                         var savePath = $('#save_path').val()
//                         var locationValue = $('#locationSpot').val()
//                         console.log(x, y)
//                         $.ajax({
//                             url: '/register/location',
//                             type: 'POST',
//                             data: {
//                                 location: locationValue,
//                                 savePath: savePath,
//                                 x: x,
//                                 y: y,
//                             },
//                             dataType: 'json',
//                             beforeSend: function () {
//                                 console.log(
//                                     'Before send: Ajax request is about to be sent.',
//                                 )
//                             },
//                             success: function (data) {
//                                 console.log('Success: Ajax request succeeded.')
//                                 console.log(data.success)
//                                 if (data.success) {
//                                     console.log('おらに元気をくれ')
//                                     var imageUrl = data.imageUrl
//                                     var registerId = data.registerId
//                                     var x = data.x
//                                     var y = data.y
//                                     $('#registersItem').append(
//                                         '<li class="registerde w-full sm:w-15 md:w-10 h-10 object-cover ui-sortable-handle" style="position: absolute; left:' +
//                                             x +
//                                             'px; top:' +
//                                             y +
//                                             'px;"><a href=""><img class="rounded-lg grayscale hover:contrast-200 hover:grayscale-0" src="' +
//                                             imageUrl +
//                                             '" alt="Uploaded Image"></a>' +
//                                             '<input type="hidden" name="registe_id" value="' +
//                                             registerId +
//                                             '"></li>',
//                                     )

//                                     $('#imageContainer').remove()
//                                     $('#slider').removeClass('dropLocation')
//                                     $('#uploadFormRegister')[0].reset()
//                                     $('#formLocation').show()
//                                     $('#formRegister').show()
//                                 } else {
//                                     alert('Image upload failed.')
//                                 }
//                             },
//                             error: function (jqXHR, textStatus, errorThrown) {
//                                 console.error(
//                                     'Error: Ajax request failed.',
//                                     textStatus,
//                                     errorThrown,
//                                 )
//                             },
//                             complete: function () {
//                                 console.log(
//                                     'Complete: Ajax request completed (after success or error).',
//                                 )
//                             },
//                         })
//                     },
//                 })
//             }
//         })
//     })

//     const config = { attributes: true }

//     observere.observe(targetElement, config)

//     var observer = new MutationObserver(function (mutations) {
//         mutations.forEach(function (mutation) {
//             // 子ノードの追加があるかどうかをチェック
//             if (mutation.type === 'childList') {
//                 // 追加されたノードが "registerde" クラスを持つかをチェック
//                 $(mutation.addedNodes)
//                     .filter('.registerde')
//                     .each(function () {
//                         $(this).draggable({
//                             stop: function (event, ui) {
//                                 var x = ui.position.left
//                                 var y = ui.position.top
//                                 console.log(x, y)
//                                 var register_id = $(this).find('input').val()
//                                 console.log('%表示')

//                                 // var element = $('#registersItem')
//                                 // var position = $(this) // 対象の要素を適切なセレクタで取得

//                                 // var position = position.position() // 要素の位置を取得
//                                 // var parentWidth = element.parent().width() // 親要素の幅を取得
//                                 // var parentHeight = element.parent().height() // 親要素の高さを取得

//                                 var position = $(this) // 対象の要素を適切なセレクタで取得
//                                 var position = position.offset() // 要素の位置を取得

//                                 console.log('絶対値')
//                                 console.log(position)
//                                 var parentWidth = $(window).width() // 親要素の幅を取得
//                                 var parentHeight = $(window).height() // 親要素の高さを取得
//                                 console.log(position)
//                                 console.log(parentWidth)
//                                 console.log(parentHeight)
//                                 var leftPercentage =
//                                     (position.left / parentWidth) * 100 // 左端位置をパーセンテージで計算
//                                 var topPercentage =
//                                     (position.top /) * 100 // 上端位置をパーセンテージで計算

//                                 console.log(
//                                     'Left Position Percentage: ' +
//                                         leftPercentage +
//                                         '%',
//                                 )
//                                 console.log(
//                                     'Top Position Percentage: ' +
//                                         topPercentage +
//                                         '%',
//                                 )
//                                 $.ajax({
//                                     url: '/position',
//                                     type: 'POST',
//                                     data: {
//                                         x: leftPercentage,
//                                         y: topPercentage,
//                                         register_id: register_id,
//                                     },
//                                     dataType: 'json',
//                                     beforeSend: function () {
//                                         console.log(
//                                             'Before send: Ajax request is about to be sent.',
//                                         )
//                                     },
//                                     success: function (data) {
//                                         console.log(
//                                             'Success: Ajax request succeeded.',
//                                         )
//                                         if (data.success) {
//                                             console.log('座標の更新完了')
//                                         } else {
//                                             alert('Image upload failed.')
//                                         }
//                                     },
//                                     error: function (
//                                         jqXHR,
//                                         textStatus,
//                                         errorThrown,
//                                     ) {
//                                         console.error(
//                                             'Error: Ajax request failed.',
//                                             textStatus,
//                                             errorThrown,
//                                         )
//                                     },
//                                     complete: function () {
//                                         console.log(
//                                             'Complete: Ajax request completed (after success or error).',
//                                         )
//                                     },
//                                 })
//                             },
//                         })
//                     })
//             }
//         })
//     })

//     // 監視対象のDOM要素を指定してDOMの変更を監視
//     observer.observe(document.body, { childList: true, subtree: true })

//     //     $(document).on('DOMNodeInserted', '.registerde', function () {
//     //     // '.dropLocation'クラスが要素に追加されたときに実行される処理をここに記述する

//     //     $(this).draggable({
//     //         stop: function (event, ui) {
//     //             var x = ui.position.left;
//     //             var y = ui.position.top;
//     //             console.log(x, y);
//     //             var register_id = $(this).find('input').val();

//     //             var position = $(this).offset(); // 要素の絶対位置を取得

//     //             console.log('絶対値');
//     //             console.log(position);
//     //             var parentWidth = $(window).width(); // 親要素の幅を取得
//     //             var parentHeight = $(window).height(); // 親要素の高さを取得
//     //             console.log(position);
//     //             console.log(parentWidth);
//     //             console.log(parentHeight);
//     //             var leftPercentage = (position.left / parentWidth) * 100; // 左端位置をパーセンテージで計算
//     //             var topPercentage = (position.top / parentHeight) * 100; // 上端位置をパーセンテージで計算

//     //             console.log(
//     //                 'Left Position Percentage: ' + leftPercentage + '%'
//     //             );
//     //             console.log(
//     //                 'Top Position Percentage: ' + topPercentage + '%'
//     //             );
//     //             $.ajax({
//     //                 url: '/position',
//     //                 type: 'POST',
//     //                 data: {
//     //                     x: leftPercentage,
//     //                     y: topPercentage,
//     //                     register_id: register_id,
//     //                 },
//     //                 dataType: 'json',
//     //                 beforeSend: function () {
//     //                     console.log(
//     //                         'Before send: Ajax request is about to be sent.'
//     //                     );
//     //                 },
//     //                 success: function (data) {
//     //                     console.log(
//     //                         'Success: Ajax request succeeded.'
//     //                     );
//     //                     if (data.success) {
//     //                         console.log('座標の更新完了');
//     //                     } else {
//     //                         alert('Image upload failed.');
//     //                     }
//     //                 },
//     //                 error: function (
//     //                     jqXHR,
//     //                     textStatus,
//     //                     errorThrown,
//     //                 ) {
//     //                     console.error(
//     //                         'Error: Ajax request failed.',
//     //                         textStatus,
//     //                         errorThrown,
//     //                     );
//     //                 },
//     //                 complete: function () {
//     //                     console.log(
//     //                         'Complete: Ajax request completed (after success or error).'
//     //                     );
//     //                 },
//     //             });
//     //         },
//     //     });
//     // });
// })
