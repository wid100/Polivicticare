<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <img class="w-50" src="{{ asset('assets/images/logo.png') }}" alt="">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.doner.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Doners</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.categorys.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Category</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.organization.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Organization</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.foundcategory.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Found Category</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.foundrequest.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">All Found Request</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.upazilla.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Upazillas</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.pourashava.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Pourashavas</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.ward.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Ward</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
