<div class="form-floating mb-3">

    <input type="{{$type??'text'}}" class="form-control
    @error($error) is-invalid @enderror" id="floatingInput" placeholder="Your ..." name="{{$name}}"
        value="{{$value??null}}">

    <label for="floatingInput">{{$label??'Example Label'}}</label>

    @error($error)
    <span class="invalid-feedback" role="alert">
        <strong class="">*{{ $message }}</strong>
    </span>
    @enderror

</div>
