@props(['type'=>'text',
'name'=>'Example Name',
'value'=>null,
'label'=>'Example label'])
<div class="form-floating mb-3">

    <input type="{{$type}}" class="form-control
    @error($name) is-invalid @enderror" id="floatingInput{{$name}}" placeholder="Your ..." name="{{$name}}"
        value="{{$value}}">

    <label for="floatingInput">{{$label}}</label>

    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong class="">*{{ $message }}</strong>
    </span>
    @enderror

</div>