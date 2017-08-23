$(document).ready(function() {
  reload_time_ago();
  $('body').on('click', '.btn-post', function() {
    $thisbutton = $(this); 
    $container_action_post = $thisbutton.parents('.container-action-post');
    var txt_content = $thisbutton.parents('.container-action-post').find('#txt-content');
    var select_post_type = $('#select-post-type').val();
    if (!txt_content.val() || txt_content.val() == "" || !select_post_type || select_post_type <= 0) {
      txt_content.focus();
      return false;
    }

    $container_action_post.addClass('be-loading-active');

    $.ajax({
      url: '/posts',
      type: 'POST',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
        content: txt_content.val(),
        post_type_id: select_post_type
      },
      success: function (data) {
        var html = '';
        if (data.errors) {
          $.each(data.errors.customMessages, function(key, value) {
            html += addErrorAlert(value);
          });
        } else if(data.success) {
          html += addSuccessAlert(data.success);
          $(".container-posts").html(data.post + $(".container-posts").html());
          $container_action_post.find('#txt-content').val('');
          reload_time_ago();
        }
        $(".error-alerts").html(html);
        $thisbutton.parents('.container-action-post').removeClass('be-loading-active');
      }
    });
  });

  $('body').on('click', '.btn-love', function() {
    var post_id = $(this).parents(".post-item").attr('data-post-id');
    $count_like_button = $(this).find('span');
    var count_like = $(this).find('span').attr('data-count-like');
    $this_button = $(this);
    $.ajax({
      url: '/likes',
      type: 'POST',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
        post_id: post_id
      },success: function (result) {
        if (result.errors) {
          alert(result.errors);
        } else if(result.status){
          if (result.status == 'like') {
            $this_button.find('i').addClass('color-red');
            count_like ++;
            $count_like_button.attr('data-count-like', count_like);
            $count_like_button.html('('+ count_like +')');
          } else {
            $this_button.find('i').removeClass('color-red');
            count_like --;
            $count_like_button.attr('data-count-like', count_like);
            $count_like_button.html('('+ count_like +')');
          }
        }
      }
    });
  });

  $('body').on('click', '.btn-comment', function() {
    var post_id = $(this).parent().parent().data('post-id');
    $this_button = $(this);
    $button_txt_comment = $(this).parent().find('.txt-comment');
    var txt_comment = $button_txt_comment.val();
    if (!txt_comment || txt_comment == "") {
      $button_txt_comment.focus();
      return false;
    }

    $.ajax({
      url: '/comments',
      type: 'POST',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
        post_id: post_id,
        content: txt_comment
      },success: function (result) {
        if (result.status == 1) {
          $button_txt_comment.val('');
          $container_comments = $this_button.parent()
            .parent().find(".container-comments");
          if ($container_comments.find('li').length >= 5) {
            $container_comments.find("li:first").remove();
          }
          $container_comments.append(result.html);

          reload_time_ago();
        } else {
          $button_txt_comment.focus();
        }
      }
    });
  });

  $('body').on('click', ".view-more-comments", function() {
    $this_button = $(this);
    var post_id = $this_button.parents('.post-item').data('post-id');
    var comment_page = $this_button.attr('href');
    var comments_old = $this_button.parent()
      .parent().find(".container-comments").html();
    $.ajax({
      url: '/posts/' + post_id + '?get=comments&comment_page=' + comment_page,
      type: 'GET',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function (result) {
        if (result.status == 1) {
          $this_button.parent().parent()
            .find(".container-comments").html(result.comments + comments_old);
          $this_button.attr('href', parseInt(comment_page) + 1);
          reload_time_ago();
        } else {
          message_alert();
        }
      }
    });
    return false;
  });

  $('body').on('click', '.btn-lazy-loading-post', function() {
    $this_button = $(this);
    $container_posts = $(this).parent().parent()
      .parent().find('.container-posts');
    var page = $this_button.attr('data-page');

    $.ajax({
      url: '/' + '?page=' + page,
      type: 'GET',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function (result) {
        if (result.posts) {
          $container_posts.append(result.posts);
          $this_button.attr('data-page', parseInt(page) + 1);
          reload_time_ago();
        } else {
          message_alert();
        }
      }
    });
  });

  //like comment
  $('body').on('click', '.btn-like-comment', function() {
    $this_button = $(this);
    var comment_id = $this_button.parent().parent().attr('comment-id');

    $.ajax({
      url: '/comment_likes',
      type: 'POST',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
        comment_id: comment_id
      },success: function (result) {
        if (result.status == 1) {
          if (result.comment_like_count) {
            $this_button.parent().find('.comment-like-count')
              .html('('+ result.comment_like_count +')');
          } else {
            $this_button.parent().find('.comment-like-count').html('');
          }
        } else {
          alert(result.errors);
        }
      }
    });
    //end ajax
  });

  //change status post
  $('body').on('click', '.btn-change-status', function() {
    $this_button = $(this);
    var post_id = $this_button.parents('.post-item').attr('data-post-id');
    var status = $this_button.attr("status-id");

    $.ajax({
      url: '/posts/' + post_id,
      type: 'PUT',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
        post: {
          status: status
        }
      },success: function (result) {
        if (result.status == 1) {
          var container_status = $this_button.find('a').html()
          $this_button.parent().parent().find('.container-status').html(container_status);
        } else {
          message_alert();
        }
      }
    });
  });

  //deleted post
  $('body').on('click', '.btn-delete-my-post', function() {
    var r = confirm("Ban co chac chan mua xoa!");
    if (!r) {
      return false;
    }
    $this_button = $(this);
    var post_id = $this_button.parent().parent()
      .parent().parent().attr('data-post-id');
    $.ajax({
      url: '/posts/' + post_id,
      type: 'PUT',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
        post: {
          deleted: 1
        }
      },success: function (result) {
        if (result.status == 1) {
          $this_button.parents('.post-item').remove();
        } else {
          message_alert();
        }
      }
    });
  });
  //hide comment
  $('body').on('click', '.btn-hide-comment', function() {
    $this_button = $(this);
    var comment_id = $this_button.parents('.single-comment').attr('comment-id');

    $.ajax({
      url: '/comments/' + comment_id,
      type: 'PUT',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
        comment: {
          hided: 1,
          user_hided: current_user_id
        }
      },success: function (result) {
        if (result.status == 1) {
          $this_button.parents('.single-comment')
            .replaceWith(result.comment);
          reload_time_ago();
        } else {
          message_alert();
        }
        
      }
    });
    //end ajax;
  });

  //show comment
  $('body').on('click', '.btn-show-comment', function() {
    $this_button = $(this);
    var comment_id = $this_button.parents('.single-comment')
      .attr('comment-id');

    $.ajax({
      url: '/comments/' + comment_id,
      type: 'PUT',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
        .attr('content')},
      data: {
        comment: {
          hided: 0,
          user_hided: 0
        }
      },success: function (result) {
        if (result.status == 1) {
          $this_button.parents('.single-comment')
            .replaceWith(result.comment);
          reload_time_ago();
        } else {
          message_alert();
        }
      }
    });
    //end ajax;
  });

  //edit comment
  $('body').on('click', '.btn-edit-comment', function() {
    var old_content = $(this).parents('.single-comment')
      .find('.comment-content');
    old_content.replaceWith('<textarea class="width-100 comment-content"type="text">'+ old_content.html() +'</textarea>');
    $(this).replaceWith('<a class="btn-update-comment">Cập nhật</a>');
  });

  //update comment
  $('body').on('click', '.btn-update-comment', function() {
    $this_button = $(this);
    var comment_id = $this_button.parents('.single-comment')
      .attr('comment-id');
    var content = $this_button.parents('.single-comment')
      .find('.comment-content');
    if (!content.val() || content.val() == "") {
      content.focus();
    } else {
      $.ajax({
        url: '/comments/' + comment_id,
        type: 'PUT',
        dataType: 'JSON',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
          .attr('content')},
        data: {
          comment: {
            content: content.val()
          }
        },success: function (result) {
          if (result.status == 1) {
            $this_button.parents('.single-comment')
              .replaceWith(result.comment);
            reload_time_ago();
          } else {
            message_alert();
          }
        }
      });
      //end ajax;
    }
  });

  //edit post
  $('body').on('click', '.btn-edit-post', function() {
    var post_content = $(this).parents('.post-item')
      .find('.post-content');
    var post_content_html = '<textarea class="post-content">';
    post_content_html += post_content.html().trim();
    post_content_html += '</textarea>';
    post_content_html += '<button class="btn btn-space btn-primary pull-right btn-update-post">';
    post_content_html += 'Cập nhật</button>';

    post_content.replaceWith(post_content_html);
    $(this).parents('.post-item')
      .find('.post-content').summernote({height:150});
  });

  //update post
  $('body').on('click', '.btn-update-post', function() {
    $this_button = $(this);
    $post_item = $this_button.parents('.post-item');
    var post_id = $post_item.attr('data-post-id');
    var post_content = $post_item.find('.post-content');
    if (!post_content.val() || post_content.val() == "") {
      post_content.focus();
    } else {
      $.ajax({
        url: '/posts/' + post_id,
        type: 'PUT',
        dataType: 'JSON',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
          .attr('content')},
        data: {
          post: {
            content: post_content.val()
          }
        },success: function (result) {
          if (result.status == 1) {
            $post_item.replaceWith(result.post);
            reload_time_ago();
          } else {
            message_alert();
          }
        }
      });
      //end ajax;
    }
  });
});

function addErrorAlert(message) {
  var html = '<div role="alert" class="alert alert-danger';
  html += ' alert-icon alert-icon-border alert-dismissible">';
  html += ' <div class="icon">';
  html += ' <span class="mdi mdi-close-circle-o"></span>';
  html += ' </div>';
  html += ' <div class="message">';
  html += ' <button type="button" data-dismiss="alert"';
  html += ' aria-label="Close" class="close">';
  html += ' <span aria-hidden="true" class="mdi mdi-close"></span>';
  html += ' </button>';
  html += ' <strong>Error!</strong> ' + message;
  html += ' </div>';
  html += '</div>';
  return html;
}

function addSuccessAlert(message) {
  var html = '<div role="alert" class="alert alert-success';
  html += ' alert-icon alert-icon-border alert-dismissible">';
  html += ' <div class="icon">';
  html += ' <span class="mdi mdi-close-circle-o"></span>';
  html += ' </div>';
  html += ' <div class="message">';
  html += ' <button type="button" data-dismiss="alert"';
  html += ' aria-label="Close" class="close">';
  html += ' <span aria-hidden="true" class="mdi mdi-close"></span>';
  html += ' </button>';
  html += ' <strong>Success!</strong> ' + message;
  html += ' </div>';
  html += '</div>';
  return html;
}

function reload_time_ago() {
  $("time.timeago").timeago();
}

function message_alert() {
  alert('Co loi xay ra!');
}

function subtring_post_content() {
  $('.post-content').each(function( index ) {
    var post_content_sub_string = $(this).html().trim().substring(0, 255);
    $(this).html(post_content_sub_string);
  });
}
