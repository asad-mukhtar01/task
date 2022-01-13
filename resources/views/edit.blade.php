@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row">
       <div class="col-lg-4">
           <div class="card">
               <div class="card-header">
                   Edit Profile
               </div>
               <div class="card-body">
                   <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                       <div class="form-group">
                           <label>Avatar (dimension: 256px x 256px)</label>
                           <input type="file" name="avatar">
                           @error('avatar')
                            <font color="red"><b>{{ $message }}</b></font>
                           @enderror
                       </div>
                       <div class="form-group">
                           <label>Name</label>
                           <input type="text" value="{{ Auth::user()->name }}" class="form-control" name="name">
                            @error('name')
                            <font color="red"><b>{{ $message }}</b></font>
                           @enderror
                       </div>
                        <div class="form-group">
                           <label>Email</label>
                           <input type="text" value="{{ Auth::user()->email }}" class="form-control" name="email">
                            @error('email')
                            <font color="red"><b>{{ $message }}</b></font>
                           @enderror
                       </div>
                       <div class="form-group">
                           <button class="btn btn-danger btn-block">Update</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
