/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/assets/script.js ***!
  \***************************************/
$(function () {
  $(function () {
    $('.js-modal-open').each(function () {
      $(this).on('click', function () {
        var target = $(this).data('target');
        var modal = document.getElementById(target);
        var post_id = $(this).data('post_id');
        var post_text = $(this).data('post_text');
        var comment_id = $(this).data('comment_id');
        var comment_text = $(this).data('comment_text');
        var note_id = $(this).data('note_id');
        var note_text = $(this).data('note_text');
        var channel_id = $(this).data('channel_id');
        var chat_id = $(this).data('chat_id');
        var chat_text = $(this).data('chat_text');
        $('.input-post-id').val(post_id);
        $('.input-post-text').val(post_text);
        $('.input-comment-id').val(comment_id);
        $('.input-comment-text').val(comment_text);
        $('.input-note-id').val(note_id);
        $('.input-note-text').val(note_text);
        $('.input-channel-id').val(channel_id);
        $('.input-chat-id').val(chat_id);
        $('.input-chat-text').val(chat_text);
        /*------------------------------------------*/

        $(modal).fadeIn();
        return false;
      });
    });
    $('.js-modal-close').on('click', function () {
      $('.js-modal').fadeOut();
      return false;
    });
  });
});
/******/ })()
;