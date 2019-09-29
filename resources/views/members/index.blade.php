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
.active-purple-3 input[type=text] {
    border: 1px solid #ce93d8 !important;
    box-shadow: 0 0 0 1px #ce93d8 !important;
}
  </style>
 
    <div class="container">

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="active-purple-3 active-purple-4 mb-4">
          <form action="{{route('search')}}" method="POST">
            {{ csrf_field() }}
            <input class="form-control" name="q" type="text" placeholder="Search a mediator" aria-label="Search">  
            </form>    
      </div>
        </div>
        <div class="col-md-4"></div>
      </div>
        <div class="row">
          @foreach ($members as $member)
            <div class="col-md-4" style="margin-top:30px;">
            <div class="card card-1">
            <img class="card-img-top" style="
                border: 3px solid #fff;
                box-shadow: inset 0 1.5px 3px 0 rgba(0,0,0,.15), 0 1.5px 3px 0 rgba(0,0,0,.15);
                margin: 0px auto 12px;
                background-color: #f8fffb;
                width:120px;
                height:120px;
                box-sizing: border-box;
                background-clip: content-box;
                border-radius: 49.9%;
                border-color:#38c172;
                margin-top:10px;
            
            "; src="/uploads/avatars/{{$member->avatar}}" alt="{{$member->name}}">
								<div class="card-header text-center">
                <h4 class="card-title mb-0">{{$member->name}}</h4>
                <p style="font-weight:500">{{$member->headline}}</p>
								</div>
								<div class="card-body">
                <p class="card-text"> <span style="font-weight:600">Active Locations: </span> {{$member->location}}</p>
                <p class="card-text"> <span style="font-weight:600">Languages Spoken: </span> {{$member->language}}</p>
                <div ><a href="{{route('public-profile', $member->slug)}}"  style="padding:0.175rem 0.95rem !important;" class="btn btn-outline-success">Profile</a></div>
								
								</div>
							</div>
          </div>   
          @endforeach
         
        </div>

        
        <div class="row">
          <div class="col-md-4"></div>
						<div class="col-md-4 mb-3">
							{{$members->links()}}
            </div>
          <div class="col-md-4"></div>
					</div>
    </div>
</section>




@endsection
