
@if ($above_page_ad)
<div id="pre-header-ad">
    <a href="@if(strlen($above_page_ad->redirect_url) > 5) {{ $above_page_ad->redirect_url }} @endif" target="_blank">
        <img src="{{ $above_page_ad->featured_image }}" alt="" title="{{ $above_page_ad->title}}">
    </a>
</div>
@endif