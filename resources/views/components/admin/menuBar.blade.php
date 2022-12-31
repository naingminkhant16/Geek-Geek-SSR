<div class="d-flex justify-content-between align-items-center bg-white rounded-3 p-3 shadow">
    <div class="">
        {{$slot}}
    </div>
    <div class="">
        <form action="">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Posts" name="search"
                    value="{{request('search')}}">
                <button class="btn btn-primary text-white" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>
