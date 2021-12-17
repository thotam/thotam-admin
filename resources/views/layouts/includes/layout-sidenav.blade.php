<?php $routeName = Route::currentRouteName(); ?>
@php
    $home_hr = Auth::user()->hr;
@endphp

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
        @if ($home_hr->hasAnyRole(["super-admin", "admin", "admin-product"]))
            <li class="sidenav-item{{ strpos($routeName, 'admin.') === 0 ? ' active open' : '' }}">
                <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-users-cog d-block"></i><div>Admin</div></a>

                <ul class="sidenav-menu">
                    @if ($home_hr->hasAnyRole(["super-admin", "admin"]))
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

                    @if ($home_hr->hasAnyRole(["super-admin", "admin", "admin-product"]))
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

                    <li class="sidenav-item{{ strpos($routeName, 'mkt.kpi.') === 0 && strpos($routeName, 'mkt.kpi.ketqua.') !== 0 ? ' active open' : '' }}">
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
{{--
                            <li class="sidenav-item{{ $routeName == 'mkt.kpi.daotao' ? ' active' : '' }}">
                                <a href="{{ route('mkt.kpi.daotao') }}" class="sidenav-link"><i class="sidenav-icon fab fa-leanpub d-block"></i><div>Đào tạo</div></a>
                            </li> --}}

                            <li class="sidenav-item{{ $routeName == 'mkt.kpi.thaido' ? ' active' : '' }}">
                                <a href="{{ route('mkt.kpi.thaido') }}" class="sidenav-link"><i class="sidenav-icon fas fa-thumbs-up d-block"></i><div>Thái độ</div></a>
                            </li>


                        </ul>

                    </li>


                    <li class="sidenav-item{{ strpos($routeName, 'mkt.daotao.') === 0 ? ' active open' : '' }}">
                        <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fab fa-leanpub d-block"></i><div>Đào tạo</div></a>

                        <ul class="sidenav-menu">

                            <li class="sidenav-item{{ $routeName == 'mkt.daotao.kiemtra' ? ' active' : '' }}">
                                <a href="{{ route('mkt.daotao.kiemtra') }}" class="sidenav-link"><i class="sidenav-icon fas fa-feather-alt d-block"></i><div>Kiểm tra</div></a>
                            </li>

                            <li class="sidenav-item{{ $routeName == 'mkt.daotao.lichdaotao' ? ' active' : '' }}">
                                <a href="{{ route('mkt.daotao.lichdaotao') }}" class="sidenav-link"><i class="sidenav-icon fas fa-tasks d-block"></i><div>Lịch đào tạo</div></a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidenav-item{{ $routeName == 'mkt.rate.mkt' ? ' active' : '' }}">
                        <a href="{{ route('mkt.rate.mkt') }}" class="sidenav-link"><i class="sidenav-icon fas fa-kiss-wink-heart d-block"></i><div>Love Index</div></a>
                    </li>

                    @if ($home_hr->hasAnyRole(["super-admin"]) || $home_hr->is_mkt_quanly)
                        <li class="sidenav-item{{ $routeName == 'mkt.rate.mkt_out' ? ' active' : '' }}">
                            <a href="{{ route('mkt.rate.mkt_out') }}" class="sidenav-link"><i class="sidenav-icon fas fa-kiss-wink-heart d-block"></i><div>L.I Outcoming</div></a>
                        </li>
                    @endif

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
        @endif

        <!-- Poster -->
        <li class="sidenav-item{{ strpos($routeName, 'poster') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-images d-block"></i><div>Poster</div></a>

            <ul class="sidenav-menu">

                <!-- Poster OTC -->
                <li class="sidenav-item{{ strpos($routeName, 'poster.otc') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-map-marked-alt d-block"></i><div>Poster - OTC</div></a>

                    <ul class="sidenav-menu">

                        <li class="sidenav-item{{ $routeName == 'poster.otc.canhan' ? ' active' : '' }}">
                            <a href="{{ route('poster.otc.canhan') }}" class="sidenav-link"><i class="sidenav-icon fas fa-user d-block"></i><div>Cá nhân</div></a>
                        </li>

                        <li class="sidenav-item{{ $routeName == 'poster.otc.nhom' ? ' active' : '' }}">
                            <a href="{{ route('poster.otc.nhom') }}" class="sidenav-link"><i class="sidenav-icon fas fa-users d-block"></i><div>Nhóm</div></a>
                        </li>

                        @if ($home_hr->hasAnyPermission(["thongke-poster-otc"]) || $home_hr->is_mkt_thanhvien || $home_hr->is_mkt_quanly)
                            <li class="sidenav-item{{ $routeName == 'poster.otc.thongke' ? ' active' : '' }}">
                                <a href="{{ route('poster.otc.thongke') }}" class="sidenav-link"><i class="sidenav-icon fas fa-file-excel d-block"></i><div>Thống kê</div></a>
                            </li>
                        @endif

                        @if ($home_hr->hasAnyPermission(["edit-trathuong-poster-otc"]))
                            <li class="sidenav-item{{ $routeName == 'poster.otc.trathuong' ? ' active' : '' }}">
                                <a href="{{ route('poster.otc.trathuong') }}" class="sidenav-link"><i class="sidenav-icon fas fa-money-check-alt d-block"></i><div>Trả thưởng</div></a>
                            </li>
                        @endif

                        @if ($home_hr->hasAnyPermission(["view-thietke-poster-otc"]) || $home_hr->is_mkt_thanhvien || $home_hr->is_mkt_quanly)
                            <li class="sidenav-item{{ $routeName == 'poster.otc.doitac' ? ' active' : '' }}">
                                <a href="{{ route('poster.otc.doitac') }}" class="sidenav-link"><i class="sidenav-icon fas fa-fill-drip d-block"></i><div>Đối tác</div></a>
                            </li>
                        @endif

                        @if ($home_hr->hasAnyPermission(["view-checkanh-poster-otc", "check-checkanh-poster-otc"]) || $home_hr->is_mkt_thanhvien || $home_hr->is_mkt_quanly)
                            <li class="sidenav-item{{ strpos($routeName, 'poster.otc.checkanh') === 0 ? ' active open' : '' }}">
                                <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-images d-block"></i><div>Check Ảnh</div></a>

                                <ul class="sidenav-menu">
                                    <li class="sidenav-item{{ $routeName == 'poster.otc.checkanh.landau' ? ' active' : '' }}">
                                        <a href="{{ route('poster.otc.checkanh.landau') }}" class="sidenav-link"><i class="sidenav-icon fas fa-check-square d-block"></i><div>Lần đầu</div></a>
                                    </li>
                                    <li class="sidenav-item{{ $routeName == 'poster.otc.checkanh.dinhky' ? ' active' : '' }}">
                                        <a href="{{ route('poster.otc.checkanh.dinhky') }}" class="sidenav-link"><i class="sidenav-icon fas fa-check-double d-block"></i><div>Định kỳ</div></a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>

                <!-- Poster 3D -->
                <li class="sidenav-item{{ strpos($routeName, 'poster.3d') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fab fa-unity d-block"></i><div>Poster - 3D</div></a>

                    <ul class="sidenav-menu">

                        <li class="sidenav-item{{ $routeName == 'poster.3d.canhan' ? ' active' : '' }}">
                            <a href="{{ route('poster.3d.canhan') }}" class="sidenav-link"><i class="sidenav-icon fas fa-user d-block"></i><div>Cá nhân</div></a>
                        </li>

                        <li class="sidenav-item{{ $routeName == 'poster.3d.nhom' ? ' active' : '' }}">
                            <a href="{{ route('poster.3d.nhom') }}" class="sidenav-link"><i class="sidenav-icon fas fa-users d-block"></i><div>Nhóm</div></a>
                        </li>

                        <li class="sidenav-item{{ $routeName == 'poster.3d.bangiao' ? ' active' : '' }}">
                            <a href="{{ route('poster.3d.bangiao') }}" class="sidenav-link"><i class="sidenav-icon fas fa-dolly-flatbed d-block"></i><div>Bàn giao</div></a>
                        </li>
                    </ul>
                </li>

            </ul>
        </li>

        <!-- Hội thảo -->
        <li class="sidenav-item{{ strpos($routeName, 'hoithao.etc') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-chalkboard d-block"></i><div>Hội thảo</div></a>

            <ul class="sidenav-menu">

                <li class="sidenav-item{{ $routeName == 'hoithao.etc.canhan' ? ' active' : '' }}">
                    <a href="{{ route('hoithao.etc.canhan') }}" class="sidenav-link"><i class="sidenav-icon fas fa-user d-block"></i><div>Cá nhân</div></a>
                </li>

                <li class="sidenav-item{{ $routeName == 'hoithao.etc.nhom' ? ' active' : '' }}">
                    <a href="{{ route('hoithao.etc.nhom') }}" class="sidenav-link"><i class="sidenav-icon fas fa-users d-block"></i><div>Nhóm</div></a>
                </li>

                @if ($home_hr->hasAnyPermission(["hoithao-etc-quanly-nguoiduyet"]))
                    <li class="sidenav-item{{ $routeName == 'hoithao.etc.nguoiduyet' ? ' active' : '' }}">
                        <a href="{{ route('hoithao.etc.nguoiduyet') }}" class="sidenav-link"><i class="sidenav-icon fas fa-users d-block"></i><div>QL Người duyệt</div></a>
                    </li>
                @endif

            </ul>
        </li>

        @if ($home_hr->hasAnyPermission(["view-data-khachhang", "edit-data-khachhang", "delete-data-khachhang", "check-data-khachhang", "export-data-khachhang"]) || $home_hr->is_mkt_thanhvien || $home_hr->is_mkt_quanly)

            <!-- Data -->
            <li class="sidenav-item{{ strpos($routeName, 'data') === 0 ? ' active open' : '' }}">
                <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-database d-block"></i><div>Data</div></a>

                <ul class="sidenav-menu">

                        <!-- Khách hàng -->
                        <li class="sidenav-item{{ strpos($routeName, 'data.khachhang') === 0 ? ' active open' : '' }}">
                            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon far fa-id-card d-block"></i><div>Khách hàng</div></a>

                            <ul class="sidenav-menu">

                                <li class="sidenav-item{{ $routeName == 'data.khachhang.canhan' ? ' active' : '' }}">
                                    <a href="{{ route('data.khachhang.canhan') }}" class="sidenav-link"><i class="sidenav-icon fas fa-id-card d-block"></i><div>Cá nhân</div></a>
                                </li>

                                <li class="sidenav-item{{ $routeName == 'data.khachhang.tochuc' ? ' active' : '' }}">
                                    <a href="{{ route('data.khachhang.tochuc') }}" class="sidenav-link"><i class="sidenav-icon fas fa-sitemap d-block"></i><div>Tổ chức</div></a>
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

        <!-- Cây MKT nở hoa -->
        <li class="sidenav-item{{ $routeName == 'baocao_hd_mkt' ? ' active' : '' }}">
            <a href="{{ route('baocao_hd_mkt') }}" class="sidenav-link pr-1"><i class="sidenav-icon fas fa-chart-line d-block"></i><div>Cây MKT nở hoa</div></a>
        </li>

        <!-- Email khách hàng -->
        <li class="sidenav-item{{ $routeName == 'email_data' ? ' active' : '' }}">
            <a href="{{ route('email_data') }}" class="sidenav-link pr-1"><i class="sidenav-icon fas fa-envelope-open-text d-block"></i><div>Email khách hàng</div></a>
        </li>

        <!-- Đồng hành Sẻ chia -->
        <li class="sidenav-item{{ $routeName == 'donghanh_sechia' ? ' active' : '' }}">
            <a href="{{ route('donghanh_sechia') }}" class="sidenav-link pr-1"><i class="sidenav-icon fas fa-hand-holding-heart d-block"></i><div>Đồng hành Sẻ chia</div></a>
        </li>

        {{-- <!-- Trung thu -->
        <li class="sidenav-item{{ $routeName == 'trung_thu' ? ' active' : '' }}">
            <a href="{{ route('trung_thu') }}" class="sidenav-link pr-1 text-orange font-weight-bold"><i class="sidenav-icon fas fa-star d-block"></i><div>Trung thu</div></a>
        </li> --}}

        <!-- Tư nợ -->
        <li class="sidenav-item{{ $routeName == 'tu_no' ? ' active' : '' }}">
            <a href="{{ route('tu_no') }}" class="sidenav-link pr-1 text-danger font-weight-bold"><i class="sidenav-icon fas fa-comments-dollar d-block"></i><div>Tư nợ</div></a>
        </li>

        <!-- Khai báo Y tế -->
        <li class="sidenav-item{{ $routeName == 'khaibaoyte' ? ' active' : '' }}">
            <a href="{{ route('khaibaoyte') }}" class="sidenav-link pr-1 text-success font-weight-bold"><i class="sidenav-icon fas fa-notes-medical d-block"></i><div>Khai báo Y tế</div></a>
        </li>

        {{-- <!-- Thông tin Tiêm Vaccine -->
        <li class="sidenav-item{{ $routeName == 'tiem_vaccine' ? ' active' : '' }}">
            <a href="{{ route('tiem_vaccine') }}" class="sidenav-link pr-1 text-success font-weight-bold"><i class="sidenav-icon fas fa-syringe d-block"></i><div>Thông tin Tiêm Vaccine</div></a>
        </li> --}}


        {{-- @if (optional(optional(Auth::user())->hr)->hasAnyPermission(["view-form-tiem-pfizer", "add-form-tiem-pfizer", "edit-form-tiem-pfizer", "duyet-form-tiem-pfizer", "delete-form-tiem-pfizer"]))
        <!-- Thông tin Tiêm Vaccine Pfizer-->
            <li class="sidenav-item{{ $routeName == 'tiem_pfizer' ? ' active' : '' }}">
                <a href="{{ route('tiem_pfizer') }}" class="sidenav-link pr-1 text-success font-weight-bold"><i class="sidenav-icon fas fa-syringe d-block"></i><div>Data ĐK Tiêm Pfizer</div></a>
            </li>
        @endif --}}

        @if (optional(optional(Auth::user())->hr)->hasAnyPermission(["view-form-tiem-con-em", "add-form-tiem-con-em", "edit-form-tiem-con-em", "duyet-form-tiem-con-em", "delete-form-tiem-con-em"]))
        <!-- Thông tin Tiêm Vaccine Pfizer-->
            <li class="sidenav-item{{ $routeName == 'tiem_con_em' ? ' active' : '' }}">
                <a href="{{ route('tiem_con_em') }}" class="sidenav-link pr-1 text-success font-weight-bold"><i class="sidenav-icon fas fa-syringe d-block"></i><div>Data ĐK Tiêm cho con em</div></a>
            </li>
        @endif

        <!-- Upharma -->
        <li class="sidenav-item{{ strpos($routeName, 'upharma') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link text-success sidenav-toggle font-weight-bold"><i class="sidenav-icon fas fa-clinic-medical d-block"></i><div>Upharma</div></a>

            <ul class="sidenav-menu">

                <!-- Chăm sóc -->
                <li class="sidenav-item{{ strpos($routeName, 'upharma.chamsoc') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-hand-holding-usd d-block"></i><div>Chăm sóc</div></a>

                    <ul class="sidenav-menu">

                        <li class="sidenav-item{{ $routeName == 'upharma.chamsoc.donhang' ? ' active' : '' }}">
                            <a href="{{ route('upharma.chamsoc.donhang') }}" class="sidenav-link"><i class="sidenav-icon fas fa-shopping-cart d-block"></i><div>Đơn hàng</div></a>
                        </li>

                        <li class="sidenav-item{{ $routeName == 'upharma.chamsoc.khachhang' ? ' active' : '' }}">
                            <a href="{{ route('upharma.chamsoc.khachhang') }}" class="sidenav-link"><i class="sidenav-icon fas fa-comments d-block"></i><div>Khách hàng</div></a>
                        </li>

                    </ul>
                </li>

                <li class="sidenav-item{{ $routeName == 'upharma.khaosat' ? ' active' : '' }}">
                    <a href="{{ route('upharma.khaosat') }}" class="sidenav-link pr-1"><i class="sidenav-icon fas fa-map-marked-alt d-block"></i><div>Địa điểm</div></a>
                </li>

            </ul>
        </li>

        {{--  <!-- DTP -->
        <li class="sidenav-item{{ $routeName == 'up_com' ? ' active' : '' }}">
            <a href="{{ route('up_com') }}" class="sidenav-link pr-1 text-danger font-weight-bold"><i class="sidenav-icon fab fa-bitcoin d-block"></i><div>DTP</div></a>
        </li>  --}}

        <!-- Review -->
        <li class="sidenav-item{{ $routeName == 'review' ? ' active' : '' }}">
            <a href="{{ route('review') }}" class="sidenav-link pr-1 font-weight-bold"><i class="sidenav-icon fas fa-rss-square d-block"></i><div>Review</div></a>
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
