@extends('layouts.app', [
    'class' => 'Gallery',
    'elementHead' => 'gallery',
    'elementSub' => 'gallery',
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">Gallery</h4>
                            <p class="card-category">Manage your media here</p>
                          </div>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.gallery')
    </div>

    <div id="ajaxShowModel"></div>

    @push('scripts')
    <script>
       $('#deletePermanently').on('click',function(){
        if($('input[role="mediaCheckbox"]:checked').length > 0){
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
                    $('#media').html(response);
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
