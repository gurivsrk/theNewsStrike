<div class="col-md-12 form-group">
    <h6 class="mb-2">{{@$title}} <sup class='text-danger'>{{@$required ?"*":''}}</sup></h6>
    @if($type != "textarea")
        <input id="{{@$id}}" type="{{@$type}}" name="{{@$name}}" placeholder="{{@$placeholder}}" value="{{@$value}}" class="form-control" {{@$required?'required aria-required="true"':''}} {{@$readOnly?'readonly':''}}>
    @else
        <textarea id={{@$id}} {{@$readOnly?'readonly':''}} name="{{@$name}}"  class="form-control" {{@$required?'required aria-required="true"':''}}>{{@$value??@$placeholder}}</textarea>
    @endif
        @if ($errors->has(@$name))
            <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first(@$name) }}</span>
        @endif
</div>
