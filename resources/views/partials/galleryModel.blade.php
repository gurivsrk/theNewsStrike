
<div id="mediaModel">
    <div id="model-body" class="position-relative">
        <div class="close" onclick="closeModel('mediaModel')" >X</div>
        <div class="model-body">
            <h6 class="m-0 py-0 px-3"><b>Image Details:</b></h6>
            <hr class="m-0">
                <div class="row">
                <div id="images" class="col-sm-7 mt-2">
                    <img src="{{asset(@$media->fileUrl)}}">
                </div>
                <div id="images-details" class="col-sm-5">
                    <div class="images-details mt-2">
                        <p class="mb-1">Uploaded on: <span>{{@$media->created_at}}</span></p>
                        <p class="mb-1">File name: <span>{{@$media->fileName}}</span></p>
                        <p class="mb-1">File type: <span>{{@$media->fileMime}}</span></p>
                        <p class="mb-1">File size: <span>{{@$media->fileSize}}</span></p>
                    </div><hr>
                    <div class="img-form">
                        <div class="form-group">
                            <label>Alternative Text</label>
                            <input name="alt" class="form-input " data-id={{@$media->id}} onblur="updateValue(this)" value="{{$media->alt ? old('alt',$media->alt) : $media->fileName}}">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" class="form-input" data-id={{@$media->id}} onblur="updateValue(this)" value="{{$media->title ? old('alt',$media->title) : $media->fileName}}">
                        </div>
                        <div class="form-group">
                            <label>Caption</label>
                            <input name="caption" class="form-input" data-id={{@$media->id}} onblur="updateValue(this)" value="{{old('alt', @$media->caption)}}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-input" data-id={{@$media->id}} onblur="updateValue(this)">  {{old('alt', @$media->description)}} </textarea>
                        </div>
                        <div class="form-group">
                            <label>Url <sup>(* click url link to copy)</sup></label>
                            <input value="{{asset(@$media->fileUrl)}}" onclick="copyToClipboard(this)" class="form-input cursor-pointer" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    function updateValue($this){
        if($this.value.trim().length > 0){
            ajaxCall(
                'http://127.0.0.1:8001/process/ajax-requests',
                {
                    'id' : $this.getAttribute('data-id'),
                    'data':$this.value,
                    'type': $this.getAttribute('name'),
                    'dataFor':'updateImageDetails',
                },
                (response)=>{
                    console.log(response)
                    custom.showNotification('top','right','Updated Successfully','success')
                },
                (err)=>{
                    console.error(err.responseText)
                }
            )
        }
    }
</script>
