<div class="row">
    @if(@$media)
        @foreach ($media as $media)
            <div class="col-sm-2 px-1">
                <input type="checkbox" name="mediaCheckbox" value="{{$media->id}}" class="media-checkbox d-none" id="{{$media->id}}" disabled/>
                <label for="{{$media->id}}">
                    <img src="{{asset($media->fileUrl)}}" loading="lazy" class="img-thumbnail" alt="{{$media->alt ?? $media->fileName }}" title="{{$media->title ?? $media->fileName }}">
                </label>
            </div>
        @endforeach
    @endif
</div>
