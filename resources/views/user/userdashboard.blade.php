@extends('layouts.app')

@section('content')

{{-- modal  --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Request</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="/uploadPhoto" enctype="multipart/form-data">
                @method('post')
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Select a file</label> <br>
                    <input type="file" name="image" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" name="upload">Submit</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
{{-- end modal  --}}


<div class="row nopadding">
    <div class="col-2 bg-white nopadding" style="height: 100vh;">
        <div class="container py-3">
            @if (empty(Auth::user()->avatar))
            <div class="px-1 text-center pt-5 pb-3">
                <h5>{{Auth::user()->name}}</h5><br>
                <div class="pb-5">
                    <small>{{Auth::user()->usertype}} /</small>
                    <small>{{Auth::user()->position}}</small><br>
                    @isset($dept)
                        <small>{{$dept->department_name}}</small>
                    @endisset
                </div>
                <small>Click below to update your profile</small>
                <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal">Add photo</button>
                </div>
            @else
            <div class="px-1 text-center py-3">
                <img src="{{asset('/storage/images/'.Auth::user()->avatar)}}" alt="..." class="rounded-circle" width="120"><br>
                <h5>{{Auth::user()->name}}</h5><br>
                <small>{{Auth::user()->usertype}} /</small>
                <small>{{Auth::user()->position}}</small><br>
                @isset($data)
                    <small>{{$dept->department_name}}</small>
                @endisset
            </div> 
            @endif
            <div class="px-1">
                <a href="/userdashboard" class="text-decoration-none text-secondary active">
                     <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Home</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="/userdashboard/myprofile" class="text-decoration-none text-secondary">
                    <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>My Profile</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="" class="text-decoration-none text-secondary"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Requests</span></a>
            </div>
        </div>
    </div>
    <div class="col nopadding">
        <div class="container py-4">
            <div class="container">
                <div class="mb-2">
                    Legend:
                </div>
                <div>
                    <small>Pending: </small><small class="text-secondary">O</small>
                </div>
                <div>
                    <small>Authorized: </small><small class="text-danger">A</small>
                </div>
                <div>
                    <small>Confirmed: </small><small class="text-primary">C</small>
                </div>
                <div>
                    <small>Process: </small><small class="text-success">P</small>
                </div>
                <hr>
            </div>
            <div class="card m-auto">
                <div class="card-header">
                    <div class="row nopadding">
                        <div class="col nopadding vertalign">
                            <h5 class="nopadding">Requests</h5>
                        </div>
                        <div class="col nopadding">
                            <a href="/sample" class="btn btn-primary float-right">Make a request</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($requests as $request)
                        <div class="container border-bottom pt-3">
                            <h5>{{$request->req_id}}</h5>
                            <div class="row nopadding">
                                <div class="col nopadding"><pre>Status: <span>{{$request->status}}</span></pre></div>
                                <div class="col nopadding text-right"><pre class="text-muted">Requested on: {{$request->requestedDate}}</pre></div>
                            </div>
                            <div class="">
                                <small><a href="/userdashboard/viewRequest/{{$request->req_id}}">View  >  > </a></small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <h5>Welcome admin!</h5>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
