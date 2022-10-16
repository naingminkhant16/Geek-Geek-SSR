<div class="form-floating mb-3">

    <input type="{{$type??'text'}}" class="form-control
    @error($error ?? null) is-invalid @enderror" id="floatingInput{{$name}}" placeholder="Your ..." name="{{$name}}"
        value="{{$value??null}}">

    <label for="floatingInput">{{$label??'Example Label'}}</label>

    @error($error??null)
    <span class="invalid-feedback" role="alert">
        <strong class="">*{{ $message }}</strong>
    </span>
    @enderror

</div>
