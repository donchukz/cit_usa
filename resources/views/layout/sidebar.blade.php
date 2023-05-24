 <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidebar">
     <div class="container-fluid sidebarNav">

         <!-- Toggler -->
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse"
             aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>




         <!-- Collapse -->
         <div class="collapse navbar-collapse" id="sidebarCollapse">


             <!-- Navigation -->
             <ul class="navbar-nav">
                 @if (auth()->user()->role == 'admin')
                     <li class="nav-item">
                         <a class="nav-link" href="{{ url('dashboard') }}">
                             <i class="fe fe-file-text"></i>Employee List
                         </a>
                     </li>
                     {{-- <li class="nav-item">
                         <a class="nav-link" href="{{ url('registry') }}">
                             <i class="fe fe-file-plus"></i> Registry list
                         </a>
                     </li> --}}
                     <li class="nav-item">
                         <a class="nav-link" href="{{ url('pay-approval') }}">
                             <i class="fe fe-file"></i> Pay Summary
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="{{ url('pay-period') }}">
                             <i class="fe fe-file"></i> Pay Period
                         </a>
                     </li>


                     <li class="nav-item">
                         <a class="nav-link" href="{{ url('patients') }}">
                             <i class="fe fe-file-text"></i> Patient List
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="{{ url('settings') }}">
                             <i class="fe fe-file-text"></i> Settings
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="{{ url('specialty') }}">
                             <i class="fe fe-file-text"></i> Specialty
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="{{ url('visit') }}">
                             <i class="fe fe-file-text"></i> Visit Type
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="{{ url('employee-time') }}">
                             <i class="fe fe-file-text"></i> Employee Time
                         </a>
                     </li>
                 @else
                     <li class="nav-item ">
                         <a class="nav-link activeNav" href="{{ url('employee') }}">
                             <i class="fe fe-user"></i> Account
                         </a>
                     </li>
                 @endif
                 <li class="nav-item">
                     <a class="nav-link" href="{{ url('update-password') }}">
                         <i class="fe fe-file-text"></i> Update Password
                     </a>
                 </li>


                 <br><br>
                 <li class="nav-item">
                     <form class="ml-4 loginForm " action="{{ route('logout') }}" method="post" class="p-3 inline">
                         @csrf
                         <button type="submit" class="btn btn-primary employeeBtn">Logout</button>

                     </form>
                 </li>
             </ul>


         </div>
 </nav>
