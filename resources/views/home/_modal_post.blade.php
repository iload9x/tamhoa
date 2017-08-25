<div id="md-colored" tabindex="-1" role="dialog"
  class="modal fade colored-header colored-header-primary">
  <div class="full-width modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal"
          aria-hidden="true" class="close">
          <span class="mdi mdi-close"></span>
        </button>
        <h3 class="modal-title">@lang("posts.new_post_name")</h3>
      </div>
      <div class="modal-body">
        <form action="{{ route('posts.store') }}" method="POST" class="post-new-form" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group xs-pt-10">
            <label>@lang("posts.name"):</label>
            <input type="text" name="post[name]" placeholder="@lang('posts.enter_name')"
              class="form-control input-xs" required data-parsley-minlength="6">
          </div>
          <div class="form-group">
            <label>@lang("categories.name"):</label>
            <select name="post[category_id]" class="form-control input-xs"
              required="">
              <option value="">---@lang("categories.select_category")---</option>
              @if($categories->count())
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="form-group">
            <label>@lang("posts.content"):</label>
            <textarea name="post[content]" id="post-editor"></textarea>
          </div>
          <div class="form-group">
            <input type="file" required name="avatar" id="file-1"
              data-multiple-caption="{count} files selected"
              multiple class="inputfile">
            <label for="file-1" class="btn-default">
              <i class="mdi mdi-upload"></i>
              <span>@lang("posts.choose_avatar")...</span>
            </label>
          </div>
          <div class="row xs-pt-15">
            <div class="col-xs-6">
              <div class="be-checkbox">
                <input name="post[blocked]" id="hide" type="checkbox" value="1">
                <label for="hide">@lang("posts.hide")</label>
              </div>
            </div>
            <div class="col-xs-6">
              <p class="text-right">
                <button type="submit" class="btn btn-space btn-primary">@lang("buttons.post")</button>
                <button data-dismiss="modal" class="btn btn-space btn-default">@lang("buttons.cancel")</button>
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
