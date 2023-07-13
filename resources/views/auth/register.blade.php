@extends('components/layout')

@section('content')
@include('components/_navbar')
    
<section class="h-100 bg-light">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card card-registration my-4">
            <div class="row g-0">
              <div class="col-xl-6 d-none d-xl-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                  alt="Sample photo" class="img-fluid"
                  style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
              </div>
              <div class="col-xl-6">
                <div class="card-body p-md-5 text-black">
                  <h3 class="mb-5 text-uppercase">Register Your Account</h3>
  
                  <form class='m-5 ps-5 pe-5' action="/store" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="form-outline mb-4">
                        @error('name')
                            <small class="text-danger m-1">{{$message}}</small class="text-danger m-1">
                        @enderror
                        <input type="name" id="form3Example9" name="name" class="form-control form-control-lg" value="{{old('name')}}" />
                        <label class="form-label" for="form3Example9">Username</label>
                      </div>

                    <div class="form-outline mb-4">
                        @error('email')
                            <small class="text-danger m-1">{{$message}}</small class="text-danger m-1">
                        @enderror
                        <input type="email" id="form3Example9" name="email" class="form-control form-control-lg" value="{{old('email')}}" />
                        <label class="form-label" for="form3Example9">Email</label>
                    </div>
    
                
                    <div class="form-outline mb-4">
                        @error('password')
                            <small class="text-danger m-1">{{$message}}</small class="text-danger m-1">
                        @enderror
                        <input type="password" id="form3Example9" name="password" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example9">Password</label>
                    </div>
  
                    <div class="form-outline mb-4">
                        @error('password_confirm')
                            <small class="text-danger m-1">{{$message}}</small class="text-danger m-1">
                        @enderror
                        <input type="password" name="password_confirmation" id="form3Example97" name="password_confirm" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example97">Password Confirmation</label>
                    </div>
    
                    <div class="d-flex justify-content-end pt-3">
                        <button type="submit" class="btn btn-dark w-100 btn-lg ms-2 mb-2 text-light">Register</button>
                    </div>

                    <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a href="/sign-in"
                      style="color: #393f81;">Login here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>

                </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection