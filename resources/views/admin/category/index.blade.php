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
                       <h4 class="card-title mb-4">Add Category/Tag</h4>
                            @csrf
                                <div class="{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="">{{ __('Name') }}</label>
                                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', @$cateUpdate->name) }}" required="true" aria-required="true"/>
                                    @if ($errors->has('name'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="">
                                    <label class="">{{ __('Type') }}</label>
                                   <select name="type" class="form-control custom-select" aria-required="true" required>
                                        <option hidden value="">Please Select One</option>
                                        <option value="scheme_category"  {{(@$cateUpdate->type === "scheme_category")?"selected" : " "}}>Scheme Category</option>
                                        <option value="scheme_sub_category"  {{(@$cateUpdate->type === "scheme_sub_category")?"selected" : " "}}>Scheme Sub Category</option>
                                        <option value="scheme_market"  {{(@$cateUpdate->type === "scheme_market")?"selected" : " "}}>Scheme Market</option>
                                        <option value="scheme_type"  {{(@$cateUpdate->type === "scheme_type")?"selected" : " "}}>Scheme Type</option>
                                        <option value="sector"  {{(@$cateUpdate->type === "sector")?"selected" : " "}}>Sector</option>
                                        <option value="amc"  {{(@$cateUpdate->type === "amc")?"selected" : " "}}>AMCs</option>
                                        <option value="category" {{(@$cateUpdate->type === "category")?"selected" : " "}}>Category</option>
                                        <option value="tag"  {{(@$cateUpdate->type === "tag")?"selected" : " "}}>Tag</option>
                                   </select>
                                </div>
                                @if ($errors->has('type'))
                                        <span id="type-error" class="error text-danger" for="input-type">{{ $errors->first('type') }}</span>
                                    @endif
                                    <label class="mt-4">Category for ?</label>
                                <div class="form-check form-check-radio {{ $errors->has('cateFor') ? ' has-danger' : '' }}">
                                <label class="form-check-label text-dark">
                                      <input class="form-check-input vsrk-jquery-radio" data-attr="select-parent" type="radio" name="for" id="cateFor0" value="MFFactSheet" {{(@$cateUpdate->for ==='MFFactSheet' )?"checked" : " "}}  aria-required="true" required>
                                      For MF-Factsheet
                                      <span class="form-check-sign"></span>
                                  </label>
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
                                      <input class="form-check-input vsrk-jquery-radio" data-attr="select-parent" type="radio" name="for" id="cateFor2" value="Career" {{(@$cateUpdate->for ==='Career' )?"checked" : " "}}  aria-required="true" required>
                                      For Career
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
                                      <input class="form-check-input vsrk-jquery-radio" data-attr="select-parent" type="radio" name="for" id="cateFor4" value="other"  {{(@$cateUpdate->for ==='other' )?"checked" : " "}} aria-required="true" required>
                                      For Blog or Other
                                      <span class="form-check-sign"></span>
                                  </label>
                              </div>
                                <div id="select-parent" style="{{ (!empty($cateUpdate))?'':'display: none;'}}">
                                    <label class="">{{ __('Parent') }}</label>
                                   <select name="parent_id" class="form-control custom-select" {{ (!empty($cateUpdate))? "" : "disabled=true" }} >
                                        <option hidden value="">Please Select One</option>
                                        @if(!empty($cateUpdate->parent))
                                          <option value="">Remove Parent</option>
                                        @endif
                                        @foreach($category as $key=>$cate)
                                          @if(@$cate->name !== @$cateUpdate->name)
                                            <option value="{{ @$cate->id }}" {{(@$cateUpdate->parent_id === @$cate->id )?"selected" : " "}}>{{ @$cate->name }}</option>
                                          @endif
                                        @endforeach
                                   </select>
                                    <div class="col p-0">
                                        <label class="">{{ __('Category Logo') }}</label>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview fileinput-exists thumbnail img-raised">
                                            @if(!empty($cateUpdate) && !empty($cateUpdate->logo))
                                                <img src="{{asset(@$cateUpdate->logo)}}">
                                            @endif
                                            </div>
                                                <a href="#pablo" class="fileinput-exists" data-dismiss="fileinput">
                                                <i class="fa fa-times"></i></a>
                                            <div id="vsrkInputImg">
                                                <span class="btn btn-raised btn-file">
                                                  <input type="file" name="logo">
                                                </span>
                                            </div>
                                        </div>
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
                <table class="table table-sort">
                  <thead >
                        <tr>
                          <th>Id</th>
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
                          <td>{{@$cate->id}}</td>
                          @if(@$cate->logo)
                            <td><img src="{{asset($cate->logo)}}" width="60px"></td>
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
                {{@$category}}
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
