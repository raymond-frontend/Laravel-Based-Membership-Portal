@extends('layouts.master')
@section('title')
Welcome 
@endsection

@section('content')
      <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-content ">
                <a class="sidebar-brand" href="http://icmcng.org">
                  
				<span class="align-middle"><img src="/assets/img/logos/logo.jpg" alt="{{Auth::user()->name}}" height="60"></span>
                </a>

                <ul class="sidebar-nav">

                    <li class="sidebar-item active">
                        <a href="#dashboards" data-toggle="collapse" class="sidebar-link">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                        <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show">
						<li class="sidebar-item active"><a href="{{route('adminUsers')}}" class="sidebar-link" >Home</a></li>
						<li class="sidebar-item"><a class="sidebar-link" href="{{route('adminVerified')}}">Verified Members</a></li>
						<li class="sidebar-item"><a class="sidebar-link" href="{{route('adminVerified')}}">Pending Users</a></li>
						<li class="sidebar-item"><a class="sidebar-link" href="{{route('adminVerified')}}">Banned Users</a></li>
						<li class="sidebar-item"><a class="sidebar-link" href="{{route('makeAnnouncement')}}">Create Announcement</a></li>
                          <!--   <li class="sidebar-item"><a class="sidebar-link" href="posts">Post</a></li>
                           <li class="sidebar-item"><a class="sidebar-link" href="dashboard-social.html">Social</a>-->
                            </li>
                        </ul>
                    </li>

                </ul>

             <div class="sidebar-bottom d-none d-lg-block">
                    <div class="media">
					<img class="rounded-circle mr-3" src="/uploads/avatars/{{Auth::User()->avatar}}" alt="{{Auth::User()->name}}" width="40" height="40">
                        <div class="media-body">
                        <h5 class="mb-1">{{Auth::user()->name}}</h5>
                            <div>
                                <i class="fas fa-circle text-success"></i>&nbsp; Member {{Auth::user()->reference_id}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light bg-white">
                <a class="sidebar-toggle d-flex mr-2" >
                    <i  class="hamburger align-self-center"></i>
                </a>

                <form class="form-inline d-none d-sm-inline-block">
                    <input class="form-control form-control-no-border mr-sm-2" type="text" placeholder="Search other members..." aria-label="Search">
                </form>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">

                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="messagesDropdown">

                                <div class="list-group">


                                    <li class="nav-item dropdown">
                                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                                            <i class="align-middle" data-feather="settings"></i>
                                        </a>

                                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                                        <img src="/uploads/avatars/{{Auth::User()->avatar}}" class="avatar img-fluid rounded-circle mr-1" alt="Chris Wood" /> <span class="text-dark">{{Auth::user()->name}}</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a style="color:green" class="dropdown-item" href="Javascript:void()"><i class="align-middle mr-1"
										data-feather="pie-chart"></i> Online</a>
                                     
                                              
                                           <!------ <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="pages-settings.html">Settings & Privacy</a>
                                            <a class="dropdown-item" href="#">Help</a>-->
                                           <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sign Out') }}
                                    </a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                        </div>
                                    </li>
                    </ul>
                    </div>
            </nav>

            <main class="content" style="background-color:#f9fcf9">
                <div class="container-fluid p-0">

                 
					
					<div class="row">
						<div class="col-md-4 mb-3"></div>
						<div class="col-md-4 mb-3">@if(session('message'))
  							{{session('message')}}
						@endif</div>
						<div class="col-md-4 mb-3"></div>
					</div>

                             	<div class="row">
						<div class="col-12 col-lg-6 col-xl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="card-actions float-right">
										<div class="dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static">
												<i class="align-middle" data-feather="more-horizontal"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Pending</a>
												<a class="dropdown-item" href="#">Banned</a>
											<a class="dropdown-item" href="{{route('adminVerified')}}">Verified</a>
											</div>
										</div>
									</div>
									<h5 class="card-title mb-0">Latest Users</h5>
								</div>
								<table id="datatables-dashboard-projects" class="table table-striped my-0">
									<thead>
										<tr>
											<th>Name</th>
											<th class="d-none d-xl-table-cell">Membership ID</th>
											<th class="d-none d-xl-table-cell">Registered</th>
                                            <th>Status</th>
                                            <th>Cadre</th>
                                            <th>Paid</th>
											<th class="d-none d-md-table-cell">Action</th>
										</tr>
									</thead>
									
									<tbody>
                                        @foreach ($bannedUsers as $fresh)
                                            <tr>
											<td><a style="text-decoration:none;" href="{{route('adminUser', $fresh->id)}}">{{$fresh->name}}</a></td>
											<td class="d-none d-xl-table-cell">{{$fresh->reference_id}}</td>
											<td class="d-none d-xl-table-cell">{{$fresh->created_at->diffForHumans()}}</td>

											@switch($fresh->membergroup_id)
												@case(1)
													<td><span class="badge badge-warning">{{$fresh->membergroup->name}}</span></td>
													@break
												@case(2)
													<td><span class="badge badge-danger">{{$fresh->membergroup->name}}</span></td>
													@break
												@case(3)
													<td><span class="badge badge-success">{{$fresh->membergroup->name}}</span></td>
													@break
												@case(4)
													<td><span class="badge badge-dark">{{$fresh->membergroup->name}}</span></td>
												@default
													
											@endswitch
										
                                            <td class="d-none d-md-table-cell">{{$fresh->membership->name}}</td>
                                            <td></td>
                                            <td class="d-none d-md-table-cell">
                                                	<div class="card-actions float-left">
										<div class="dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static">
												<i class="align-middle" data-feather="more-horizontal"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="{{route('adminUser', $fresh->id)}}"><i class="fas fa-binoculars"></i> &nbsp; View</a>
											<a class="dropdown-item" href="{{route('adminEditUser', $fresh->id)}}"><i class="fas fa-user-edit"></i> &nbsp; Edit</a>
											<a  class="dropdown-item" onclick="return confirm('Are you sure you want to delete this user')" href="{{route('deleteUser', $fresh->id)}}"><i class="fas fa-user-times"></i> &nbsp; Delete</a>
											</div>
										</div>
									</div>
                                            </td>
										</tr>
                                        @endforeach
										
										
									</tbody>
								</table>
							</div>
						</div>
					
					</div>
                    
               <!-----    	<div class="row">
						<div class="col-12 col-lg-6 col-xl-4 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="card-actions float-right">
										<div class="dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static">
												<i class="align-middle" data-feather="more-horizontal"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Action</a>
												<a class="dropdown-item" href="#">Another action</a>
												<a class="dropdown-item" href="#">Something else here</a>
											</div>
										</div>
									</div>
									<h5 class="card-title mb-0">Announcements</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div id="datetimepicker-dashboard"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-xl-4 d-none d-xl-flex">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<div class="card-actions float-right">
										<div class="dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static">
												<i class="align-middle" data-feather="more-horizontal"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Action</a>
												<a class="dropdown-item" href="#">Another action</a>
												<a class="dropdown-item" href="#">Something else here</a>
											</div>
										</div>
									</div>
									<h5 class="card-title mb-0">Latest Members</h5>
								</div>
								<div class="card-body">
									<div class="align-self-center w-100">
									

										<table class="table mb-0" >
											<thead>
												<tr>
													<th>Name</th>
													<th class="text-right">status</th>
													
												</tr>
											</thead>
											<tbody style="border-top:none !important;">
											
											</tbody>
										</table>
									</div>
								</div>
							
							</div>
						</div>
		
                    </div>--> 
                    
           

                   
                    

                  

            </main>

         <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-left">
                            <ul class="list-inline">

                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Terms of Service</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6 text-right">
                            <p class="mb-0">
                                &copy; 2019 - <a href="http://icmcng.org" class="text-muted">ICMC</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
            </div>
            </div> 
@endsection
 