<?php $routeName = Route::currentRouteName(); ?>

<div id="layout-sidenav" class="{{ isset($layout_sidenav_horizontal) ? 'layout-sidenav-horizontal sidenav-horizontal container-p-x flex-grow-0' : 'layout-sidenav sidenav-vertical' }} sidenav bg-dark">

    @empty($layout_sidenav_horizontal)
    <!-- Brand demo (see assets/css/demo/demo.css) -->
    <div class="app-brand demo">
        <span class="app-brand-logo demo bg-white">
            @include('layouts.includes.sub.logo')
        </span>
        <span class="app-brand-text demo sidenav-text font-weight-normal ml-2">CPC1 Hà Nội</span>
        <a href="javascript:void(0)" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
            <i class="ion ion-md-menu align-middle"></i>
        </a>
    </div>

    <div class="sidenav-divider mt-0"></div>
    @endempty

    <!-- Inner -->
    <ul class="sidenav-inner{{ empty($layout_sidenav_horizontal) ? ' py-1' : '' }}">

        <li class="sidenav-item{{ Request::is('/') ? ' active' : '' }}">
            <a href="{{ route('home') }}" class="sidenav-link"><i class="sidenav-icon fas fa-home d-block"></i><div>Trang chủ</div></a>
        </li>

        <!-- Admin -->
        @if (Auth::user()->hr->hasAnyRole(["super-admin", "admin"]))
            <li class="sidenav-item{{ strpos($routeName, 'admin.') === 0 ? ' active open' : '' }}">
                <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-users-cog d-block"></i><div>Admin</div></a>

                <ul class="sidenav-menu">

                        <li class="sidenav-item{{ strpos($routeName, 'admin.member.') === 0 ? ' active open' : '' }}">
                            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-user-friends d-block"></i><div>Thành viên</div></a>

                            <ul class="sidenav-menu">

                                <li class="sidenav-item{{ $routeName == 'admin.member.user' ? ' active' : '' }}">
                                    <a href="{{ route('admin.member.user') }}" class="sidenav-link"><i class="sidenav-icon far fa-user-circle d-block"></i><div>Tài khoản</div></a>
                                </li>

                                <li class="sidenav-item{{ $routeName == 'admin.member.hr' ? ' active' : '' }}">
                                    <a href="{{ route('admin.member.hr') }}" class="sidenav-link"><i class="sidenav-icon fas fa-user-lock d-block"></i><div>Nhân sự</div></a>
                                </li>

                                <li class="sidenav-item{{ $routeName == 'admin.member.team' ? ' active' : '' }}">
                                    <a href="{{ route('admin.member.team') }}" class="sidenav-link"><i class="sidenav-icon fas fa-users d-block"></i><div>Nhóm</div></a>
                                </li>

                            </ul>

                        </li>

                        <li class="sidenav-item{{ strpos($routeName, 'admin.permission.') === 0 ? ' active open' : '' }}">
                            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-users-cog d-block"></i><div>Phân quyền</div></a>

                            <ul class="sidenav-menu">

                                <li class="sidenav-item{{ $routeName == 'admin.permission.permission' ? ' active' : '' }}">
                                    <a href="{{ route('admin.permission.permission') }}" class="sidenav-link"><i class="sidenav-icon fas fa-user-cog d-block"></i><div>Permission</div></a>
                                </li>

                                <li class="sidenav-item{{ $routeName == 'admin.permission.role' ? ' active' : '' }}">
                                    <a href="{{ route('admin.permission.role') }}" class="sidenav-link"><i class="sidenav-icon fas fas fa-user-tag d-block"></i><div>Role</div></a>
                                </li>
                            </ul>
                        </li>

                </ul>
            </li>
        @endif

        <!-- Buddy -->
        <li class="sidenav-item{{ strpos($routeName, 'buddy.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-user-friends d-block"></i><div>Buddy</div></a>

            <ul class="sidenav-menu">

                <li class="sidenav-item{{ $routeName == 'buddy.canhan' ? ' active' : '' }}">
                    <a href="{{ route('buddy.canhan') }}" class="sidenav-link"><i class="sidenav-icon fas fa-user d-block"></i><div>Cá nhân</div></a>
                </li>

                <li class="sidenav-item{{ $routeName == 'buddy.nhom' ? ' active' : '' }}">
                    <a href="{{ route('buddy.nhom') }}" class="sidenav-link"><i class="sidenav-icon fas fas fa-users d-block"></i><div>Nhóm</div></a>
                </li>
            </ul>
        </li>

        @if (optional(optional(Auth::user())->hr)->is_mkt_thanhvien || optional(optional(Auth::user())->hr)->is_mkt_quanly || optional(optional(Auth::user())->hr)->hasAnyRole(["super-admin", "admin-mkt"]))
            <!-- TT-MKT -->
            <li class="sidenav-item{{ strpos($routeName, 'mkt.') === 0 ? ' active open' : '' }}">
                <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-bullseye d-block"></i><div>TT-MKT</div></a>

                <ul class="sidenav-menu">

                    <li class="sidenav-item{{ $routeName == 'mkt.nhom' ? ' active' : '' }}">
                        <a href="{{ route('mkt.nhom') }}" class="sidenav-link"><i class="sidenav-icon fas fa-users d-block"></i><div>Nhóm</div></a>
                    </li>

                    <li class="sidenav-item{{ strpos($routeName, 'mkt.congviec.') === 0 ? ' active open' : '' }}">
                        <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-cogs d-block"></i><div>Công việc</div></a>

                        <ul class="sidenav-menu">

                            <li class="sidenav-item{{ $routeName == 'mkt.congviec.yeucau' ? ' active' : '' }}">
                                <a href="{{ route('mkt.congviec.yeucau') }}" class="sidenav-link"><i class="sidenav-icon fab fa-elementor d-block"></i><div>Yêu cầu</div></a>
                            </li>

                            <li class="sidenav-item{{ $routeName == 'mkt.congviec.phancong' ? ' active' : '' }}">
                                <a href="{{ route('mkt.congviec.phancong') }}" class="sidenav-link"><i class="sidenav-icon fas fa-tasks d-block"></i><div>Phân công</div></a>
                            </li>

                            <li class="sidenav-item{{ $routeName == 'mkt.congviec.baocao' ? ' active' : '' }}">
                                <a href="{{ route('mkt.congviec.baocao') }}" class="sidenav-link"><i class="sidenav-icon fas fa-file-upload d-block"></i><div>Báo cáo</div></a>
                            </li>

                            <li class="sidenav-item{{ $routeName == 'mkt.congviec.danhgia' ? ' active' : '' }}">
                                <a href="{{ route('mkt.congviec.danhgia') }}" class="sidenav-link"><i class="sidenav-icon far fa-check-square d-block"></i><div>Đánh giá</div></a>
                            </li>

                        </ul>

                    </li>

                    @if (optional(optional(Auth::user())->hr)->is_mkt_mentor || optional(optional(Auth::user())->hr)->hasAnyRole(["super-admin", "admin-mkt"]))
                        <li class="sidenav-item{{ strpos($routeName, 'mkt.mentor.nhatky.') === 0 ? ' active open' : '' }}">
                            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-book d-block"></i><div>Nhật ký</div></a>

                            <ul class="sidenav-menu">

                                <li class="sidenav-item{{ $routeName == 'mkt.mentor.nhatky.baocao' ? ' active' : '' }}">
                                    <a href="{{ route('mkt.mentor.nhatky.baocao') }}" class="sidenav-link"><i class="sidenav-icon fas fa-file-upload d-block"></i><div>Báo cáo</div></a>
                                </li>

                                <li class="sidenav-item{{ $routeName == 'mkt.mentor.nhatky.danhgia' ? ' active' : '' }}">
                                    <a href="{{ route('mkt.mentor.nhatky.danhgia') }}" class="sidenav-link"><i class="sidenav-icon fas fa-check-square d-block"></i><div>Đánh giá</div></a>
                                </li>

                            </ul>

                        </li>
                    @endif

                </ul>
            </li>
        @endif

    </ul>
</div>
