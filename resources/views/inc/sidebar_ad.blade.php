
@if ($sidebar_ad)
<div class="sidebar-ad">
    @if(strlen($sidebar_ad->redirect_url) > 5) 
        <a href="{{ route('banners.redirect', $sidebar_ad->id) }}" target="_blank">
            <img src="{{ $sidebar_ad->featured_image }}" alt="" title="{{ $sidebar_ad->title}}">
        </a>
    @else 
        <img src="{{ $sidebar_ad->featured_image }}" alt="" title="{{ $sidebar_ad->title}}">
    @endif
</div>
@endif