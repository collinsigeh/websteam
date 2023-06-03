
<div style="display: flex">
    <div style="padding: 10px 5px 0 5px; margin-right: 5px;">
        <div class="fb-share-button" 
            data-href="{{ config('app.url').'/'.$post->slug }}" 
            data-layout="button_count">
        </div>
    </div>
    <div style="padding: 15px 5px 0 10px;">
        <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}">Tweet</a>
    </div>
</div>