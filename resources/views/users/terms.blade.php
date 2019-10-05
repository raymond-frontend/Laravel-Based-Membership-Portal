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
                        <li class="sidebar-item active"><a class="sidebar-link" href="{{route('home')}}">Home</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="users/profile/{{Auth::User()->slug}}">My Profile</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="users">Members</a></li>
                          <!--  <li class="sidebar-item"><a class="sidebar-link" href="dashboard-social.html">Social</a>-->
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
						<div style="color:red; font-weight:700;" class="col-md-4 mb-3">@if(session('message'))
  							{{session('message')}}
						@endif</div>
						<div class="col-md-4 mb-3"></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                           
                              <h3>TERMS OF USE</h3>  
 <p style="line-height:2; text-align:justify;">
Esteemed Mediators, we thank you for validating your membership and updating your profile. Please note the following terms of use of the portal:<br>

• Only Members who have validated their membership for 2019 may upload their profiles on the portal <br>

• To log in to update your profile, kindly input your full name as your username and your membership number as your password <br>

• Members may log in at any time to update their profiles <br>

• Visitors to the ICMC website (www.icmcng.org) may view your profiles under the drop-down “ICMC Directory of Members.”<br>

• By updating your membership profiles, you grant ICMC the unrestricted and irrevocable right to display your profile (only) on the ICMC website (www.icmcng.org) under the drop-down “ICMC Directory of Members.” <br>

• Visitors will be able to view your profiles only. Only Members have access to edit their profiles <br>

• Your password protects your profile, and you are solely responsible for keeping your password confidential and secure. You understand that you are responsible for all use of your username and password on the portal. If you believe there has been unauthorized access to your profile by third parties, please notify the ICMC Secretariat.<br>

• A yearly clock has been placed on the portal. If you do not pay your annual membership dues as at when due, your membership privileges will be removed, and you will no longer enjoy your membership benefits <br>

• It is imperative that Members be sincere in updating their profiles. Members are to refrain from posting any content which:<br>
- is offensive, abusive, defamatory, pornographic, threatening, unlawful, harmful, vulgar, libelous, deceptive, fraudulent, invasive of another’s privacy, hateful or obscene<br>
- is illegal, or intended to promote or commit an illegal act of any kind, including but not limited to violations of intellectual property rights, privacy rights, or proprietary rights of ICMC or a third party<br>
- includes your password or purposely includes any other member’s password or intentionally includes personal data of third parties or is intended to solicit such personal data<br>
- includes malicious content such as malware, Trojan horses, or viruses, or otherwise interferes with any member’s access to the portal<br>
- impersonates or misrepresents your affiliation with another member, person, or entity, or is otherwise fraudulent, false, deceptive, or misleading<br>
- involves commercial or sales activities, such as advertising, promotions, contests, or pyramid schemes, that are not expressly authorized by ICMC<br>
- links to, references, or otherwise promotes commercial products or services, except as explicitly authorized by ICMC<br>
- aimed at disrupting the operations of the ICMC membership portal<br>

Members acknowledge and agree that engaging in any of the above may result in the immediate suspension of his/her membership profile, pending deliberation by the Executive Committee of the Institute of Chartered Mediators and Conciliators.  


The Institute of Chartered Mediators and Conciliators takes no responsibility for any false information or misrepresentation contained in the profiles of Members
                            </p>
                        </div>
                        <div class="col-md-3"></div>
                    </div>

            </main>
            </div>
            </div> 
@endsection
 