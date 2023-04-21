<form action="{{route('users.search')}}" class="">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="search" value="{{request('search')}}">
        <button class="btn btn-primary " type="submit">
            <i class="bi bi-search text-white"></i>
        </button>
    </div>
</form>