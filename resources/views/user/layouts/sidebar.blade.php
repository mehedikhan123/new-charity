<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('user.dashboard') }}">User Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('user.dashboard') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('user/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.dashboard') }}"><i class="fas fa-hand-point-right"></i> <span>Dashboard</span></a></li>

            <li class="{{ Request::is('user/program/ticket*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.program.ticket') }}"><i class="fas fa-hand-point-right"></i> <span>Program Tickets</span></a></li>

            <li class="{{ Request::is('user/cause/donation*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.cause.donation') }}"><i class="fas fa-hand-point-right"></i> <span>Cause Donations</span></a></li>

            {{-- <li class="nav-item dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Dropdown Items</span></a>
                <ul class="dropdown-menu">
                    <li class="active"><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Item 1</a></li>
                    <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Item 2</a></li>
                </ul>
            </li> --}}

            {{-- <li class=""><a class="nav-link" href="setting.html"><i class="fas fa-hand-point-right"></i> <span>Setting</span></a></li>

            <li class=""><a class="nav-link" href="form.html"><i class="fas fa-hand-point-right"></i> <span>Form</span></a></li>

            <li class=""><a class="nav-link" href="table.html"><i class="fas fa-hand-point-right"></i> <span>Table</span></a></li>

            <li class=""><a class="nav-link" href="invoice.html"><i class="fas fa-hand-point-right"></i> <span>Invoice</span></a></li> --}}

        </ul>
    </aside>
</div>
