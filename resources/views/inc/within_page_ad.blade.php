
@if ($within_page_ad)
<div class="within-page-ad">
    @if(strlen($within_page_ad->redirect_url) > 5) 
        <a href="{{ route('banners.redirect', $within_page_ad->id) }}" target="_blank">
            <img src="{{ $within_page_ad->featured_image }}" alt="" title="{{ $within_page_ad->title}}">
        </a>
    @else 
        <img src="{{ $within_page_ad->featured_image }}" alt="" title="{{ $within_page_ad->title}}">
    @endif
</div>
@endif