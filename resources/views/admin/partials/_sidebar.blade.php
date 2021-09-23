<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            @can('view_dashboard')
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" key="t-menu">Menu</li>
                    <li>
                        <a href="{{ route('admin.dashboard.index') }}" class="waves-effect">
                            <i class="bx bx-home-circle"></i>
                            <span key="t-calendar">Dashboard</span>
                        </a>
                    </li>
                </ul>
            @endcan

            <ul class="metismenu list-unstyled">
                <li class="menu-title" key="t-apps">Módulos</li>

                @foreach(config('admin.modules') as $module)
                    @can($module['permission'])
                        <li>
                            <a href="{{ route('admin.' . $module['path'] . '.index') }}" class="waves-effect">
                                <i class="bx {{ $module['icon'] }}"></i>
                                <span key="t-bla">{{$module['name']}}</span>
                            </a>
                        </li>
                    @endcan
                @endforeach
            </ul>


            <ul class="metismenu list-unstyled">
                <li class="menu-title" key="t-apps">Extras</li>

                @can('view_users')
                    <li>
                        <a href="#" class="waves-effect">
                            <i class="bx bx-user"></i>
                            <span key="t-bla">Usuários</span>
                        </a>
                    </li>
                @endcan

                @can('view_roles')
                    <li>
                        <a href="{{ route('admin.roles.index') }}" class="waves-effect">
                            <i class="bx bx bx-group"></i>
                            <span key="t-bla">Grupos</span>
                        </a>
                    </li>
                @endcan

                @can('view_permissions')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}" class="waves-effect">
                            <i class="bx bx bx-check"></i>
                            <span key="t-bla">Permissões</span>
                        </a>
                    </li>
                @endcan

                @can('view_audits')
                    <li>
                        <a href="{{ route('admin.audits.index') }}" class="waves-effect">
                            <i class="bx bx-bullseye"></i>
                            <span key="t-bla">Auditoria</span>
                        </a>
                    </li>
                @endcan

                @can('view_settings')
                    <li>
                        <a href="{{ route('admin.settings.index') }}" class="waves-effect">
                            <i class="bx bx-cog"></i>
                            <span key="t-bla">Configurações</span>
                        </a>
                    </li>
                @endcan

                @can('view_analytics')
                    <li>
                        <a href="{{ route('admin.analytics.index') }}" class="waves-effect">
                            <i class="bx bx-line-chart"></i>
                            <span key="t-bla">Acessos</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
