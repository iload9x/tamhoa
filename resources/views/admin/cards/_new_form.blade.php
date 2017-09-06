<div class="col-sm-3">
  <div class="panel panel-default panel-border-color panel-border-color-primary">
    <div class="panel-heading panel-heading-divider">@lang("admin.new_card")
    </div>
    <div class="panel-body be-loading">
      <form action="{{ route('admin.cards.store') }}" data-parsley-validate="" novalidate=""
        class="new-card-form" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
          <label>@lang("admin.select_telcocode"):</label>
          <select required="" name="card[telcocode]" class="form-control input-sm">
            <option value="">----@lang("admin.select_telcocode")----</option>
            <option value="VTT">Thẻ Vietel</option>
            <option value="VMS">Thẻ Mobifone</option>
            <option value="VNP">Thẻ Vinaphone</option>
            <option value="MGC">Thẻ Megacard</option>
            <option value="FPT">Thẻ Gate</option>
            <option value="ZING">Thẻ ZING</option> 
            <option value="ONC">Thẻ Oncash</option>
          </select>
        </div>
        <div class="form-group">
          <label>@lang("admin.card_serial"):</label>
          <input type="text" name="card[serial]" parsley-trigger="change" required=""
            placeholder="@lang('admin.card_serial')" class="form-control input-sm"
            data-parsley-length="[6,50]" autofocus="">
        </div>
        <div class="form-group">
          <label>@lang("admin.card_pin"):</label>
          <input type="text" name="card[pin]" parsley-trigger="change"
            required=""
            data-parsley-length="[6,50]"
            placeholder="@lang('admin.card_pin')" class="form-control input-sm">
        </div>
        <div class="form-group">
          <label>@lang("admin.email"):</label>
          <input type="email" name="email" parsley-trigger="change" data-parsley-checkemail="true"
            required="" data-parsley-checkemail-message="Please enter the cvv"
            placeholder="@lang('admin.email')" class="form-control input-sm">
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-space btn-primary">@lang("buttons.add")</button>
          <button class="btn btn-space btn-default btn-reset" type="reset">@lang("buttons.cancel")</button>
        </div>
      </form>
      <div class="be-spinner">
        <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
          <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
        </svg>
      </div>
    </div>
  </div>
</div>
