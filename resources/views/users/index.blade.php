@extends('layouts.master')
@section('title')
Welcome 
@endsection

@section('content')
      <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-content ">
                <a class="sidebar-brand" href="http://icmcng.org">
                  
                    <span class="align-middle"><img src="/assets/img/logos/logo.jpg" alt="" height="60"></span>
                </a>

                <ul class="sidebar-nav">

                     <li class="sidebar-item active">
                        <a href="#dashboards" data-toggle="collapse" class="sidebar-link">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                        <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show">
                        <li class="sidebar-item active"><a class="sidebar-link" href="{{route('users')}}">Members</a></li>
                        <li class="sidebar-item "><a class="sidebar-link" href="{{route('home')}}">Home</a></li>
                        <li class="sidebar-item "><a class="sidebar-link" href="{{route('user', Auth::user()->slug)}}">Profile</a></li>
                        
                            </li>
                        </ul>
                    </li>

                </ul>

        <!-----------     <div class="sidebar-bottom d-none d-lg-block">
                    <div class="media">
                        <img class="rounded-circle mr-3" src="/assets/img/avatars/avatar.jpg" alt="Chris Wood" width="40" height="40">
                        <div class="media-body">
                        <h5 class="mb-1"></h5>
                            <div>
                                <i class="fas fa-circle text-success"></i>  
                            </div>
                        </div>
                    </div>
                </div>---->

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
                                            <i class="align-middle" data-feather="settings"></i>
                                        </a>

                                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                                        <img src="/uploads/avatars/{{Auth::user()->avatar}}" class="avatar img-fluid rounded-circle mr-1" alt="Chris Wood" /> <span class="text-dark">{{Auth::user()->name}}</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a style="color:green" class="dropdown-item" href="#"><i class="align-middle mr-1"
										data-feather="pie-chart"></i> Online</a>
                                            <a class="dropdown-item" href="users/profile/{{Auth::user()->id}}"><i class="align-middle mr-1"
										data-feather="user"></i> Profile</a>
                                              
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

           
			<main class="content text-center">
				<div class="container-fluid p-0 scard-2">

                  <div class="gutterxy"> <h1 class="h3 mb-3 ">Members</h1></div> 
                    <hr>

					<div class="row">
                        @foreach ($users as $user)
                            <div class="col-md-3 mb-3 text-center">
							<div class="card scard-1 gutterx">
								<div class="card-body" >
                                 <img src="/uploads/avatars/{{$user->avatar}}" width="64" height="64" class="rounded-circle mt-2" alt="Angelica Ramos">
                                  <div class="member-name">{{$user->name}}</div> 
                                <div class="member-cadre">{{$user->membership->name}}</div>
                               
                                    @if (Auth::user()->membergroup_id == 3)
                                     <div style="margin-top:20px;" class="artdeco-button"> 
                                    <a style="text-decoration:none;" href="{{route('user', $user->slug)}}">Profile</a>
                                     </div>
                                @endif  
								</div>
							</div>
                        </div>
                        @endforeach

						
                        

                        
					</div>

				</div>
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
 