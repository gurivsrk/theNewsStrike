@extends('layouts.app', [
    'class' => 'Categories & Tags',
    'elementHead' => 'form-category',
    'elementSub' => 'form-category',
])
@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title ">Categoies & Tags</h4>
              <p class="card-category"> Here you can manage Form Categories</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                       <form class="p-4" method="post" action="{{ (empty($cateUpdate))?route('category.store'):route('category.update',$cateUpdate->id)}}" enctype="multipart/form-data">
                       @if(!empty($cateUpdate))
                        @method('put')
                       @endif
                       <h4 class="card-title mb-4">Add Category/Tag </h4>
                            @csrf
                                <div class="{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <x-input id="input-name"  title="Name" placeholder="{{ __('Name') }}" name="name" type='text' :value="old('slug',@$cateUpdate->name)" :required=true/>
                                </div>
                                <div class="{{ $errors->has('bg_color') ? ' has-danger' : '' }}">
                                    <x-input id="input-bg_color"  title="Background Color"  name="bg_color" type='color' :value="old('slug',@$cateUpdate->bg_color)" />
                                </div>
                                <div class="">
                                    <label class="{{ $errors->has('name') ? ' has-danger' : '' }}">{{ __('Type') }} <sup class='text-danger'>*</sup></label>
                                   <select name="type" class="form-control custom-select" aria-required="true" required>
                                        <option hidden value="">Please Select One</option>
                                        <option value="category" {{(@$cateUpdate->type === "category")?"selected" : " "}}>Category</option>
                                        <option value="tag"  {{(@$cateUpdate->type === "tag")?"selected" : " "}}>Tag</option>
                                   </select>
                                </div>
                                @if ($errors->has('type'))
                                        <span id="type-error" class="error text-danger" for="input-type">{{ $errors->first('type') }}</span>
                                    @endif
                                    <label class="mt-4">Category for ? <sup class='text-danger'>*</sup></label>
                                <div class="form-check form-check-radio {{ $errors->has('cateFor') ? ' has-danger' : '' }}">
                              </div>
                                <div class="form-check form-check-radio {{ $errors->has('cateFor') ? ' has-danger' : '' }}">
                                  <label class="form-check-label text-dark">
                                      <input class="form-check-input vsrk-jquery-radio" data-attr="select-parent" type="radio" name="for" id="cateFor1" value="Form" {{(@$cateUpdate->for ==='Form' )?"checked" : " "}}  aria-required="true" required>
                                      For Forms
                                      <span class="form-check-sign"></span>
                                  </label>
                              </div>
                              <div class="form-check form-check-radio {{ $errors->has('cateFor') ? ' has-danger' : '' }}">
                                  <label class="form-check-label text-dark">
                                      <input class="form-check-input vsrk-jquery-radio" data-attr="select-parent" type="radio" name="for" id="cateFor3" value="faqs" {{(@$cateUpdate->for ==='faqs' )?"checked" : " "}}  aria-required="true" required>
                                      For Faqs
                                      <span class="form-check-sign"></span>
                                  </label>
                              </div>
                              <div class="form-check form-check-radio {{ $errors->has('cateFor') ? ' has-danger' : '' }}">
                                  <label class="form-check-label text-dark">
                                      <input class="form-check-input vsrk-jquery-radio" data-attr="select-parent" type="radio" name="for" id="cateFor4" value="all"  {{(@$cateUpdate->for ==='all' )?"checked" : " "}} aria-required="true" required>
                                      For Blog or Other
                                      <span class="form-check-sign"></span>
                                  </label>
                              </div>
                                <div id="select-parent" style="{{ (!empty($cateUpdate))?'':'display: none;'}}">
                                    <div class="col p-0">
                                        <label class="">{{ __('Category Logo') }}</label>
                                        <x-insert-img for='logo' :src="old('logo',getImageById(@$cateUpdate->logo))" />
                                        @if ($errors->has('logo'))
                                                <span id="logo-error" class="error text-danger" for="input-logo">{{ $errors->first('logo') }}</span>
                                            @endif
                                    </div>
                                </div>

                              @if ($errors->has('for'))
                                        <span id="for-error" class="error text-danger" for="input-for">{{ $errors->first('for') }}</span>
                                    @endif
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <input class="btn {{(!empty(@$type))?'btn-warning':'btn-success'}} " name="Submit" type="submit" value="{{(!empty(@$type))?'Update':'Submit'}}"/>
                                </div>
                       </form>
                    </div>
                    <div class="col-md-8">
                    <div class="table-responsive">
                <table class="table table-sort2">
                  <thead >
                        <tr>
                          <th>Sno.</th>
                          <th>Logo</th>
                          <th>Name</th>
                          <th>Type</th>
                          <th>For</th>
                          <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                  <tbody>
                    @foreach($category as $key=>$cate)
                      <tr>
                          <td>{{++$key}}</td>
                          @if(@$cate->logo)
                            <td><img src="{{getImageById($cate->logo)}}" width="60px"></td>
                          @else
                            <td>-</td>
                          @endif
                          <td>{{ @$cate->name}}</td>
                          <td>{{ @$cate->type }}</td>
                          <td> {{ @$cate->for }}</td>
                          <td class="td-actions text-center">
                          <a rel="tooltip nofollow" class="btn btn-success btn-link" href="{{route('category.edit',$cate->id)}}"> <i class="material-icons">edit</i> </a>
                          <form action="{{ route('category.destroy',$cate->id) }}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                              @method('delete')
                              @csrf
                              <button class="btn btn-danger btn-link"> <i class="material-icons">delete</i> </button>
                          </form>
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
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
      // Jquery select show/hide
  $('.vsrk-jquery-radio').click(function(){
    var $thiss = $(this)
    $('.content-type').slideUp()
    if($thiss.val() === "Form" || $thiss.val() === "all" || $thiss.val() === "youtube" || $thiss.val() === "image"){
      $('#'+$thiss.data('attr')).find('select').removeAttr('disabled');
      $('#'+$thiss.data('attr')).find('input').removeAttr('disabled');
      $('#'+$thiss.data('attr')).slideDown();
    }
    else{
      $('#'+$thiss.data('attr')).find('select').attr('disabled','true');
      $('#'+$thiss.data('attr')).find('input').attr('disabled','true');
       $('#'+$thiss.data('attr')).slideUp();
    }
  })
</script>
@endpush

@endsection
