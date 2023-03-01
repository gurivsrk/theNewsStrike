@extends('layouts.app', [
    'class' => 'Create New Posts',
    'elementHead' => 'posts',
    'elementSub' => 'posts',
])
@section('content')
@push('css')

@endpush

<div class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title ">Create New Post</h4>
              @if($errors->any())
                <div class="bg-danger text-light p-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
            <div class="card-body">
              <div id="GD-section">
                  <div class="row">
                    <div class="col-md-12">
                      <form  method="post" action="{{@$data->id ? route('blog.update',[$data->id]):route('blog.store')}}" enctype="multipart/form-data">
                        @csrf
                        @if(@$data->id)
                            @method('put')
                        @endif
                        <div class="my-3">
                            <x-input id="slug"  title="Slug" placeholder="{{url('/')}}/new-post-title" name="slug" type='text' :value="old('slug',url('/').'/'.@$data->slug)" :readOnly=true />
                        </div>
                        <div class="row">

                            <div class="col-md-8">

                                <x-input id="postTitle" title="Title" placeholder="Name" name="title" type='text' :value="old('title',@$data->title)" required="true"/>

                                <div class="col-md-12 form-group">
                                     <h6 class="mb-2">{{ __('Category') }} <sup class='text-danger'>*</sup></h6>
                                    <select id="category" class="form-control custom-select vsrk-select" name="category" required="" aria-required="true" >
                                        <option hidden="" value="" >Please Select Page Type</option>
                                        @if(!empty($categories))
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{@$data->type == $category->id ?'selected':'' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('type'))
                                        <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-12 form-group">
                                    <h6 class="mb-2">{{ __('Content') }} <sup class='text-danger'>*</sup></h6>
                                  <div id="editor" class="editor" rows="1">
                                    {{old('content',@$data->content)}}
                                  </div>
                                  <textarea id="editorData" class="d-none" name="content"></textarea>
                                  @if ($errors->has('code'))
                                    <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('code') }}</span>
                                  @endif
                                </div>
                                @include('partials.seo')
                            </div>
                            <div class="col-md-4">
                                <div class="seotype-section px-0 py-0">
                                    <h5 class="card-title mb-2" style="background: #25c5d9;">Other Options:</h5>
                                    <div class="col-md-12 mb-3">
                                        <h6 class="mb-2">{{ __('Featured Image') }} <sup class='text-danger'>*</sup></h6>
                                        <x-insert-img for='blog_image' :src="old('blog_image',getImageById(@$data->blog_image))" />
                                        @if ($errors->has('blog_image'))
                                            <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('blog_image') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <h6 class="mb-2">{{ __('Tags') }}</h6>
                                        <x-tag-input :allTags="@$catetag" :tags="@$blogs->tags"/>
                                        @if ($errors->has('tags'))
                                            <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('tags') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <h6 class="mb-2">{{ __('Author') }} <sup class='text-danger'>*</sup></h6>
                                        <select id="author" class="form-control custom-select vsrk-select" name="author" required="" aria-required="true" >
                                            <option hidden="" value="" >Please Select Author</option>
                                                @foreach ($authors as $author)
                                                    <option value="{{$author->id}}" {{auth()->id() == $author->id ?'selected':'' }}>{{$author->name}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                    <div class="px-2">
                                        <h6 class="mb-2">{{ __('Status') }} <sup class='text-danger'>*</sup></h6>
                                        <div class="col-md-12 form-group">
                                            <div class="form-check form-check-radio col-md-6">
                                                <label class="form-check-label text-dark">
                                                    <input class="form-check-input"  data-attr="image-parent" type="radio" name="status" id="radio-external" value="1" {{@$data->status ?'checked':'' }}>
                                                    Published
                                                    <span class="form-check-sign"></span>
                                                </label>

                                            </div>
                                            <div class="form-check form-check-radio col-md-6">
                                                <label class="form-check-label text-dark">
                                                    <input class="form-check-input" data-attr="image-parent" type="radio" name="status" id="radio-internal" value="0"  {{@$data->status ?'checked':'' }}>
                                                    Unpublished
                                                    <span class="form-check-sign"></span>
                                                </label>

                                            </div>
                                            @if ($errors->has('status'))
                                                <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('status') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input name="submit" type="submit" class="btn btn-success" value="SUBMIT">
                        </div>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>
@push('scripts')
<script>
CKEditor()

    document.getElementById('postTitle').addEventListener('keyup',function(){
       let slug =  this.value.toLowerCase().trim().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        document.getElementById('slug').value = window.location.origin+'/'+slug
    })

</script>
@endpush
@endsection
