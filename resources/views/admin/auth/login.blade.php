 @extends('admin.layouts.app')

 @section('content')
 <div class="login-box">
     <div class="card">
         <div class="card-body login-card-body">
             <form action="{{ route('admin.login') }}" method="POST">
                 @csrf
                 <div class="input-group mb-3">
                     <input type="email" name="email" class="form-control" placeholder="Email">
                     <div class="input-group-append">
                         <div class="input-group-text">
                             <span class="fas fa-envelope"></span>
                         </div>
                     </div>
                 </div>
                 <div class="input-group mb-3">
                     <input type="password" name="password" class="form-control" placeholder="Password">
                     <div class="input-group-append">
                         <div class="input-group-text">
                             <span class="fas fa-lock"></span>
                         </div>
                     </div>
                 </div>
                 <button type="submit" class="btn btn-primary btn-block">Sign In</button>
             </form>
         </div>
     </div>
 </div>
 @endsection