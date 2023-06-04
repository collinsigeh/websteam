
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th colspan="2">Post</th>
                <th class="text-center"><span class="d-none d-sm-inline-block">Published</span></th>
                <th class="text-center d-none d-md-table-cell">Views</th>
                <th class="text-center d-none d-lg-table-cell">Created</th>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td width="50" class="d-none d-sm-table-cell">
                    <a href="{{ route('posts.show', $post->id) }}">
                        <img src="{{ $post->featured_image }}" alt="" class="table-featured-img">
                    </a>
                </td>
                <td>
                    <a href="{{ route('posts.show', $post->id) }}" title="{{ $post->title }}" class="app-table-link">
                        @if ($display == 'Dashboard')
                            {{ substr($post->title, 0, 35).'...' }}
                        @else
                            {{ $post->title }}
                        @endif
                    </a>
                </td>
                <td class="text-center">
                    <span class="d-none d-sm-inline-block">
                        <a href="{{ route('posts.show', $post->id) }}" class="app-table-link">
                            @if ($post->is_published)
                                <i class="fas fa-check text-success"></i>
                            @else
                                <i class="fas fa-xmark text-danger"></i>
                            @endif
                        </a>
                    </span>
                </td>
                <td class="text-center d-none d-md-table-cell">
                    <a href="{{ route('posts.show', $post->id) }}" class="app-table-link">
                        {{ $post->views }}
                    </a>
                </td>
                <td class="text-center d-none d-lg-table-cell">
                    <a href="{{ route('posts.show', $post->id) }}" class="app-table-link">
                        {{ date('d M, Y', strtotime($post->created_at)) }}
                    </a>
                </td>
                <td width="40">
                    <a class="btn btn-sm btn-appprimary" href="{{ route('posts.show', $post->id) }}" title="View"><i class="fas fa-arrow-up-right-from-square"></i></a>
                </td>
                <td width="40">
                    <a class="btn btn-sm btn-primary" href="{{ route('posts.edit', $post->id) }}" title="Edit"><i class="fas fa-pencil"></i></a>
                </td>
                <td width="40">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $post->id }}" title="Delete"><i class="fa-regular fa-circle-xmark"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>