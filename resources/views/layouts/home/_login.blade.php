@if(Auth::guest())
  <div class="login">
    <div class="panel panel-border-color panel-border-color-success">
      <div class="panel-heading">ĐĂNG NHẬP</div>
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-sm-12">
              <input type="email" name="email" placeholder="Email"
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
            <input type="password" name="password" placeholder="Password"
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
                class="btn btn-success">Đăng nhập</button>
              <div style="margin: 5px 0px;">
                <a href="{{ route('register') }}" class="color-34a853">Bạn chưa có tài khoản?</a>
              </div>
              <div><a href="{{ route('password.request') }}" class="color-34a853">Quên mật khẩu?</a></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@else
  <div class="login">
    <div class="panel panel-border-color panel-border-color-success">
      <div class="panel-heading">THÔNG TIN CÁ NHÂN</div>
      <div class="panel-body">
        <p>
          <span><img src="/icons/1.png" alt=""> <b>{{ Auth::user()->name }}</b></span>
          <span class="pull-right">(Member)</span>
        </p>
        <p>
          <span>Email:</span>
          <span class="pull-right">{{ Auth::user()->email }}</span>
        </p>
        <p>
          <span>Xu web hiện có:</span>
          <span class="pull-right">{{ Auth::user()->coin }}</span>
        </p>
        <p><span><a href="">Đổi mật khẩu</a></span></p>
        <div class="text-right">
          <div>
            <a href="{{ route('logout') }}" class="btn btn-success"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              Logout
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
