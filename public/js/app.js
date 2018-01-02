$(document).ready(function () {
   initWidgets();
});

var initWidgets = function () {
    setInterval(function (args) {
        datetimeWidget();
    }, 1000);
    setInterval(function (args) {
        weatherWidget();
    }, 1000);
};

var datetimeWidget = function () {
    const timeLabel = $('.datetime-widget .time');
    const dateLabel = $('.datetime-widget .date');
    
    timeLabel.html(moment().format('h:mm:ss'));
    dateLabel.html(moment().format('MMM Do YY'));
};

var weatherWidget = function () {
    const currentWeatherIcon = $('.current-weather-icon');
    const currentWeather = $('.current-weather');
    const windSpeed = $('.wind-speed');
    
    $.simpleWeather({
        woeid: '667931',
        unit: 'c',
        success: function(weather) {
            currentWeatherIcon.html('<i class="zmdi zmdi-sun zmdi-hc-5x"></i>');
            currentWeather.html(weather.temp+'&deg;'+weather.units.temp);
            windSpeed.html('wind speed: ' + weather.wind.speed + ' km/h');
        },
        error: function(error) {
            console.log("error weather widget");
        }
    });
};