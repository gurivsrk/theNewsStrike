<div class="row">
    <div id="uploadMedia" class="card-body pt-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header">
                        <h5>Upload Image</h5>
                    </div>
                    <form method="post" class="dropzone" action="{{ route('gallery.index')}}" id="dropZone-file-upload"></form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="toolbar">
                    <nav class="navbar bg-body-tertiary py-0 mb-0">
                        <div class="container-fluid">
                            <div class="button-section">
                                <button id="add-media" class="btn btn-primary my-0 ml-2" style="padding:7px 15px " onclick="custom.toggleBtn(this)" data-id="uploadMedia">Add Media</button>
                                @if(url()->current() == route('gallery.index'))
                                    @can('admin')
                                        <button id="deletePermanently" class="btn btn-outline-primary my-0 d-none" onclick="custom.deleteBulk" data-class="media-checkbox">Delete Permanently</button>
                                        <button class="btn btn-outline-primary my-0" onclick="custom.bulkSelect(this)" data-class="media-checkbox">Bulk Select</button>
                                    @endcan
                                @else
                                <button class="btn btn-outline-primary my-0" onclick="custom.insertImage(this)" data-class="media-checkbox">Insert Image</button>
                                @endif
                            </div>
                            <x-search  hide="media"  type="search" for="gallery"/>
                        </div>
                      </nav><hr>
                </div>
                <div id="media">
                    @include('partials.galleryView')
                </div>
                {{-- <div class="media-navigation mt-4 mb-2">
                    @if(url()->current() == route('gallery.index'))
                        {{ $media->links() }}
                    @endif
                </div> --}}
            </div>
        </div>
    </div>
</div>

