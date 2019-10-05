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
						<li class="sidebar-item active"><a class="sidebar-link" href="{{route('adminUsers')}}" >Home</a></li>
						<li class="sidebar-item"><a class="sidebar-link" href="{{route('adminVerified')}}">Verified Members</a></li>
						<li class="sidebar-item"><a class="sidebar-link" href="{{route('adminPaid')}}">Paid Dues</a></li>
						<li class="sidebar-item"><a class="sidebar-link" href="{{route('adminPending')}}">Pending Users</a></li>
						<li class="sidebar-item"><a class="sidebar-link" href="{{route('adminBanned')}}">Banned Users</a></li>
						<li class="sidebar-item"><a class="sidebar-link" href="{{route('makeAnnouncement')}}">Create Announcement</a></li>
                          <!--   <li class="sidebar-item"><a class="sidebar-link" href="posts">Post</a></li>
                           <li class="sidebar-item"><a class="sidebar-link" href="dashboard-social.html">Social</a>-->
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
                                            <a style="color:green" class="dropdown-item" href="#"><i class="align-middle mr-1"
										data-feather="pie-chart"></i> Online</a>
                                            <a class="dropdown-item" href="users/profile/{{$user->id}}"><i class="align-middle mr-1"
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

            <main class="content" style="background-color:#f9fcf9">
                <div class="container-fluid p-0">

                    <div class="row">
                        <div class="col-md-8 mb-3 Subhead">
                            <h2 class="Subhead-heading gutter">Update Member </h2>
                        </div>

                        <div class="col-md-4 mb-3">
                              @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   
                        </div>
                    </div>

                   
                    

                    <div class="row">
                        <div class="col-md-8 mb-3 gutter">
                      {!! Form::model($user, ['method' => 'PATCH', 'action' =>['AdminUsersController@userUpdate', $user->id]])!!}
                    

                     <div class="spacing">
                     <label for="exampleFormControlTextarea1">Cadre of Membership</label>
                    </div>

                    <div class="form-group row">
                        {!! Form::select('membership_id', $memberships, null, ['class' =>'form-control gutterx']) !!}
                    </div>

                    
                    <div class="spacing">
                     <label for="exampleFormControlTextarea1">Membergroup</label>
                    </div>

                    <div class="form-group row">
                        {!! Form::select('membergroup_id', $membergroups, null, ['class' =>'form-control gutterx']) !!}
                    </div>
                      
                     <div class="spacing">
                      
                     </div>

                     {!! Form::submit('Update Profile', ['class' =>'btn btn-primary']) !!}


                    {!! Form::close() !!}

                        </div>

                   
               
                     
                    </div>


                      <div class="row">
                        <div class="col-md-8 mb-3 gutter">
                      {!! Form::model($user, ['method' => 'PUT', 'action' =>['AdminUsersController@paidUsers', $user->id]])!!}
                    

                     <div class="spacing">
                     <label for="exampleFormControlTextarea1">Confirm Payment</label>
                    </div>

                    <div class="form-group row">
                        {!! Form::select('paid_id', $paids, null, ['class' =>'form-control gutterx']) !!}
                    </div>

                     <div class="spacing">
                      
                     </div>

                     {!! Form::submit('Update Paid', ['class' =>'btn btn-secondary']) !!}


                    {!! Form::close() !!}

                        </div>

                   
               
                     
                    </div>
                </div>


            </main>

  
            </div>
            </div> 
@endsection
 