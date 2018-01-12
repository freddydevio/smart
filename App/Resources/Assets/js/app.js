var intervalList = [];
var intervalCount = 0;

$(document).ready(function () {
    console.log(intents);

    var $dynmaicWidgets = $("[data-url]");

    $.each($dynmaicWidgets, function (key, value) {
        intervalList.push({
            item: value,
            interval: $(value).data('interval'),
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
    //     annyang.addCommands(commands);
    //     annyang.debug();
    //     annyang.start({
    //         autoRestart: true,
    //         continuous: false
    //     });
    //
    //     annyang.addCallback('resultNoMatch', function(phrases) {
    //         console.log("I think the user said: ", phrases[0]);
    //         console.log("But then again, it could be any of the following: ", phrases);
    //     });
    // }
    runSpeechRecognition();
});

function runSpeechRecognition() {
    const artyom = new Artyom();

    artyom.on(['spreche mir nach *'], true).then((i, wildcard) => {
        artyom.say("Du hast gesagt : " + wildcard);
    });

    // Start the commands !
    // artyom.initialize({
    //     lang: "de-DE",
    //     // continuous: true,
    //     soundex: true,
    //     debug: true,
    //     executionKeyword: "and do it now",
    //     // listen: true, // Start to listen commands !
    //
    //     // If providen, you can only trigger a command if you say its name
    //     // e.g to trigger Good Morning, you need to say "Jarvis Good Morning"
    //     name: "Smart"
    // }).then(() => {
    //     console.log("Artyom has been succesfully initialized");
    // }).catch((err) => {
    //     console.error("Artyom couldn't be initialized: ", err);
    // });

    // artyom.simulateInstruction("Smart spreche mir nach Wir alle haben Probleme");
}

function runInterval() {
    $.each(intervalList, function (key, item) {
        if (intervalCount % item.interval == 0) {
            $.ajax({
                type: 'GET',
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