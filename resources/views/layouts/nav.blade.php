<nav class="navbar navbar-expand-md border justify-content-between">
    <div class="navbar-brand" href="/dashboard/home">
        <img src="https://upload.wikimedia.org/wikipedia/commons/3/39/Leaf_icon_15.svg" width="30" height="30"
            class="d-inline-block align-top" alt="">
        <span class="menu-collapsed">Green Up</span>
    </div>
    <div>
        <ul class="navbar-nav ml-auto custom-navbar">
            <li class="nav-item{{ $activePage == 'Tips' ? ' selected' : '' }}">
                <a class="nav-link text-dark" href="dashboard/tips">Tips</a>
            </li>
            <li class="nav-item{{ $activePage == 'Quests' ? ' selected' : '' }}">
                <a class="nav-link text-dark" href="dashboard/quest">Quest</a>
            </li>
            <li class="nav-item{{ $activePage == 'Stats' ? ' selected' : '' }}">
                <a class="nav-link text-dark" href="dashboard/stats">Stats</a>
            </li>
            <li class="nav-item{{ $activePage == 'Users' ? ' selected' : '' }}">
                <a class="nav-link text-dark" href="dashboard/stats">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="/dashboard/logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>