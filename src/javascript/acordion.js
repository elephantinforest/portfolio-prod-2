$(function () {
    // ページがロードされた後に実行されるコード
    // アコーディオンとユーザーの場所をフェードインさせる
    $('#accordion').fadeIn(1000)
    $('#userLocation').fadeIn(10)

    $('#accordion').accordion({
        collapsible: true,
        active: false, // 最初はアコーディオンを閉じた状態にする
        // event: 'mouseover',
    })
      $('#accordionSmall').fadeIn(1000)
      $('#userLocation').fadeIn(10)

      $('#accordionSmall').accordion({
          active: false, // 最初はアコーディオンを閉じた状態にする
          collapsible: true,
      })
    $('.ui-accordion-header')
        .css('background', 'none')
        .css('background-color', 'rgba(250 ,204, 21, 0.8)')

    $('.ui-accordion-content')
        .css('background', 'none')
})
