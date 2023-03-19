$(function () {
  // ドロップダウン
  $('.slide-button-down').click(function () { // ↓をクリック
    $(this).toggleClass('active'); // ボタンにactiveを追加or削除
    if ($(this).hasClass('active')) {
      $('#user-profile ul li').fadeIn().addClass('active');
    } else {
      $('#user-profile ul li').fadeOut().removeClass('active');
    }
  });

  // 投稿編集画面
  $('.js-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var post_id = $(this).attr('post_id');
    var post = $(this).attr('post'); // $post = と同義
    $('.modal_id').val(post_id); // 投稿に紐づいているidの取得
    $('.modal_post').val(post); // 投稿内容を取得
    return false;
  });

  // 編集fadeout
  $('.js-modal-close').on('click', function () {
    // モーダルの中身(class="js-modal")を非表示
    $('.js-modal').fadeOut();
    return false;
  });
});
