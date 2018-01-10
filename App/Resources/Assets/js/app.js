var intervalList = [];
var intervalCount = 0;

$(document).ready(function () {
    console.log(intents);

    var $dynmaicWidgets = $("[data-url]");

    $.each($dynmaicWidgets, function (key, value) {
        intervalList.push({
            item : value,
            interval : $(value).data('interval'),
            dataUrl: $(value).data('url')
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
            $.ajax({
                type:'GET',
                url: item.dataUrl,
                success: function (response) {
                    updateWidget(JSON.parse(response));
                },
                error: function () {
                    console.error('error interval ajax request');
                }
            })

        }
    });
    intervalCount++;
}

function updateWidget(data) {
    $.each(data, function (key, value) {
        var $gridItemKeyValue = $('[data-' + key + ']');
        $gridItemKeyValue.html(value);
    });
}