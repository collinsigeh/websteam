
@if ($sidebar_ad)
<div class="sidebar-ad">
    <a href="@if(strlen($sidebar_ad->redirect_url) > 5) {{ $sidebar_ad->redirect_url }} @endif" target="_blank">
        <img src="{{ $sidebar_ad->featured_image }}" alt="" title="{{ $sidebar_ad->title}}">
    </a>
</div>
@endif