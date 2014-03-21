<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="./index.html">Админка ;)</a>
      <div class="nav-collapse collapse">
        <ul class="nav">
          <li<?= Request::is('admin') ? ' class="active"' : '' ?>><a href="/admin">Home</a></li>
          <li<?= Request::is('/') ? ' class="active"' : '' ?>><a href="/admin/">Get started</a></li>
          <li<?= Request::is('/') ? ' class="active"' : '' ?>><a href="/admin/">Scaffolding</a></li>
          <li<?= Request::is('admin/config') ? ' class="active"' : '' ?>><a href="/admin/config">Конфигурация</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav pull-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white" style="opacity: 0.4; margin-right: 5px;"></i> serovvitaly@gmail.com <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Сменить пароль</a></li>
              <li class="divider"></li>
              <li><a href="#">Выход</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>