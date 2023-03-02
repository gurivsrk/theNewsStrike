<style>
    #dyna-select { border-bottom: 1px solid #a0a0a0;width: 100%; min-height: 2.9rem;height: auto}
    .dyna-input{ border: none;width: 100%;margin-top: 45px;}
    .dyna-list{padding: 5px 5px 5px 0px; background: #d8d8d8;font-size: 13px; margin-right: 5px;margin: 2px;display: inline-block;line-height: 15px;border-radius: 5px;font-weight: 400}
    .dyna-text{padding-left: 5px}
    .close-span{padding: 5px;font-weight: 800;cursor: pointer;border-right: 1px solid #aaaaaa;color: #999999;font-size: 10px}
    .text-danger{font-size: 12px;position: relative;z-index: 11;}
    #div-input {
        border: 1px solid #a0a0a0;
        border-top: none;
        padding: 5px;
        position: absolute;
        width: 100%;
        display: none;
        z-index: 10;
        background: #fff;
    }
    #div-input:hover{
        display: block !important;
    }
    #dyna-ajax-val {
        display: none;
        background: #e6e6e6;
        padding: 0;
        margin: 0;
        text-transform: capitalize;
        max-height: 200px;
        height: 100%;
        overflow-y: scroll;
    }
    #dyna-ajax-val li {
        list-style: none;
        cursor: pointer;
        padding: 5px 10px;
    }
    #dyna-ajax-val li:hover{
        background: #00bcd4;
        color: #fff;
    }
    input:focus-visible {
        outline:none;
    }
</style>
<section class="dyna-section position-relative">
    <div id="dyna-select">
        <span id="dyna-list" class="{{!empty($tags) && is_array($tags)?'hasList':''}}">
            @if(!empty($tags))
                @foreach ($tags as $tag)
                <span class="dyna-list" id="{{$tag}}"><span class="close-span">X</span><span class="dyna-text">{{$tag}}</span></span>
                @endforeach
            @endif
        </span>
        <input type="hidden" name="tags" id="dyna-tags">
    </div>
    <div id="div-input">
        <input class="dyna-input">
        <ul id="dyna-ajax-val"></ul>
    </div>
    <span class="text-dark text-sm">*use comma (",") or press enter to add new tag or paste tags</span>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
//// required functions
const addTagsToInput = () =>{
    let inputData = [];
    $('.dyna-list').each(function(){
        if(($(this).children('.dyna-text').text()).trim().length > 2){
            inputData.push($(this).children('.dyna-text').text())
        }
    })
    $('#dyna-tags').val(inputData)
}

const addList = (paste,data) =>{
    if(paste){
        let uniqueData = [...new Set(data)]
        nu = 0;
        if(!($('#dyna-list').hasClass('hasList'))){
            uniqueData.forEach(element => {
                $('#dyna-list').append(
                    '<span class="dyna-list" id="'+element.trim().replaceAll(' ','_').toLowerCase()+'"><span class="close-span">X</span><span class="dyna-text">'+element.trim()+'</span></span>'
                )
            })
        }
        else{
            // console.log(uniqueData)
        uniqueData.forEach(element => {
          $('.dyna-list').each(function(){
              if($(this).children('.dyna-text').text().trim() === element.trim()) nu++
            })
            if(nu < 1) {
                $('#dyna-list').append(
                    '<span class="dyna-list" id="'+element.trim().replaceAll(' ','_').toLowerCase()+'"><span class="close-span">X</span><span class="dyna-text">'+element.trim()+'</span></span>'
                )
            }
          })
        }
    }else{
        const nu = 0,
            span= '<span class="dyna-list" id="'+data.trim().replaceAll(' ','_').toLowerCase()+'"><span class="close-span">X</span><span class="dyna-text">'+data.trim()+'</span></span>';
        if(!($('#dyna-list').hasClass('hasList'))){ $('#dyna-list').append(span)}
        else{
          $('.dyna-list').each(function(){
              if($(this).children('.dyna-text').text().trim() === data.trim()) nu++
          })
          if(nu < 1) $('#dyna-list').append(span)
        }
    }
    $('#dyna-list').addClass('hasList')
  $('.dyna-input').val('')
}

const liClick  = () => {
    $('#dyna-ajax-val li').on('click',function(){
        addList(false, $(this).text().toLowerCase())
        addTagsToInput()
    });
}

// remove tag
const closeSpan = () =>{
    $('.close-span').on('click',function(){
        $(this).parent().remove()
    })
}


// add tag
const crtKey = 17, vKey = 86, enterKey = 13,commaKey = 188;
let crtlPress = false;

$('.dyna-input').keydown((e) =>{ if(crtKey == e.which) crtlPress = true })
.keyup((e) =>{ if(crtKey == e.which)  crtlPress = false })

$('.dyna-input').keyup(function(e){
    let data = $(this).val()
    if(crtlPress && (e.which == vKey)){ addList(true,$('.dyna-input').val().split(',')) }
    if(e.which == enterKey || e.which ==  commaKey){
        e.preventDefault()
        addList(false, $('.dyna-input').val().replace(',',''))
    }
    $.ajax({
        url:'{{route("getDynaTags")}}',
        type:'Post',
        headers:{"X-CSRF-TOKEN":"{{ csrf_token() }}"},
        data:{input:data},
        beforeSend:()=>{},
        success: (result)=>{
            //console.log(result)
            let liArray = [];
            if(Array.isArray(result)) result.forEach((tags) => liArray.push(`<li data-id="${tags.id}">${tags.name}</li>`))
            $('#dyna-ajax-val').perfectScrollbar().html(liArray).show()
            liClick()
        }
    })
    addTagsToInput()
})


$('#dyna-select').on('click',() => { closeSpan(); $('#div-input').show(); $('.dyna-input').focus() });
$('.dyna-input').on('blur',()=> { $('#div-input').hide(); addTagsToInput() });

addTagsToInput();closeSpan();
</script>
