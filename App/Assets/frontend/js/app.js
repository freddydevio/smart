
$(document).ready(function() {
    initWidgets();
});

var initWidgets = function () {
    initWeatherWidget();
    initTimeWidget();

    initTimers();
};

var initTimers = function () {
    setInterval(function () {
        initTimeWidget();
    },1000);
};

var initTimeWidget = function () {
    const currentTime = $('.time');
    const currentDate = $('.date');

    currentTime.html(moment().format('HH:mm:ss'));
    currentDate.html(moment().format('MMMM Do YYYY'));
};

var initWeatherWidget = function () {
    const currentWeather = $('.current-weather');
    const currentWeatherIcon = $('.current-weather-icon');
    const currentWindSpeed = $('.wind-speed');
    const location = $('.location');

    $.simpleWeather({
        woeid: '667931',
        unit: 'c',
        success: function(weather) {
            currentWeatherIcon.html('<i class="zmdi zmdi-sun"></i>');
            currentWeather.html(weather.temp+'&deg;'+weather.units.temp);
            location.html(weather.city+', '+weather.region);
            currentWindSpeed.html(weather.wind.direction+' '+weather.wind.speed+' '+weather.units.speed);
        },
        error: function(error) {
            console.log(error);
        }
    });
};