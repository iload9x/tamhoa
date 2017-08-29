@if(Auth::guest())
  <div class="login">
    <div class="panel panel-border-color panel-border-color-success">
      <div class="panel-heading">@lang("others.login_title")</div>
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-sm-12">
              <input type="email" name="email" placeholder="@lang('others.txt_email')"
                class="form-control input-xs" required autofocus>
              @if ($errors->has("email"))
                <span class="help-block">
                  <strong>{{ $errors->first("email") }}</strong>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-sm-12">
            <input type="password" name="password" placeholder="@lang('others.txt_password')"
              class="form-control input-xs" required>
            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12 text-right">
              <button type="submit"
                class="btn btn-success">@lang("buttons.login")</button>
              <div style="margin: 5px 0px;">
                <a href="{{ route('register') }}" class="color-34a853">@lang("others.dont_have_account")</a>
              </div>
              <div><a href="{{ route('password.request') }}" class="color-34a853">@lang("others.forget_password")</a></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@else
  <div class="login">
    <div class="panel panel-border-color panel-border-color-success">
      <div class="panel-heading">@lang("others.profile_title")</div>
      <div class="panel-body">
        <p>
          <span><img src="/icons/1.png" alt=""> <b>{{ Auth::user()->name }}</b></span>
          <span class="pull-right">(@lang("others.member"))</span>
        </p>
        <p>
          <span>@lang("others.txt_email"):</span>
          <span class="pull-right">{{ Auth::user()->email }}</span>
        </p>
        <p>
          <span>@lang("coins.has_coin"):</span>
          <span class="pull-right">{{ number_format(Auth::user()->coin) }}</span>
        </p>
        @if(Auth::user()->card_storage()->count())
          <p>
            <span>@lang("others.card_storage"):</span>
            <span class="pull-right">
              {{ number_format(Auth::user()->card_storage->current) }}
            </span>
          </p>
        @endif
        <p><span><a href="">@lang("others.change_password")</a></span></p>
        <div class="text-right">
          <div>
            <a href="{{ route('logout') }}" class="btn btn-success"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              @lang("buttons.logout")
            </a>
            <form id="logout-form" action="{{ route('logout') }}"
              method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
