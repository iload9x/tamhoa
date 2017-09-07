<div class="be-right-navbar">
  <ul class="nav navbar-nav navbar-right be-user-nav">
    <li class="dropdown">
      <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
        <img src="/{{ \App\Helpers\AssetHelper::path() }}assets/img/avatar.png" alt="Avatar">
        <span class="user-name">{{ Auth::user()->name }}</span>
      </a>
      <ul role="menu" class="dropdown-menu">
        <li>
          <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-position online">Available</div>
          </div>
        </li>
        <li>
          <a href="#">
            <span class="icon mdi mdi-face"></span> Account</a>
        </li>
        <li>
          <a href="#">
            <span class="icon mdi mdi-settings"></span> Settings</a>
        </li>
        <li>
          <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <span class="icon mdi mdi-power"></span> @lang("buttons.logout")
          </a>
          <form id="logout-form" action="{{ route('logout') }}"
            method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </li>
  </ul>
  <div class="page-title">
    <span>@yield("title")</span>
  </div>
  <ul class="nav navbar-nav navbar-right be-icons-nav">
    <li class="dropdown">
      <a href="#" role="button" aria-expanded="false" class="be-toggle-right-sidebar">
        <span class="icon mdi mdi-settings"></span>
      </a>
    </li>
    <li class="dropdown">
      <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
        <span class="icon mdi mdi-notifications"></span>
        <span class="indicator"></span>
      </a>
      <ul class="dropdown-menu be-notifications">
        <li>
          <div class="title">Notifications
            <span class="badge">3</span>
          </div>
          <div class="list">
            <div class="be-scroller">
              <div class="content">
                <ul>
                  <li class="notification notification-unread">
                    <a href="#">
                      <div class="image">
                        <img src="/{{ \App\Helpers\AssetHelper::path() }}assets/img/avatar2.png" alt="Avatar">
                      </div>
                      <div class="notification-info">
                        <div class="text">
                          <span class="user-name">Jessica Caruso</span> accepted your invitation to join the team.</div>
                        <span class="date">2 min ago</span>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer">
            <a href="#">View all notifications</a>
          </div>
        </li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
        <span class="icon mdi mdi-apps"></span>
      </a>
      <ul class="dropdown-menu be-connections">
        <li>
          <div class="list">
            <div class="content">
              <div class="row">
                <div class="col-xs-4">
                  <a href="#" class="connection-item">
                    <img src="/{{ \App\Helpers\AssetHelper::path() }}assets/img/github.png" alt="Github">
                    <span>GitHub</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="footer">
            <a href="#">More</a>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</div>
