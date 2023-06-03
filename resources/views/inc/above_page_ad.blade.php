
@if ($above_page_ad)
<div id="pre-header-ad">
    @if(strlen($above_page_ad->redirect_url) > 5) 
        <a href="{{ route('banners.redirect', $above_page_ad->id) }}" target="_blank">
            <img src="{{ $above_page_ad->featured_image }}" alt="" title="{{ $above_page_ad->title}}">
        </a>
    @else 
        <img src="{{ $above_page_ad->featured_image }}" alt="" title="{{ $above_page_ad->title}}">
    @endif
</div>
@endif