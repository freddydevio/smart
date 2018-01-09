$(document).ready(function () {
    const reloadInterval = 120;
    var currentTick = 0;

    if(pageLoaderActive) {
        setInterval(function () {
            if(currentTick * 100 / reloadInterval >= 100) {
                location.reload();
            }
            $(".page--loader").css('width', (currentTick * 100 / reloadInterval) + "%");
            currentTick++;
        }, 1000);
    }
});
