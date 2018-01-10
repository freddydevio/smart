$(document).ready(function () {
    var currentTick = 0;

    if(pageLoaderActive) {
        setInterval(function () {
            if(currentTick * 100 / pageLoaderInterval >= 100) {
                location.reload();
            }
            $(".page--loader").css('width', (currentTick * 100 / pageLoaderInterval) + "%");
            currentTick++;
        }, 1000);
    }
});
