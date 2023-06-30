<script type="text/javascript">
    function dataURLtoFile(dataurl, filename) {
        var arr = dataurl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[arr.length - 1]), 
            n = bstr.length, 
            u8arr = new Uint8Array(n);
        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], filename, {type:mime});
    }

    function processThumbnail()
    {
        console.log("Processing thumbnail...");
        const imgU = document.getElementById('image').files[0];

        if (!imgU) return;
        
        const reader = new FileReader();

        reader.readAsDataURL(imgU);

        reader.onload = function(event) {
            const imgElement = document.createElement("img");
            imgElement.src = event.target.result;

            var imagediv = document.getElementById('preview');
            var newimg = document.createElement('img');
            imagediv.innerHTML = '';
            document.getElementById('upload-label').innerHTML = 'Change featured image';
            newimg.src = event.target.result;
            imagediv.appendChild(newimg);

            imgElement.onload = function(e) {
                const canvas = document.createElement("canvas");
                const MAX_WIDTH = 300;

                const scaleSize = MAX_WIDTH / e.target.width;
                canvas.width = MAX_WIDTH;
                canvas.height = e.target.height * scaleSize;

                const ctx = canvas.getContext("2d");

                ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);
                const srcEncoded = ctx.canvas.toDataURL(e.target, "image/jpeg");

                var newThumbnail = dataURLtoFile(srcEncoded, 'thumbnail_' + Date.now() + '.jpg');

                // making selected image available to the thumbnail field
                const fileInput = document.getElementById('thumbnail_image');
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(newThumbnail);
                fileInput.files = dataTransfer.files;
            }
        }
        
    }
</script>