@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'gallery'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="card-title">Gallery</h5>
                        <button class="btn btn-success ml-2 toggleBtn" data-id="uploadMedia">Add Media</button>
                    </div>
                    <div id="uploadMedia" class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-plain">
                                    <div class="card-header">
                                        <h5 class="card-title">Upload Image</h5>
                                    </div>
                                    <form method="post" class="dropzone" action="{{ route('gallery.index')}}" id="dropZone-file-upload"></form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="toolbar">
                            <nav class="navbar bg-body-tertiary py-0 mb-0">
                                <div class="container-fluid">
                                    <div class="button-section">
                                        <button id="deletePermanently" class="btn btn-outline-primary my-0 d-none" onclick="custom.deleteBulk" data-class="media-checkbox">Delete Permanently</button>
                                        <button class="btn btn-outline-primary my-0" onclick="custom.bulkSelect(this)" data-class="media-checkbox">Bulk Select</button>
                                    </div>
                                  <form class="d-flex" role="search">
                                    <input id="ajaxSearch" class="form-control me-2" type="search" placeholder="Search" data-hide="media" data-for="gallery"  aria-label="Search">
                                  </form>
                                </div>
                              </nav><hr>
                        </div>
                        <div id="media">
                            @include('partials.galleryView')
                        </div>
                        <div id="ajaxResult"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="ajaxShowModel"></div>

    @push('scripts')
    <script>
        Dropzone.options.dropZoneFileUpload = {
           url: '{{route("gallery.store")}}',
           maxFilesize: 20, // MB
           acceptedFiles: '.jpeg,.jpg,.png,.gif',
           headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}"
           },
           paramName: 'dropZoneImage',
           success: function (file, response) {
            $('.dz-preview.dz-image-preview').remove();
            $('.dz-message').show();
                $('#media').hide();
               $('#ajaxResult').html(response);
           },
           error: function (file, response) {
               console.log(response)
               if ($.type(response) === 'string') {
                   var message = response //dropzone sends it's own error messages in string
               } else {
                   var message = response.errors.file
               }
               file.previewElement.classList.add('dz-error')
               _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
               _results = []
               for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                   node = _ref[_i]
                   _results.push(node.textContent = response.message)
               }

               return _results
           }
       };

       $('#deletePermanently').on('click',function(){
        if($('input[name="mediaCheckbox"]:checked').length > 0){
            if(prompt('Enter DELETE for bulk deletion') == 'DELETE'){
                const $this = $(this),
                    inputClass = $this.data('class'),
                    selected = document.getElementsByClassName(inputClass);
                let ids = [];

                for(let checkbox of selected){
                    if(checkbox.checked){
                        ids.push(checkbox.value)
                    }
                }

                ajaxCall(
                '{{route("gallery.massDelete")}}',
                {ids},
                (response)=>{
                    $('#media').hide();
                    $('#ajaxResult').html(response);
                    custom.showNotification('top','right','Deleted Successfully','success')
                },(err)=>{
                    custom.showNotification('top','right',err.responseJSON.message+'! Only admin can perfom this action','danger')
                    console.error(err.responseJSON.message)
                },()=>{
                    $this.attr('disabled','disabled')
                })
            }
        }
       })
     </script>
    @endpush
@endsection
