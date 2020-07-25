    <header class="am-topbar am-topbar-inverse admin-header">
      <div class="am-topbar-brand">
        <a href="javascript:;" class="tpl-logo">超级控制台</a>
      </div>
      <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right"></div>
      <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}">
        <span class="am-sr-only">导航切换</span>
        <span class="am-icon-bars"></span>
      </button>
      <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">

            <li class="am-dropdown">
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;" onclick="clean()" >
                    <span class="tpl-header-list-user-nick">清除缓存</span>
                </a>
            </li>
            <li class="am-dropdown">
                <a class="am-dropdown-toggle tpl-header-list-link" href="https://www.fanhaocms.com" target="_blank">
                    <span class="tpl-header-list-user-nick">官方网站</span>

                </a>
            </li>
          <li class="am-dropdown">
            <a class="am-dropdown-toggle tpl-header-list-link" href="/" target="_blank">
              <span class="tpl-header-list-user-nick">前台主页</span>
              
            </a>
          </li>
          <li>
            <a href="?err=1" class="tpl-header-list-link">
              <span class="am-icon-sign-out tpl-header-list-ico-out-size"></span>
            </a>
          </li>
        </ul>
      </div>
    </header>