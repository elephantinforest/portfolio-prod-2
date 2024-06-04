// import { makeRegisterList } from "export.js"

// import { makeButtnList } from "export.js"

$(document).ready(function () {
    function getLocationData(data) {
        return new Promise(function (resolve, reject) {
            const locationId = $('#locationSpot').val()
            $.ajax({
                url: `/${data}`,
                type: 'GET',
                data: { locationId: locationId },
                dataType: 'json',
                contentType: 'application/json',
                success: function (data) {
                    console.log(data)
                    if (data.success) {
                        console.log(data)
                        let locationName = data.locations['location']
                        console.log(locationName)
                        let locationId = data.locations['location_id']
                        $('.header_locationname').text(locationName)
                        $('#slideImage').attr(
                            'src',
                            data.locations['file_path'],
                        )
                        $('#locationSpot').val(locationId)

                        // 登録された要素を削除してから新しい要素を追加する
                        $('.registerde').remove()
                        $('.delete').remove()
                        $.each(data.registers, function (index, element) {
                            console.log(element)
                            $('#registersItem').append(
                                makeRegisterList(element),
                            )
                            // $('#buttn').append(makeButtnList(element));
                        })

                        // レジスター名を取得する関数を呼び出す

                        fetchRegistersName()
                        resizableWindow()
                        responsiveDesign()
                    } else {
                        console.log(data)
                        sendAlert(data.errors)
                        console.log(data.errors)
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(
                        'Error: Ajax request failed.',
                        textStatus,
                        errorThrown,
                    )
                    reject(new Error('Ajax request failed.'))
                },
            })
        })
    }

    // function fetchRegisters(locationId) {
    //     $.ajax({
    //         url: '/register/name',
    //         type: 'POST',
    //         data: { locationId: locationId },
    //         dataType: 'json',
    //         success: function (data) {
    //             if (data.success) {
    //                 $('.registerde').remove()
    //                 $('.delete').remove()
    //                 $.each(data.registers, function (index, element) {
    //                     $('#registersItem').append(makeRegisterList(element))
    //                     // $('#buttn').append(makeButtnList(element))
    //                 })
    //             }
    //             fetchRegistersName()
    //         },
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             console.error(
    //                 'Error: Ajax request failed.',
    //                 textStatus,
    //                 errorThrown,
    //             )
    //         },
    //     })
    // }

    function updateImage(data) {
        // locationsからデータを取得して表示する
    }

    $('.prevBtn').on('click', function () {
        getLocationData('prev')
            .then(function (data) {})
            .catch(function (error) {
                console.error('Error: ', error)
            })
    })

    $('.nextBtn').on('click', function () {
        getLocationData('next')
            .then(function (data) {})
            .catch(function (error) {
                console.error('Error: ', error)
            })
    })
    // $('.prevBtn').on('click', function () {
    //     getLocationData('prev')
    //         .then(function (data) {})
    //         .catch(function (error) {
    //             console.error('Error: ', error)
    //         })
    // })

    // $('.nextBtn').on('click', function () {
    //     getLocationData('next')
    //         .then(function (data) {})
    //         .catch(function (error) {
    //             console.error('Error: ', error)
    //         })
    // })

    //ロケーションを追加する処理
    $('.uploadLocation').on('click', function () {
        const windowSize = $(this).val()
        if (windowSize === 'small') {
            var formData = new FormData($('.uploadFormLocation')[0])
        } else {
            var formData = new FormData($('.uploadFormLocation')[1])
        }
        $.ajax({
            url: '/locationupload',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.success) {
                    var inputValue = $('.header_locationname').text()
                    if (
                        inputValue.includes(
                            'ロケーションは登録されていません。',
                        )
                    ) {
                        // 条件が真の場合の処理
                        console.log(321)
                        $('.header_locationname').text(data.locationValue)
                        $('.slideImage').attr('src', data.imageUrl)
                        $('#locationSpot').val(data.locationId)
                        // $('.register').show()
                    }
                    alert('ロケーションの追加が出来ました。')
                } else {
                    // $('.register').show()
                    sendAlert(data.errors)
                }
                $('.uploadFormLocation')[0].reset()
                $('.uploadFormLocation')[1].reset()
                var inputValue = $('.header_locationname').text()
                console.log(inputValue)
                console.log(
                    !inputValue.includes('ロケーションは登録されていません'),
                )
                if (!inputValue.includes('ロケーションは登録されていません')) {
                    // 条件がtrueの場合の処理
                    console.log('反応したぜ')
                    // $('.register').show()
                    // $('.formLocation').hide()
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(
                    'Error: Ajax request failed.',
                    textStatus,
                    errorThrown,
                    alert('ロケーション名'),
                )
            },
        })
    })
})
