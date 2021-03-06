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
        @if (Auth::user()->hr->hasAnyRole(["super-admin", "admin", "admin-product"]))
            <li class="sidenav-item{{ strpos($routeName, 'admin.') === 0 ? ' active open' : '' }}">
                <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-users-cog d-block"></i><div>Admin</div></a>

                <ul class="sidenav-menu">
                    @if (Auth::user()->hr->hasAnyRole(["super-admin", "admin"]))
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
                    @endif

                    @if (Auth::user()->hr->hasAnyRole(["super-admin", "admin", "admin-product"]))
                        <!-- Admin Sản phẩm -->
                        <li class="sidenav-item{{ $routeName == 'admin.product' ? ' active' : '' }}">
                            <a href="{{ route('admin.product') }}" class="sidenav-link pr-1"><i class="sidenav-icon fab fa-product-hunt d-block"></i><div>Sản phẩm</div></a>
                        </li>
                    @endif

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

                    @if (optional(optional(Auth::user())->hr)->is_mkt_quanly || optional(optional(Auth::user())->hr)->hasAnyRole(["super-admin"]))
                        <li class="sidenav-item{{ strpos($routeName, 'mkt.quanly.') === 0 ? ' active open' : '' }}">
                            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-users-cog d-block"></i><div>Quản lý</div></a>

                            <ul class="sidenav-menu">

                                <li class="sidenav-item{{ $routeName == 'mkt.quanly.canhan' ? ' active' : '' }}">
                                    <a href="{{ route('mkt.quanly.canhan') }}" class="sidenav-link"><i class="sidenav-icon fas fa-user d-block"></i><div>Cá nhân</div></a>
                                </li>

                                <li class="sidenav-item{{ $routeName == 'mkt.quanly.nhom' ? ' active' : '' }}">
                                    <a href="{{ route('mkt.quanly.nhom') }}" class="sidenav-link"><i class="sidenav-icon fas fa-users d-block"></i><div>Nhóm</div></a>
                                </li>

                            </ul>

                        </li>
                    @endif

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

                    @if (optional(optional(Auth::user())->hr)->is_mkt_mentor || optional(optional(Auth::user())->hr)->is_mkt_quanly || optional(optional(Auth::user())->hr)->hasAnyRole(["super-admin", "admin-mkt"]))
                        <li class="sidenav-item{{ strpos($routeName, 'mkt.mentor.nhatky.') === 0 ? ' active open' : '' }}">
                            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-book d-block"></i><div>Nhật ký</div></a>

                            <ul class="sidenav-menu">

                                <li class="sidenav-item{{ $routeName == 'mkt.mentor.nhatky.baocao' ? ' active' : '' }}">
                                    <a href="{{ route('mkt.mentor.nhatky.baocao') }}" class="sidenav-link"><i class="sidenav-icon fas fa-file-upload d-block"></i><div>Báo cáo</div></a>
                                </li>

                                <li class="sidenav-item{{ $routeName == 'mkt.mentor.nhatky.danhgia' ? ' active' : '' }}">
                                    <a href="{{ route('mkt.mentor.nhatky.danhgia') }}" class="sidenav-link"><i class="sidenav-icon fas fa-check-square d-block"></i><div>Đánh giá</div></a>
                                </li>

                                <li class="sidenav-item{{ $routeName == 'mkt.mentor.nhatky.thongke' ? ' active' : '' }}">
                                    <a href="{{ route('mkt.mentor.nhatky.thongke') }}" class="sidenav-link"><i class="sidenav-icon fas fa-signal d-block" style=" font-size: 0.8rem; "></i><div>Thống kê</div></a>
                                </li>

                                <li class="sidenav-item{{ $routeName == 'mkt.mentor.nhatky.tonghop' ? ' active' : '' }}">
                                    <a href="{{ route('mkt.mentor.nhatky.tonghop') }}" class="sidenav-link"><i class="sidenav-icon fas fa-border-all d-block"></i><div>Tổng hợp</div></a>
                                </li>

                            </ul>

                        </li>
                    @endif

                    <li class="sidenav-item{{ strpos($routeName, 'mkt.kpi.') === 0 ? ' active open' : '' }}">
                        <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-medal d-block"></i><div>OKR-KPI</div></a>

                        <ul class="sidenav-menu">


                            <li class="sidenav-item{{ $routeName == 'mkt.kpi.dinhnghia' ? ' active' : '' }}">
                                <a href="{{ route('mkt.kpi.dinhnghia') }}" class="sidenav-link"><i class="sidenav-icon fas fa-receipt d-block"></i><div>Định nghĩa</div></a>
                            </li>

                            <li class="sidenav-item{{ strpos($routeName, 'mkt.kpi.okr.') === 0 ? ' active open' : '' }}">
                                <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon far fa-dot-circle d-block"></i><div>OKR</div></a>

                                <ul class="sidenav-menu">

                                    <li class="sidenav-item{{ $routeName == 'mkt.kpi.okr.canhan' ? ' active' : '' }}">
                                        <a href="{{ route('mkt.kpi.okr.canhan') }}" class="sidenav-link"><i class="sidenav-icon fas fa-user d-block"></i><div>Cá nhân</div></a>
                                    </li>

                                    <li class="sidenav-item{{ $routeName == 'mkt.kpi.okr.nhom' ? ' active' : '' }}">
                                        <a href="{{ route('mkt.kpi.okr.nhom') }}" class="sidenav-link"><i class="sidenav-icon fas fa-users d-block"></i><div>Nhóm</div></a>
                                    </li>

                                </ul>
                            </li>

                            <li class="sidenav-item{{ $routeName == 'mkt.kpi.giaonhan' ? ' active' : '' }}">
                                <a href="{{ route('mkt.kpi.giaonhan') }}" class="sidenav-link"><i class="sidenav-icon fas fa-exchange-alt d-block"></i><div>Giao - Nhận</div></a>
                            </li>

                            <li class="sidenav-item{{ $routeName == 'mkt.kpi.baocao' ? ' active' : '' }}">
                                <a href="{{ route('mkt.kpi.baocao') }}" class="sidenav-link"><i class="sidenav-icon fas fa-file-upload d-block"></i><div>Báo cáo</div></a>
                            </li>

                            <li class="sidenav-item{{ $routeName == 'mkt.kpi.danhgia' ? ' active' : '' }}">
                                <a href="{{ route('mkt.kpi.danhgia') }}" class="sidenav-link"><i class="sidenav-icon fas fa-check-square d-block"></i><div>Đánh giá</div></a>
                            </li>

                            <li class="sidenav-item{{ $routeName == 'mkt.kpi.bangvang' ? ' active' : '' }}">
                                <a href="{{ route('mkt.kpi.bangvang') }}" class="sidenav-link text-warning"><i class="sidenav-icon fas fa-crown d-block"></i><div>Bảng vàng</div></a>
                            </li>

                            <li class="sidenav-item{{ $routeName == 'mkt.kpi.daotao' ? ' active' : '' }}">
                                <a href="{{ route('mkt.kpi.daotao') }}" class="sidenav-link"><i class="sidenav-icon fab fa-leanpub d-block"></i><div>Đào tạo</div></a>
                            </li>

                            <li class="sidenav-item{{ $routeName == 'mkt.kpi.thaido' ? ' active' : '' }}">
                                <a href="{{ route('mkt.kpi.thaido') }}" class="sidenav-link"><i class="sidenav-icon fas fa-thumbs-up d-block"></i><div>Thái độ</div></a>
                            </li>

                            <li class="sidenav-item{{ strpos($routeName, 'mkt.kpi.ketqua.') === 0 ? ' active open' : '' }}">
                                <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-poll d-block"></i><div>Kết quả</div></a>

                                <ul class="sidenav-menu">

                                    <li class="sidenav-item{{ $routeName == 'mkt.kpi.ketqua.canhan' ? ' active' : '' }}">
                                        <a href="{{ route('mkt.kpi.ketqua.canhan') }}" class="sidenav-link"><i class="sidenav-icon fas fa-user d-block"></i><div>Cá nhân</div></a>
                                    </li>

                                    <li class="sidenav-item{{ $routeName == 'mkt.kpi.ketqua.nhom' ? ' active' : '' }}">
                                        <a href="{{ route('mkt.kpi.ketqua.nhom') }}" class="sidenav-link"><i class="sidenav-icon fas fa-users d-block"></i><div>Nhóm</div></a>
                                    </li>

                                </ul>
                            </li>

                        </ul>

                    </li>

                </ul>
            </li>
        @endif

        <!-- Bỉm sữa -->
        <li class="sidenav-item{{ strpos($routeName, 'bimsua') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-baby-carriage d-block"></i><div>Bỉm sữa</div></a>

            <ul class="sidenav-menu">

                <li class="sidenav-item{{ $routeName == 'bimsua.dangky' ? ' active' : '' }}">
                    <a href="{{ route('bimsua.dangky') }}" class="sidenav-link"><i class="sidenav-icon fas fa-cart-plus d-block"></i><div>Đăng ký</div></a>
                </li>

                <li class="sidenav-item{{ $routeName == 'bimsua.baocao' ? ' active' : '' }}">
                    <a href="{{ route('bimsua.baocao') }}" class="sidenav-link"><i class="sidenav-icon fas fa-file-upload d-block"></i><div>Báo cáo</div></a>
                </li>

                @if (optional(optional(Auth::user())->hr)->hasAnyPermission(["bimsua-turn", "bimsua-bim"]))
                    <!-- Quản lý -->
                    <li class="sidenav-item{{ strpos($routeName, 'bimsua.quanly') === 0 ? ' active open' : '' }}">
                        <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-cogs d-block"></i><div>Quản lý</div></a>

                        <ul class="sidenav-menu">

                            @if (optional(optional(Auth::user())->hr)->hasAnyPermission(["bimsua-turn"]))
                                <li class="sidenav-item{{ $routeName == 'bimsua.quanly.turn' ? ' active' : '' }}">
                                    <a href="{{ route('bimsua.quanly.turn') }}" class="sidenav-link"><i class="sidenav-icon fas fa-sliders-h d-block"></i><div>Đợt đăng ký</div></a>
                                </li>
                            @endif

                            @if (optional(optional(Auth::user())->hr)->hasAnyPermission(["bimsua-bim"]))
                                <li class="sidenav-item{{ $routeName == 'bimsua.quanly.bim' ? ' active' : '' }}">
                                    <a href="{{ route('bimsua.quanly.bim') }}" class="sidenav-link"><i class="sidenav-icon fas fa-baby d-block"></i><div>Tên bỉm</div></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

            </ul>
        </li>

        <!-- Đồng hành Sẻ chia -->
        <li class="sidenav-item{{ $routeName == 'donghanh_sechia' ? ' active' : '' }}">
            <a href="{{ route('donghanh_sechia') }}" class="sidenav-link pr-1"><i class="sidenav-icon fas fa-hand-holding-heart d-block"></i><div>Đồng hành Sẻ chia</div></a>
        </li>

        <!-- Khai báo Y tế -->
        <li class="sidenav-item{{ $routeName == 'khaibaoyte' ? ' active' : '' }}">
            <a href="{{ route('khaibaoyte') }}" class="sidenav-link pr-1 text-success font-weight-bold"><i class="sidenav-icon fas fa-notes-medical d-block"></i><div>Khai báo Y tế</div></a>
        </li>

        <!-- Báo cáo -->
        <li class="sidenav-item{{ strpos($routeName, 'baocao.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-file-signature d-block"></i><div>Báo cáo</div></a>

            <ul class="sidenav-menu">

                <!-- Định kỳ -->
                <li class="sidenav-item{{ strpos($routeName, 'baocao.dinhky') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon far fa-calendar-alt d-block"></i><div>Định kỳ</div></a>

                    <ul class="sidenav-menu">

                        <li class="sidenav-item{{ $routeName == 'baocao.dinhky.canhan' ? ' active' : '' }}">
                            <a href="{{ route('baocao.dinhky.canhan') }}" class="sidenav-link"><i class="sidenav-icon fas fa-user d-block"></i><div>Cá nhân</div></a>
                        </li>

                        <li class="sidenav-item{{ $routeName == 'baocao.dinhky.nhom' ? ' active' : '' }}">
                            <a href="{{ route('baocao.dinhky.nhom') }}" class="sidenav-link"><i class="sidenav-icon fas fa-users d-block"></i><div>Nhóm</div></a>
                        </li>

                    </ul>
                </li>

                <!-- Bài đăng sản phẩm -->
                <li class="sidenav-item{{ $routeName == 'baocao.baidang_sanpham' ? ' active' : '' }}">
                    <a href="{{ route('baocao.baidang_sanpham') }}" class="sidenav-link pr-1"><i class="sidenav-icon fab fa-product-hunt d-block"></i><div>Bài đăng sản phẩm</div></a>
                </li>

                <!-- Lan tỏa nhân viên mới -->
                <li class="sidenav-item{{ $routeName == 'baocao.lantoa' ? ' active' : '' }}">
                    <a href="{{ route('baocao.lantoa') }}" class="sidenav-link"><i class="sidenav-icon fab fa-facebook-square d-block"></i><div>Lan tỏa - NV mới</div></a>
                </li>

                <!-- Bài đăng tuyển dụng -->
                <li class="sidenav-item{{ $routeName == 'baocao.tuyendung' ? ' active' : '' }}">
                    <a href="{{ route('baocao.tuyendung') }}" class="sidenav-link pr-1"><i class="sidenav-icon fab fa-facebook-square d-block"></i><div>Bài đăng tuyển dụng</div></a>
                </li>

                <!-- Mười ngón -->
                <li class="sidenav-item{{ $routeName == 'baocao.muoingon' ? ' active' : '' }}">
                    <a href="{{ route('baocao.muoingon') }}" class="sidenav-link"><i class="sidenav-icon fas fa-keyboard d-block"></i><div>Mười ngón</div></a>
                </li>

            </ul>
        </li>

    </ul>
</div>
