
@if ($within_page_ad)
<div class="within-page-ad">
    <a href="@if(strlen($within_page_ad->redirect_url) > 5) {{ $within_page_ad->redirect_url }} @endif" target="_blank">
        <img src="{{ $within_page_ad->featured_image }}" alt="" title="{{ $within_page_ad->title}}">
    </a>
</div>
@endif