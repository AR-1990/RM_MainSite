<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('admin.index') }}"> <img alt="image" src="{{ url('assets-admin/img/logo.png') }}" class="header-logo" /> <span
          class="logo-name">Otika</span>
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Main</li>
      <li class="dropdown active">
        <a href="{{ route('admin.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Property</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.property.add') }}">Add Property</a></li>
          <li><a class="nav-link" href="{{ route('admin.property.table') }}">Property Table</a></li>
          <!-- <li><a class="nav-link" href="forms-editor">Editor</a></li>
          <li><a class="nav-link" href="forms-validation">Validation</a></li>
          <li><a class="nav-link" href="form-wizard">Form Wizard</a></li> -->
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="edit"></i><span>Blog Management</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.blogs.index') }}">All Blogs</a></li>
          <li><a class="nav-link" href="{{ route('admin.blogs.create') }}">Create Blog</a></li>
          <li><a class="nav-link" href="{{ route('admin.blog-categories.index') }}">Blog Categories</a></li>
          <li><a class="nav-link" href="{{ route('admin.blog-categories.create') }}">Add Category</a></li>
        </ul>
      </li>
      
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Lead Management</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.leads.index') }}">All Leads</a></li>
          <li><a class="nav-link" href="{{ route('admin.leads.create') }}">Create Lead</a></li>
          <li><a class="nav-link" href="{{ route('admin.contacts.index') }}">Contact Inquiries</a></li>
        </ul>
      </li>
      
                  <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="mail"></i><span>Newsletter</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.subscriptions.index') }}">All Subscriptions</a></li>
                <li><a class="nav-link" href="{{ route('admin.subscriptions.create') }}">Add Subscription</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>News</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.news.index') }}">All News</a></li>
                <li><a class="nav-link" href="{{ route('admin.news.create') }}">Add News</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="home"></i><span>Projects</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.projects.index') }}">All Projects</a></li>
                <li><a class="nav-link" href="{{ route('admin.projects.create') }}">Add Project</a></li>
                <li><a class="nav-link" href="{{ route('admin.project-categories.index') }}">Project Categories</a></li>
                <li><a class="nav-link" href="{{ route('admin.project-categories.create') }}">Add Project Category</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Team Management</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.team.index') }}">All Team Members</a></li>
                <li><a class="nav-link" href="{{ route('admin.team.create') }}">Add Team Member</a></li>
                
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>User Management</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.users.index') }}">All Users</a></li>
                <li><a class="nav-link" href="{{ route('admin.users.create') }}">Add User</a></li>
                <li><a class="nav-link" href="{{ route('admin.users.export') }}">Export Users</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="clock"></i><span>Attendance Management</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.attendance.index') }}">All Records</a></li>
                <li><a class="nav-link" href="{{ route('admin.attendance.create') }}">Add Record</a></li>
                <li><a class="nav-link" href="{{ route('admin.attendance.enhanced-stats') }}">Employee Statistics</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="check-square"></i><span>Workload Management</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.workload.index') }}">All Tasks</a></li>
                <li><a class="nav-link" href="{{ route('admin.workload.create') }}">Create Task</a></li>
                <li><a class="nav-link" href="{{ route('admin.workload.audit-logs') }}">Audit Logs</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="dollar-sign"></i><span>Accounts</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.accounts.dashboard') }}">Overview</a></li>
                <li><a class="nav-link" href="{{ route('admin.accounts.salaries.index') }}">Salaries</a></li>
                <li><a class="nav-link" href="{{ route('admin.accounts.advances.index') }}">Salary Advances</a></li>
                <li><a class="nav-link" href="{{ route('admin.accounts.advances.index') }}">Loans</a></li>
                <li><a class="nav-link" href="{{ route('admin.accounts.expenses.index') }}">Expenses</a></li>
                <li><a class="nav-link" href="{{ route('admin.accounts.categories.index') }}">Expense Categories</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="archive"></i><span>Reports &amp; Backups</span></a>
              <ul class="dropdown-menu">
                   <li><a class="nav-link" href="{{ route('admin.backups.index') }}">File Backups</a></li>
                 </ul>
            </li>
      <!-- // ... existing code ...
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i
            data-feather="briefcase"></i><span>Widgets</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="widget-chart">Chart Widgets</a></li>
          <li><a class="nav-link" href="widget-data">Data Widgets</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Apps</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="chat">Chat</a></li>
          <li><a class="nav-link" href="portfolio">Portfolio</a></li>
          <li><a class="nav-link" href="blog">Blog</a></li>
          <li><a class="nav-link" href="calendar">Calendar</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="mail"></i><span>Email</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="email-inbox">Inbox</a></li>
          <li><a class="nav-link" href="email-compose">Compose</a></li>
          <li><a class="nav-link" href="email-read">Read</a></li>
        </ul>
      </li>
      <li class="menu-header">UI Elements</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Basic Components</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="alert">Alert</a></li>
          <li><a class="nav-link" href="badge">Badge</a></li>
          <li><a class="nav-link" href="breadcrumb">Breadcrumb</a></li>
          <li><a class="nav-link" href="buttons">Buttons</a></li>
          <li><a class="nav-link" href="collapse">Collapse</a></li>
          <li><a class="nav-link" href="dropdown">Dropdown</a></li>
          <li><a class="nav-link" href="checkbox-and-radio">Checkbox &amp; Radios</a></li>
          <li><a class="nav-link" href="list-group">List Group</a></li>
          <li><a class="nav-link" href="media-object">Media Object</a></li>
          <li><a class="nav-link" href="navbar">Navbar</a></li>
          <li><a class="nav-link" href="pagination">Pagination</a></li>
          <li><a class="nav-link" href="popover">Popover</a></li>
          <li><a class="nav-link" href="progress">Progress</a></li>
          <li><a class="nav-link" href="tooltip">Tooltip</a></li>
          <li><a class="nav-link" href="flags">Flag</a></li>
          <li><a class="nav-link" href="typography">Typography</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i
            data-feather="shopping-bag"></i><span>Advanced</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="avatar">Avatar</a></li>
          <li><a class="nav-link" href="card">Card</a></li>
          <li><a class="nav-link" href="modal">Modal</a></li>
          <li><a class="nav-link" href="sweet-alert">Sweet Alert</a></li>
          <li><a class="nav-link" href="toastr">Toastr</a></li>
          <li><a class="nav-link" href="empty-state">Empty State</a></li>
          <li><a class="nav-link" href="multiple-upload">Multiple Upload</a></li>
          <li><a class="nav-link" href="pricing">Pricing</a></li>
          <li><a class="nav-link" href="tabs">Tab</a></li>
        </ul>
      </li>
      <li><a class="nav-link" href="blank"><i data-feather="file"></i><span>Blank Page</span></a></li>
      <li class="menu-header">Otika</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Forms</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="basic-form">Basic Form</a></li>
          <li><a class="nav-link" href="forms-advanced-form">Advanced Form</a></li>
          <li><a class="nav-link" href="forms-editor">Editor</a></li>
          <li><a class="nav-link" href="forms-validation">Validation</a></li>
          <li><a class="nav-link" href="form-wizard">Form Wizard</a></li>
        </ul>
      </li> -->
      <!-- <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="grid"></i><span>Tables</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="basic-table">Basic Tables</a></li>
          <li><a class="nav-link" href="advance-table">Advanced Table</a></li>
          <li><a class="nav-link" href="datatables">Datatable</a></li>
          <li><a class="nav-link" href="export-table">Export Table</a></li>
          <li><a class="nav-link" href="editable-table">Editable Table</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i
            data-feather="pie-chart"></i><span>Charts</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="chart-amchart">amChart</a></li>
          <li><a class="nav-link" href="chart-apexchart">apexchart</a></li>
          <li><a class="nav-link" href="chart-echart">eChart</a></li>
          <li><a class="nav-link" href="chart-chartjs">Chartjs</a></li>
          <li><a class="nav-link" href="chart-sparkline">Sparkline</a></li>
          <li><a class="nav-link" href="chart-morris">Morris</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="feather"></i><span>Icons</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="icon-font-awesome">Font Awesome</a></li>
          <li><a class="nav-link" href="icon-material">Material Design</a></li>
          <li><a class="nav-link" href="icon-ionicons">Ion Icons</a></li>
          <li><a class="nav-link" href="icon-feather">Feather Icons</a></li>
          <li><a class="nav-link" href="icon-weather-icon">Weather Icon</a></li>
        </ul>
      </li>
      <li class="menu-header">Media</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="image"></i><span>Gallery</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="light-gallery">Light Gallery</a></li>
          <li><a href="gallery1">Gallery 2</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="flag"></i><span>Sliders</span></a>
        <ul class="dropdown-menu">
          <li><a href="carousel">Bootstrap Carousel</a></li>
          <li><a class="nav-link" href="owl-carousel">Owl Carousel</a></li>
        </ul>
      </li>
      <li><a class="nav-link" href="timeline"><i data-feather="sliders"></i><span>Timeline</span></a></li>
      <li class="menu-header">Maps</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Google Maps</span></a>
        <ul class="dropdown-menu">
          <li><a href="gmaps-advanced-route">Advanced Route</a></li>
          <li><a href="gmaps-draggable-marker">Draggable Marker</a></li>
          <li><a href="gmaps-geocoding">Geocoding</a></li>
          <li><a href="gmaps-geolocation">Geolocation</a></li>
          <li><a href="gmaps-marker">Marker</a></li>
          <li><a href="gmaps-multiple-marker">Multiple Marker</a></li>
          <li><a href="gmaps-route">Route</a></li>
          <li><a href="gmaps-simple">Simple</a></li>
        </ul>
      </li> -->
      <!-- <li><a class="nav-link" href="vector-map"><i data-feather="map-pin"></i><span>Vector Map</span></a></li>
      <li class="menu-header">Pages</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i
            data-feather="user-check"></i><span>Auth</span></a>
        <ul class="dropdown-menu">
          <li><a href="auth-login">Login</a></li>
          <li><a href="auth-register">Register</a></li>
          <li><a href="auth-forgot-password">Forgot Password</a></li>
          <li><a href="auth-reset-password">Reset Password</a></li>
          <li><a href="subscribe">Subscribe</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i
            data-feather="alert-triangle"></i><span>Errors</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="errors-503">503</a></li>
          <li><a class="nav-link" href="errors-403">403</a></li>
          <li><a class="nav-link" href="errors-404">404</a></li>
          <li><a class="nav-link" href="errors-500">500</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="anchor"></i><span>Other Pages</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="create-post">Create Post</a></li>
          <li><a class="nav-link" href="posts">Posts</a></li>
          <li><a class="nav-link" href="profile">Profile</a></li>
          <li><a class="nav-link" href="contact">Contact</a></li>
          <li><a class="nav-link" href="invoice">Invoice</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i
            data-feather="chevrons-down"></i><span>Multilevel</span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Menu 1</a></li>
          <li class="dropdown">
            <a href="#" class="has-dropdown">Menu 2</a>
            <ul class="dropdown-menu">
              <li><a href="#">Child Menu 1</a></li>
              <li class="dropdown">
                <a href="#" class="has-dropdown">Child Menu 2</a>
                <ul class="dropdown-menu">
                  <li><a href="#">Child Menu 1</a></li>
                  <li><a href="#">Child Menu 2</a></li>
                </ul>
              </li>
              <li><a href="#"> Child Menu 3</a></li>
            </ul>
          </li>
        </ul>
      </li> -->
    </ul>
  </aside>
</div>
