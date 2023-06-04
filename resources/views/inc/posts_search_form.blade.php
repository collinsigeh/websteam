
<div class="mb-3 py-1 bg-appgrey">
    <form action="{{ route('posts.search') }}" method="get"class="form-inline m-3">
        @csrf
        <div class="input-group">
            <input class="form-control" name="search" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="ItemSearch" />
            <input type="submit" value="Search" class="btn btn-appprimary" id="ItemSearch">
        </div>
    </form>
</div>