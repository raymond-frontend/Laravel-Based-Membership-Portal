@extends('layouts.app')

@section('content')

<section>

  <style>

.card-1 {
  transition: all 0.2s cubic-bezier(.25,.8,.25,1);
}

.card-1:hover {
  box-shadow: 0 3px 7px rgba(0,0,0,0.05), 0 6px 6px rgba(0,0,0,0.11);
}
.badge{
  padding:0.5em 0.5em !important;
  border-radius:0.15rem !important;
}
  </style>
 
    <div class="container">
        <div class="row">
        <div class="col-md-4 mb-3"></div>
        <div style="color:green" class="col-md-4 mb-3">
             @if(session('message'))
             {{session('message')}}
             @endif 
        </div>
        
        <div class="col-md-4 mb-3"></div>
        </div>
        
        <div class="row">
            <div class="col-md-3 mb-3"></div>
            <div style="text-align:center"  class="col-md-6 mb-3">
                 <img class="card-img-top" style="
                border: 3px solid #fff;
                box-shadow: inset 0 1.5px 3px 0 rgba(0,0,0,.15), 0 1.5px 3px 0 rgba(0,0,0,.15);
                background-color: #f8fffb;
                width:170px;
                height:170px;
                box-sizing: border-box;
                background-clip: content-box;
                border-radius: 49.9%;
                border-color:#38c172;
            
            "; src="/uploads/avatars/{{$user->avatar}}" alt="{{$user->name}}">
           <div style="margin-top:15px; font-weight:600; font-size:24px; line-height:41px;"><p>{{$user->name}}</p></div>  
           <div style="margin-top:10px; font-weight:400; font-size:18px; line-height:41px;"><p>{{$user->headline}}</p></div> 
            </div>
        
            <div class="col-md-3 mb-3"></div>
         
        </div>

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><span style="font-weight:500; color:#38c172; font-size:16px; font-style:italic;"> Active Locations: </span>  <span style="margin-left:10px;">{{$user->location}}</span></li>
                    <li class="list-group-item"><span style="font-weight:500; color:#38c172; font-size:16px; font-style:italic;">Languages Spoken:</span><span style="margin-left:10px;">{{$user->language}}</span></li>
                    <li class="list-group-item"> <span style="font-weight:500; color:#38c172; font-size:16px; font-style:italic;">Mediation Style:</span><span style="margin-left:10px;">{{$user->style}}</span></li>
                   <li class="list-group-item"> <span style="font-weight:500; color:#38c172; font-size:16px; font-style:italic;">Cadre of Membership:</span><span style="margin-left:10px;">
                   @if ($user->membership->name == 'Fellow')
                     <span class="badge badge-success">{{$user->membership->name}}</span>  
                   @else
                     <span class="badge badge-dark">{{$user->membership->name}}</span>  
                   @endif
                    
                  </span></li>
                    <li class="list-group-item"> <span style="font-weight:500; color:#38c172; font-size:16px; font-style:italic;">Email:</span><span style="margin-left:10px;">{{$user->email}}</span></li>
                </ul>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        <div class="row">
          <div class="col-md-2"></div>
          <div style="margin-left:20px; margin-top:40px; font-size:16px;" class="col-md-8">
            <p>Mediation profile</p>
          </div>
          <div class="col-md-2"></div>
        </div> 

        <div class="row">
          <div class="col-md-2"></div>
          <div style="margin-left:20px; margin-top:10px; " class="col-md-8">
          <span style="font-size:16px; font-style:italic; color:#38c172; "> <p>Current Position and Background</p></span> 
          <hr style="background-color:#fff2f2; margin-top:-10px;">
          <p>{{$user->bio}}</p>

          </div>
          <div class="col-md-2"></div>
        </div>

        <div class="row">
          <div class="col-md-2"></div>
          <div style="margin-left:20px; margin-top:10px; " class="col-md-8">
          <span style="font-size:16px; font-style:italic; color:#38c172; "> <p>Academics Qualifications</p></span> 
          <hr style="background-color:#fff2f2; margin-top:-10px;">
          <p>{{$user->academics}}</p>

          </div>
          <div class="col-md-2"></div>
        </div>

        <div class="row">
          <div class="col-md-2"></div>
          <div style="margin-left:20px; margin-top:10px; " class="col-md-8">
          <span style="font-size:16px; font-style:italic; color:#38c172; "> <p>Professional Qualifications</p></span> 
          <hr style="background-color:#fff2f2; margin-top:-10px;">
          <p>{{$user->professional}}</p>

          </div>
          <div class="col-md-2"></div>
        </div>

         <div class="row">
          <div class="col-md-2"></div>
          <div style="margin-left:20px; margin-top:10px; " class="col-md-8">
          <span style="font-size:16px; font-style:italic; color:#38c172; "> <p>Professional Experience</p></span> 
          <hr style="background-color:#fff2f2; margin-top:-10px;">
          <p>{{$user->experience}}</p>

          </div>
          <div class="col-md-2"></div>
        </div>

         <div class="row">
          <div class="col-md-2"></div>
          <div style="margin-left:20px; margin-top:10px; " class="col-md-8">
          <span style="font-size:16px; font-style:italic; color:#38c172; "> <p>Inspiration</p></span> 
          <hr style="background-color:#fff2f2; margin-top:-10px;">
          <p>{{$user->inspiration}}</p>

          </div>
          <div class="col-md-2"></div>
        </div>

    </div>
</section>




@endsection
