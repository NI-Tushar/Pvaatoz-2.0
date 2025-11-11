<link rel="stylesheet" href="{{ url('Frontend/assets/css/share_modal.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">

<div class="pop_upSection">
    <div class="popup">
        <header>
            <span>Share</span>
            <div onclick="closeShare()" class="close"><i class="uil uil-times"></i></div>
        </header>
        <div class="content">
            <p>Share this link via</p>
            <ul class="icons">
                <a id="facebookShare" href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a id="twitterShare" href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a id="whatsappShare" href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a id="telegramShare" href="#" target="_blank"><i class="fab fa-telegram-plane"></i></a>
                <a id="instagramShare" href="#" target="_blank"><i class="fab fa-instagram"></i></a>
            </ul>
            <p>Or copy link</p>
            <div class="field">
                <i class="url-icon uil uil-link"></i>
                <input id="shareInput" type="text" readonly value="">
                <button id="copyBtn">Copy</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openShare(url){
        let popup = document.querySelector(".pop_upSection");
        let input = document.getElementById("shareInput");
        input.value = url; // set dynamic url
        popup.classList.add("show"); // open modal

        // Update social links with this url
        document.getElementById("facebookShare").href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url);
        document.getElementById("twitterShare").href = "https://twitter.com/intent/tweet?url=" + encodeURIComponent(url);
        document.getElementById("whatsappShare").href = "https://wa.me/?text=" + encodeURIComponent(url);
        document.getElementById("telegramShare").href = "https://t.me/share/url?url=" + encodeURIComponent(url);
        document.getElementById("instagramShare").href = url; // Instagram doesn’t support direct share, just link
    }

    function closeShare(){
        let popup = document.querySelector(".pop_upSection");
        popup.classList.remove("show"); // close modal
    }

    // copy button
    document.addEventListener("DOMContentLoaded", () => {
        const copyBtn = document.getElementById("copyBtn");
        const input = document.getElementById("shareInput");
        const field = document.querySelector(".field");

        copyBtn.addEventListener("click", () => {
            navigator.clipboard.writeText(input.value).then(() => {
                field.classList.add("active");
                copyBtn.innerText = "Copied";

                setTimeout(() => {
                    field.classList.remove("active");
                    copyBtn.innerText = "Copy";
                }, 3000);
            }).catch(err => {
                console.error("Failed to copy text: ", err);
            });
        });
    });
</script>