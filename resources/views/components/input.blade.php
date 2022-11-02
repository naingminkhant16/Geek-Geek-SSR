@props(['type'=>'text','name'=>'Example Name','error'=>null,'value'=>null,'label'=>'Example label'])
<div class="form-floating mb-3">

    <input type="{{$type}}" class="form-control
    @error($error) is-invalid @enderror" id="floatingInput{{$name}}" placeholder="Your ..." name="{{$name}}"
        value="{{$value}}">

    <label for="floatingInput">{{$label}}</label>

    @error($error)
    <span class="invalid-feedback" role="alert">
        <strong class="">*{{ $message }}</strong>
    </span>
    @enderror

</div>
