@extends('layouts.app', [
    'class' => 'Create Custom Code',
    'elementHead' => 'customization',
    'elementSub' => 'customCode',
])
@section('content')
@push('css')
    <link href="{{ asset('paper/codemirror/lib/codemirror.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('paper/codemirror/addon/hint/show-hint.css' )}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('paper/codemirror/theme/monokai.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .cm-s-monokai .CodeMirror-linenumber {
            width: 24px !important;
        }
    </style>
        <!-- The CodeMirror -->
        <script src="{{asset('paper/codemirror/lib/codemirror.js')}}" type="text/javascript"></script>
        <!-- The CodeMirror Modes - note: for HTML rendering required: xml, css, javasript -->
        <script src="{{asset('paper/codemirror/addon/hint/show-hint.js')}}" type="text/javascript"></script>
        <script src="{{asset('paper/codemirror/addon/hint/css-hint.js')}}" type="text/javascript"></script>
        <script src="{{asset('paper/codemirror/addon/hint/javascript-hint.js')}}" type="text/javascript"></script>
        <script src="{{asset('paper/codemirror/mode/css/css.js')}}" type="text/javascript"></script>
        <script src="{{asset('paper/codemirror/mode/javascript/javascript.js')}}" type="text/javascript"></script>
@endpush

<div class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title ">Custom Code</h4>
              <p class="card-category"> Here you can manage Custom Code (like: js, css, html)</p>
            </div>
            <div class="card-body">
              <div id="GD-section">
                  <div class="row">
                    <div class="col-md-12">
                      <form method="post" action="{{@$data->id ? route('custom-code.update',[$data->id]):route('custom-code.store')}}" enctype="multipart/form-data">
                        @csrf
                        @if(@$data->id)
                            @method('put')
                        @endif
                        <div class="row">
                            <div class="col-md-9">
                                <div class="col-md-12 form-group">
                                     <h6 class="mb-2">{{ __('Page Name') }}</h6>
                                    <input type="text" name="page_name" placeholder="Name" value="{{old('page_name',@$data->page_name)}}" class="form-control" required="" aria-required="true" >
                                    @if ($errors->has('page_name'))
                                        <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('page_name') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-12 form-group">
                                     <h6 class="mb-2">{{ __('Page Type') }}</h6>
                                    <select id="pageType" class="form-control custom-select" name="type" required="" aria-required="true" >
                                        <option hidden="" value="" >Please Select Page Type</option>
                                        <option value="javascript" {{@$data->type == "javascript" ?'selected':'' }}>JS</option>
                                        <option value="css" {{@$data->type == "css" ?'selected':'' }}>CSS</option>
                                        <option value="html"{{@$data->type == "html" ?'selected':'' }}>HTML</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-12 form-group">
                                  <textarea name="code" id="code" rows="1" class="form-control" >
                                    {{@$data->linking == "external" ?(Storage::get($data->code)):old('code',@$data->code)}}
                                </textarea>
                                  @if ($errors->has('code'))
                                    <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('code') }}</span>
                                  @endif
                                  <span class="text-danger">**use tab for hints</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="seotype-section px-0 py-0">
                                    <h5 class="card-title mb-2" style="background: #25c5d9;">Other Options:</h5>
                                    <div class="px-2">
                                        <label class="">{{ __('Linking type:') }}</label>
                                        <div class="col-md-12 form-group">
                                            <div class="form-check form-check-radio col-md-6">
                                                <label class="form-check-label text-dark">
                                                    <input class="form-check-input"  data-attr="image-parent" type="radio" name="linking" id="radio-external" value="external" {{@$data->linking == "external" ?'checked':'' }} {{@$data->type == "html" ?'disabled':'' }}>
                                                    External
                                                    <span class="form-check-sign"></span>
                                                </label>

                                            </div>
                                            <div class="form-check form-check-radio col-md-6">
                                                <label class="form-check-label text-dark">
                                                    <input class="form-check-input" data-attr="image-parent" type="radio" name="linking" id="radio-internal" value="internal"  {{@$data->linking == "internal" ?'checked':'' }}>
                                                    Internal
                                                    <span class="form-check-sign"></span>
                                                </label>

                                            </div>
                                            @if ($errors->has('linking'))
                                                <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('linking') }}</span>
                                            @endif
                                        </div>
                                            <label class="">{{ __('Where on page:') }}</label>
                                            <div class="col-md-12 form-group">
                                            <div class="form-check form-check-radio ">
                                                <label class="form-check-label text-dark">
                                                    <input class="form-check-input" id="radio-head" data-attr="image-parent" type="radio" name="where"  value="head"  {{@$data->where == "head" ? 'checked':'' }}>
                                                    In the head element
                                                    <span class="form-check-sign"></span>
                                                </label>

                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label text-dark">
                                                    <input class="form-check-input" id="radio-body" data-attr="image-parent" type="radio" name="where"  value="body" {{@$data->where == "body" ? 'checked':'' }}>
                                                    within body element
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label text-dark">
                                                    <input class="form-check-input" id="radio-footer" data-attr="image-parent" type="radio" name="where"  value="footer" {{@$data->where == "footer" ? 'checked':'' }}>
                                                    In the footer element
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                            @if ($errors->has('where'))
                                                <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('where') }}</span>
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

     <script type="text/javascript">
            document.getElementById('pageType').addEventListener('change',function(){
                if(this.value == "html"){
                    document.getElementById('radio-external').setAttribute('disabled',true)
                }
                else{
                    document.getElementById('radio-external').removeAttribute('disabled')
                }
            })

              var editor = CodeMirror.fromTextArea(code, {
                mode: 'html',
                tabSize:1,
                lineNumbers: true,
                matchBrackets: true,
                indentUnit: 4,
                theme : 'monokai',
                extraKeys: { "Tab": "autocomplete" }
              });

              editor.setCursor({line: 3});
              editor.setSize('100%', '100%');
              editor.on('change',()=>{
                custom.confirmClose()
              })

              $('#pageType').on('change', function(){
                  editor.setOption("mode", $(this).val());
              })
              @if(@$data->type)
                editor.setOption("mode","{{@$data->type}}");
              @endif
              //    var editor = CodeMirror(document.getElementById('codeEditor'), {
              // console.log(editor.getValue())
     </script>
@endpush
@endsection
