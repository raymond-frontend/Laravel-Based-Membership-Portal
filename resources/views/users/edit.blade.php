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
                            <li class="sidebar-item active"><a class="sidebar-link">Update Profile</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{route('home')}}">Home</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{route('user', $user->slug)}}">Profile</a></li>
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

                <form action="{{route('search')}}" method="POST" role="search" class="form-inline d-none d-sm-inline-block">
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
                                        <img src="/uploads/avatars/{{$user->avatar}}" class="avatar img-fluid rounded-circle mr-1" alt="Chris Wood" /> <span class="text-dark">{{Auth::user()->name}}</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a style="color:green" class="dropdown-item" href="#"><i class="align-middle mr-1"
                                        data-feather="pie-chart"></i> Online</a>
                                        <a style="color:red" class="dropdown-item" href="#"><i class="align-middle mr-1"
										data-feather="bar-chart"></i>{{Auth::User()->member_id}}</a>
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
                        <div class="col-md-4 mb-3"></div>
                        <div class="col-md-4 mb-3">
                            @if ($errors->any())
                       <div style="color:red">{{ implode('', $errors->all(':message')) }}</div>  
                            @endif
                        </div>
                        <div class="col-md-4 mb-3"></div>
                        <div class="col-md-8 mb-3 Subhead">
                            <h2 class="Subhead-heading gutter">Profile Update </h2>
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
                      {!! Form::model($user, ['method' => 'PUT', 'action' =>['UsersController@update', $user->id]])!!}

                       <div class="spacing">
                        <label for="exampleFormControlTextarea1">Name</label>
                     </div>

                        <div class="form-group row">
                        {!! Form::text('name', null, ['class' =>'form-control gutterx']) !!}
                    </div>

                     <div class="spacing">
                        <label for="exampleFormControlTextarea1">Bio</label>
                     </div>

                    <div class="form-group row">
                        {!! Form::textarea('bio',  null, ['class' =>'form-control gutterx', 'placeholder'=>'Brag a Little about yourself', 'rows' =>'3', 'maxlength'=>'280']) !!}
                    </div>
                    

                     <div class="spacing">
                     <label for="exampleFormControlTextarea1">Cadre of Membership</label>
                    </div>

                    <div class="form-group row">
                        {!! Form::select('membership_id', $memberships, null, ['class' =>'form-control gutterx']) !!}
                    </div>

                    <div class="spacing">
                     <label for="exampleFormControlTextarea1">Languages</label>
                    </div>
                     <div class="form-group row">
                        {!! Form::text('language', null, ['class' =>'form-control gutterx spacing', 'placeholder' => 'Languages Spoken']) !!}
                    </div>

                                         <div class="spacing">
                        <label for="exampleFormControlTextarea1">Academics Qualifications</label>
                     </div>

                    <div class="form-group row">
                        {!! Form::textarea('academics',  null, ['class' =>'form-control gutterx', 'placeholder'=>'Brag a Little about yourself', 'rows' =>'3', 'maxlength'=>'280']) !!}
                    </div>

                         <div class="spacing">
                        <label for="exampleFormControlTextarea1">Professional Qualifications</label>
                     </div>

                    <div class="form-group row">
                        {!! Form::textarea('professional',  null, ['class' =>'form-control gutterx', 'placeholder'=>'What are your Qualifications', 'rows' =>'3', 'maxlength'=>'280']) !!}
                    </div>

                        <div class="spacing">
                        <label for="exampleFormControlTextarea1">Professional Experience</label>
                     </div>

                    <div class="form-group row">
                        {!! Form::textarea('experience',  null, ['class' =>'form-control gutterx', 'placeholder'=>'A little about your experience', 'rows' =>'3' ,'maxlength'=>'280']) !!}
                    </div>

                       <div class="spacing">
                        <label for="exampleFormControlTextarea1">Inspiration</label>
                     </div>

                    <div class="form-group row">
                        {!! Form::textarea('inspiration',  null, ['class' =>'form-control gutterx', 'placeholder'=>'A little about your experience', 'rows' =>'3' ,'maxlength'=>'280']) !!}
                    </div>

                     <div class="spacing">
                        <label for="exampleFormControlTextarea1">Active Locations</label>
                     </div>
                    <div class="form-group row">
                        {!! Form::text('location', null, ['class' =>'form-control gutterx spacing', 'placeholder' => 'Active locations, seperated by comma']) !!}
                    </div>

                     <div class="spacing">
                        <label for="exampleFormControlTextarea1">Mediation Style</label>
                     </div>

                    <div class="form-group row">
                        {!! Form::textarea('style',  null, ['class' =>'form-control gutterx', 'placeholder'=>'What is your style', 'rows' =>'3' ,'maxlength'=>'280']) !!}
                    </div>

                     <div class="spacing">
                      
                     </div>

                     {!! Form::submit('Update Profile', ['class' =>'btn btn-primary']) !!}


                    {!! Form::close() !!}

                        </div>

                            <div class="col-md-4 mb-3 gutter">
                    {!! Form::model($user, ['method' => 'PATCH', 'action' =>['UsersController@changeAvatar', $user->id], 'files' =>true])!!}

                                                
                    <div class="spacing">
                        <label for="exampleFormControlTextarea1">Upload Picture</label>
                    </div>

                    <div class="form-group row">
                    {!! Form::file('avatar', ['class'=>'form-control gutterx']) !!}
                    </div>
                    {!! Form::submit('save', ['class' =>'btn btn-primary']) !!}

                    {!! Form::close() !!}
                     </div>

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
 