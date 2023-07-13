@extends('components/layout')


@section('content')
@include('components/_navbar')
    
<section class="" style="background-color: #ffffff;">
  <div class="container py-2 h-100">
    <div class="row d-flex justify-content-center align-items-center h">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
         
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body text-black">

                <form action="/create_post" method="post">
                  @csrf
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-gem fa-2x me-3" style="color: #000000;"></i>
                    <span class="h1 fw-bold mb-0">Laravel Blog</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Create a New Post</h5>

                  <div class="form-outline mb-4">
                    @error('title')
                        <small class="text-danger m-1">{{$message}}</small class="text-danger m-1"> <br>
                    @enderror
                    <label class="form-label" for="form2Example17">Title</label>
                    <input type="text" id="form2Example17" name="title" class="form-control" value="{{old('title')}}" />
                  </div>

                  <div class="form-outline mb-4">
                    @error('category_id')
                        <small class="text-danger m-1">{{$message}}</small class="text-danger m-1"> <br>
                    @enderror
                    <label class="form-label" for="form2Example17">Category</label>
                    <select name="category_id" class="form-control" id="">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach

                    </select>
              
                  </div> 
                  <div class="form-outline mb-4">
                    @error('tags')
                        <small class="text-danger m-1">{{$message}}</small class="text-danger m-1"> <br>
                    @enderror
                    <label class="form-label" for="form2Example27">Tags</label>
                    <input type="text" id="form2Example27" list="tag_list" name="tags" class="form-control" placeholder="Separate with comma" value="{{old('tags')}}" />

                    <datalist id="tag_list">
                        <select id="tag_list">
                            @foreach ($tags as $tag)
                                <option value="{{$tag->name}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </datalist>
                  </div>

                  <div class="form-outline mb-4">
                    @error('body')
                        <small class="text-danger m-1">{{$message}}</small class="text-danger m-1"> <br>
                    @enderror
                    <label class="form-label" for="form2Example27">Body</label>
                    <textarea name="body"class="form-control"  cols="30" rows="10" placeholder="Type your Blog" >{{old('body')}}</textarea> 
                   
                  </div>

                  <input type="hidden" name="user_id" id="form2Example27"  class="form-control" placeholder="Separate with comma" value={{auth()->user()->id}} />
                  <input type="hidden" name="slug" id="form2Example27"  class="form-control" placeholder="Separate with comma" value={{Str::random(10)}} />


                  <div class="pt-1 mb-4">
                    <button type="submit" class="btn btn-dark btn-lg " type="button">Create</button>
                  </div>

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