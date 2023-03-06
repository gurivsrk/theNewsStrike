
// required functions
function addTagsToInput(pid){
    inputData = [];
   $(`#${pid} .dyna-list-span`).each(function(){
       if(($(this).children(`.dyna-text`).text()).trim().length > 2){
           inputData.push($(this).children(`.dyna-text`).text())
       }
   })
   $(`#${pid} .dyna-tags`).val(inputData)
}

function spanElement(element){
   data = element.trim();
   dataToLower = `<span class="dyna-list-span" id="`+data.replaceAll(` `,`_`).toLowerCase()+`"><span class="close-span">X</span><span class="dyna-text">`+data+`</span></span>`
    if(data.trim().length > 0){
        return  dataToLower;
    }
}

function addListElemet(data,pid){
    let checkDuplicate = false,
    alreadyData = $(`#${pid} .dyna-list .dyna-list-span`).children('.dyna-text').text().trim();

    for(let listSpan of $(`#${pid} .dyna-list .dyna-list-span`)){
        if(listSpan.childNodes[1].innerHTML.trim() === data.trim()){
            checkDuplicate = true;
        }
    }

    if(!checkDuplicate){
        $(`#${pid} .dyna-list`).append(spanElement(data))
        $(`#${pid}`).children('.dyna-list').addClass(`hasList`)
    }

    addTagsToInput(pid)

    $('.dyna-input').val(``)
}

function addList(paste,data,pid){
    if(paste){
        for(let only of new Set(data)){         // used set to remove duplicate tags from array
            addListElemet(only,pid)
        }
        return true
    }

    addListElemet(data, pid);
}

// add tag
const crtKey = 17, vKey = 86, enterKey = 13,commaKey = 188;

$(`.dyna-input`).on('paste',function(){
    let $this = $(this);
    setTimeout(()=>{
        addList(true, $this.val().split(`,`),$this.data('id'))
    },100)
})
$(`.dyna-input`).keyup(function(e){
    let $this = $(this);
    if(e.which == enterKey || e.which ==  commaKey){
        addList(false, $this.val().replace(`,`,``), $this.data('id'))
    }

})

liClick  = () => {
   $(`.dyna-ajax-val li`).on(`click`,function(){
       addList(false, $(this).text().toLowerCase(), $(this).parent().data(`id`))
       addTagsToInput($(this).parent().data(`id`))
   });
}

// remove tag
closeSpan = () =>{
   $(`.close-span`).on(`click`,function(){
       $(this).parent().remove()
   })
}


$(`.dyna-select`).on(`click`,function(){
     closeSpan();
      $(this).siblings(`.div-input`).show();
      $(this).siblings(`.div-input`).children(`.dyna-input`).focus()
    });
$(`.dyna-input`).on(`blur`,function(){
     $(`.div-input`).hide();
     addTagsToInput($(this).data('id'))
    });

for(let sel of document.querySelectorAll('.dyna-select')){
    addTagsToInput(sel.getAttribute('id'))
}

closeSpan();
