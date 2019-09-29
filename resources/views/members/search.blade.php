@extends('layouts.app')

@section('content')

<section>

  <style>

  </style>
 
    <div style="background-color:#fff;" class="container">
     <div><span style="margin-top:60px;"> <p>Showing {{$verifiedUsers->count()}} results</p> </span> </div>   
        @foreach ($verifiedUsers as $user)
         <div style="margin-top:15px;" class="row">
         <div class="col-md-1">
             <img class="card-img-top" style="
                box-shadow: inset 0 1.5px 3px 0 rgba(0,0,0,.15), 0 1.5px 3px 0 rgba(0,0,0,.15);
                background-color: #f8fffb;
                width:50px;
                height:50px;
                box-sizing: border-box;
                background-clip: content-box;
                border-radius: 49.9%;
            
            "; src="/uploads/avatars/{{$user->avatar}}" alt="{{$user->name}}">
         </div>
         <div class="col-md-6">
         <a style="text-decoration:none;" href="{{route('public-profile', $user->slug)}}"><p style=" color:#2f7b15; font-weight:600; font-size:16px;">{{$user->name}}</p></a> 
         <p style="font-weight:400; font-size:14px; margin-top:-15px;">{{$user->headline}}</p>
         <p style="font-weight:400; font-size:12px; margin-top:-15px; color:#2f7b15;">{{$user->email}}</p>
         </div>

     </div>  
     <hr style="margin-top:-5px;"> 
        @endforeach
     

    </div>
</section>




@endsection
