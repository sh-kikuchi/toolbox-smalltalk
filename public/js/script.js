/******/ (() => { // webpackBootstrap
  var __webpack_exports__ = {};
  /*!***************************************!*\
    !*** ./resources/js/assets/script.js ***!
    \***************************************/
  $(function () {
    $(function () {
      $('.js-modal-open').each(function () {
        $(this).on('click', function () {
          /*---列番号とカード番号をデータ属性で取得 ---*/
          var post_id = $(this).data('post_id');
          var post_text = $(this).data('post_text');
          var comment_id = $(this).data('comment_id');
          var comment_text = $(this).data('comment_text');
          $('.input-post-id').val(post_id);
          $('.input-post-text').val(post_text);
          $('.input-comment-id').val(comment_id);
          $('.input-comment-text').val(comment_text);
          /*------------------------------------------*/

          $('.js-modal').fadeIn();
          return false;
        });
      });
      $('.js-modal-close').on('click', function () {
        $('.js-modal').fadeOut();
        return false;
      });
    });
  });
  /******/
})()
  ;
