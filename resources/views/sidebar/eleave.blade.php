 <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
          <a href="{{route('eleave')}}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{route("leave")}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Leaves</p>
            </a>
        </li>

        <li class="nav-item">
          <a href="{{route("leaveapproval")}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Leave Approval</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route("leavedisapproval")}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Disapproval</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
