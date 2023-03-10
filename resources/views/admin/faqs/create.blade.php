@extends('layouts.app', [
    'class' => 'Create FAQs',
    'elementHead' => 'faqs',
    'elementSub' => 'faqs',
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
              <h4 class="card-title ">Create New FAQ</h4>
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
                        <form method="post"  id="add-form" action="{{(@$type != 'edit-faqs')?route('faqs.store'):route('faqs.update',$faqs->id)}}" enctype="multipart/form-data">
                            @if(@$type =='edit-faqs')
                                    @method('put')
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-11 {{ $errors->has('categories') ? ' has-danger' : '' }}">
                                        <label class="">{{ __('Category') }}</label>
                                       <select name="category_id" class="vsrk-select form-control" aria-required="true" required>
                                           @if(!empty($category))
                                            <option value="">Please Select One</option>
                                                @foreach($category as $cat)
                                                  <option value="{{$cat->id}}" {{($cat->id == @$faqs->category_id)?"selected":""}} > {{$cat->name}}</option>
                                                @endforeach
                                           @endif
                                       </select>
                                        @if ($errors->has('category'))
                                            <span id="category-error" class="error text-danger" for="input-category">{{ $errors->first('category') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 {{ $errors->has('question') ? ' has-danger' : '' }}  mt-4">
                                        <x-input id="input-faqs_name" title="question" placeholder="{{ __('faqs Name') }}" name="question" type='text' :value="old('question',@$faqs->question)" required="true"/>
                                </div>
                                <div class="col-md-12 {{ $errors->has('answer') ? ' has-danger' : '' }} mt-4">
                                    <h6 class="mb-2">Answer <sup class='text-danger'>*</sup></h6>
                                    <div id="editor" class="editor" rows="1">
                                        {!! old('content',@$blog->content) !!}
                                      </div>
                                      <textarea id="editorData" class="d-none" name="answer"></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="btn {{(!empty(@$type))?'btn-warning':'btn-success'}} " name="Submit" type="submit" value="{{(!empty(@$type))?'Update':'Submit'}}"/>
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
