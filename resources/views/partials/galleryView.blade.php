
<div class="row">
    @if(@$media)
        @foreach ($media as $media)
            <div class="col-sm-2 px-1">
                <input type="checkbox"  name="mediaCheckbox" value="{{$media->id}}" class="media-checkbox d-none" id="{{$media->id}}" disabled/>
                <label for="{{$media->id}}" onclick="custom.showImgDetailMode(this)" class="{{url()->current() == route('gallery.index')? 'showModel' : 'selectThis' }}">
                    <img src="{{asset($media->fileUrl)}}" loading="lazy" class="img-thumbnail" alt="{{$media->alt ?? $media->fileName }}" title="{{$media->title ?? $media->fileName }}">
                </label>
            </div>
        @endforeach
    @endif
</div>
<style>
    #showImageAjax #ajaxResult {
    padding: 10px 4vw;
    height: calc(100vh - 200px);
    overflow-y: scroll;
}
</style>
