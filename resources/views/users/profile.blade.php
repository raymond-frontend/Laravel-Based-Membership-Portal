@extends('layouts.master')
@section('title')
Welcome 
@endsection

@section('content')
      <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-content ">
            <a class="sidebar-brand" href="{{route('home')}}">
                  
			<span class="align-middle"><img src="/assets/img/logos/logo.jpg" alt="" height="60"></span>
                </a>

                <ul class="sidebar-nav">

                    <li class="sidebar-item active">
                        <a href="#dashboards" data-toggle="collapse" class="sidebar-link">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                        <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show">
							<li class="sidebar-item active"><a class="sidebar-link">Profile</a></li> 
							 <li class="sidebar-item"><a class="sidebar-link" href="{{route('home')}}">Home</a></li> 
                            </li>
						  @if (Auth::User() == $user)
						  <li class="sidebar-item"><a class="sidebar-link" href="{{route('editUser', $user->id)}}">Update Profile</a></li>
					  @endif 
                        <li class="sidebar-item"><a class="sidebar-link" href="{{route('users')}}">Members</a></li> 
                            </li>
                        </ul>
                    </li>

                </ul>

        

            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light bg-white">
                <a class="sidebar-toggle d-flex mr-2">
                    <i class="hamburger align-self-center"></i>
                </a>

                  <form action="{{route('search')}}" method="POST"role="search" class="form-inline d-none d-sm-inline-block">
                {{ csrf_field() }}
                    <input class="form-control form-control-no-border mr-sm-2" type="text" name="q" placeholder="Search other members..." aria-label="Search">           
                </form>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">

                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="messagesDropdown">

                                <div class="list-group">


                                    <li class="nav-item dropdown">
                                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                                          
                                        </a>

                                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
										<img src="/uploads/avatars/{{Auth::User()->avatar}}" class="avatar img-fluid rounded-circle mr-1" alt="{{Auth::user()->name}}" /> <span class="text-dark">{{Auth::user()->name}}</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
											<a style="color:green" class="dropdown-item" href="#"> Online</a>
										<a style="color:red" class="dropdown-item" href="#">Membership ID: {{Auth::User()->member_id}}</a>
                                            <a class="dropdown-item" href="/home"></i>Home</a>
                                              
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
	          <div class="main" style="background-color:#ffffff; min-width: 800px;">
			
					<main class="content">

					<div class="row">
						<div class="col-md-2 mb-3"></div>
                        <div class="col-md-8 mb-3 scard-2" style="postion:absolute;">
							<div style="background-image:url('/assets/img/background/profile-bg.jpg'); position:relative; overflow:hidden; background-repeat:no-repeat; max-width:100%;">
							<div style="padding-top:50px; padding-left:10px;"><img src="/uploads/avatars/{{$user->avatar}}" alt="{{$user->name}}" style="box-shadow:0 4px 5px rgba(57, 63, 72, 0.5)" class=" img-fluid rounded-circle mb-2" width="152" height="152" style="z-index:999;" /></div>
							</div>

							<div style="margin-top:20px;">
							<p style="font-weight:600;" class=" profile-id">{{$user->name}}
								@if ($user->membergroup_id == '3')
								<img src="/assets/img/avatars/verified.png" alt="">
								@endif  </p>	
							<p style="font-weight:500;" class=" profile-id">{{$user->headline}}</p>
							<p class="profile-id"> Membership ID. <span style="font-weight:800;">{{$user->member_id}}</span> </p>
							@if (Auth::User() == $user)
							<div><a class="btn btn-primary btn-sm profile-cadre" href="javascrip:void(0)">{{$user->membership->name}}</a> <span class="float-right"><a class="btn btn-danger btn-sm profile-cadre" href="{{route('editUser', $user->id)}}">Update</a></span> </div>	
							@endif
								
							</div>
						</div> 
						<div class="col-md-2 mb-3"></div>  
						
				</div>
			</main>

				<main class="content" style="margin-top:-65px;">
					<div class="row">
						<div class="col-md-2 mb-3"></div>
                        <div class="col-md-8 mb-3 scard-2">	
							<div ><p class="profile-gutterx profile-about">About</p></div>
							<div class="profile-gutterx" style="margin-bottom:18px;">
												{{$user->bio}}

										</div>
						</div>  
						<div class="col-md-2 mb-3"></div>    
					</div>

			
			</main>

			<main class="content" style="margin-top:-65px;">
					<div class="row">
						<div class="col-md-2 mb-3"></div>
                        <div class="col-md-8 mb-3 scard-2">	
							<div><p class="profile-gutterx profile-about">Academic qualifications</p></div>
						<div class="profile-gutterxz">{{$user->academics}}</div>	
							<hr class="profile-gutterx">
							<div><p class="profile-gutterx profile-about">Professional qualifications</p></div>
						<div class="profile-gutterxz">{{$user->professional}}</div>	
							<hr class="profile-gutterx">
							<div><p class="profile-gutterx profile-about">Professional Experience</p></div>
						<div class="profile-gutterxz">{{$user->experience}}</div>	
							<hr class="profile-gutterx">
							<div><p class="profile-gutterx profile-about">Mediation Style</p></div>
						<div class="profile-gutterxz">
							{{$user->style}}
						</div>
						<hr class="profile-gutterx">
						<div><p class="profile-gutterx profile-about">Active Locations</p></div>
						<div class="profile-gutterxz">{{$user->location}}</div>	
							<hr class="profile-gutterx">
						<div><p class="profile-gutterx profile-about">Inspiration</p></div>
						<div class="profile-gutterxz">{{$user->inspiration}}</div>	
							<hr class="profile-gutterx">

							</div>
                        </div>      
					</div>
					<div class="col-md-2 mb-3"></div>

			
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
 