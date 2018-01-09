var intervalList = [];
var intervalCount = 0;

$(document).ready(function () {
    console.log(intents);

    var $dynmaicWidgets = $("[data-url]");

    $.each($dynmaicWidgets, function (key, value) {
        intervalList.push({
                item : value,
                interval : $(value).data('interval')
        });
    });

    //init the interval timer
    setInterval(function () {
        runInterval()
    }, 1000);

    // if (annyang) {
    //     var commands = {
    //         'hello': function() { alert('Hello world!'); }
    //     };
    //     // Add our commands to annyang
    //     annyang.addCommands(commands);
    //     // Start listening.
    //     annyang.start();
    // }
});

function runInterval() {
    $.each(intervalList, function (key, item) {
        if(intervalCount % item.interval == 0) {
            console.log('current interval:'+intervalCount + 'now');

        }
    });
    intervalCount++;
}