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
                            @if (Auth::user()->isAdmin())
                        <li class="sidebar-item active"><a href="{{route('adminUsers')}}" class="sidebar-link" >Home</a></li>
                            @else
                        <li class="sidebar-item active"><a href="{{route('home')}}" class="sidebar-link" >Home</a></li>
                            @endif
                        
                        @if (Auth::user()->isAdmin())
                            <li class="sidebar-item"><a class="sidebar-link" href="{{route('adminVerified')}}">Verified Members</a></li>
                        @endif
                        @if (Auth::user()->isAdmin())
                            <li class="sidebar-item"><a class="sidebar-link" href="{{route('adminVerified')}}">Pending Users</a></li>
                        @endif
                        @if (Auth::user()->isAdmin())
                            <li class="sidebar-item"><a class="sidebar-link" href="{{route('adminVerified')}}">Banned Users</a></li>
                        @endif	
					    @if (Auth::user()->isAdmin())
                        <li class="sidebar-item"><a class="sidebar-link" href="{{route('makeAnnouncement')}}">Create Announcement</a></li>
                        @endif	
                         @if (Auth::user()->isAdmin())
                        <li class="sidebar-item"><a class="sidebar-link" href="{{route('adminPosts')}}">Announcement</a></li>
                        @endif
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
                                <i class="fas fa-circle text-success"></i>&nbsp; Member {{Auth::user()->member_id}}
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
                            <div class="col-md-3 mb-3 "></div>
							<div class="col-md-6 mb-3 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="card-actions float-right">
										
									</div>
                                <h5 class="card-title mb-0">{{$post->title}}</h5>
								</div>
								<div class="card-body d-flex">
                                    {{$post->body}}

                                
							
								</div>
							</div>
                        </div>
                        <div class="col-md-3 mb-3 "></div>
					</div>
                    
        
                    
           

                   
                    

                  

            </main>

        
            </div>
            </div> 
@endsection
 