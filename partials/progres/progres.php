<div id="progress">
    <span id="progress-value" style="font-size: 1.6em;"><i class="fa-solid fa-arrow-up-long"></i></span>
</div>
<script>
    let calcScrollValue = () => {
    let scrollProgress = document.getElementById("progress");
    let progressValue = document.getElementById("progress-value");
    let pos = document.documentElement.scrollTop;
    let calcHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    let ScrollValue = Math.round((pos * 100) / calcHeight);
        if (pos > 500) {
                scrollProgress.style.display = "grid";
        } else {
            scrollProgress.style.display = "none";
        }
        scrollProgress.addEventListener("click", () => {
            document.documentElement.scrollTop = 0;
        });
    };
    window.onscroll = calcScrollValue;
    window.onload = calcScrollValue;
</script>