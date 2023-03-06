<section class="dyna-section position-relative">
    <div class="dyna-select" id="{{$name}}">
        <span class="dyna-list {{!empty($tags) && is_array($tags)?'hasList':''}}">
                @if(!empty($tags) && is_array($tags))
                    @foreach($tags as $tag)
                        @if((trim($tag))>0)
                            <span class="dyna-list-span" data-id="{{$tag}}"><span class="close-span">X</span><span class="dyna-text">{{$tag}}</span></span>
                        @endif
                    @endforeach
                @endif
        </span>
        <input type="hidden" name="{{$name}}" class="dyna-tags">
    </div>
    <div class="div-input">
        <input class="dyna-input" data-id="{{$name}}">
        <ul class="dyna-ajax-val" data-id="{{$name}}"></ul>
    </div>
    <span class="text-danger">*use comma (",") or press enter to add new {{$name}} or paste it</span>
</section>

<script>

$(`.dyna-input`).keyup(function(e){
    let $this = $(this),
    data = $(this).val();
   $.ajax({
       url:"{{route('getDynaTags')}}",
       type:`Post`,
       headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
       data:{input:data},
       beforeSend:()=>{
        $this.siblings('.dyna-ajax-val').html('loading....').show()
       },
       success: (result)=>{
            liArray = [];
           if(Array.isArray(result)) result.forEach((tags) => liArray.push(`<li data-id="${tags.id}">${tags.name}</li>`))
           $this.siblings(`.dyna-ajax-val`).perfectScrollbar().html(liArray).show()
           liClick()
       }
   })
})
</script>
