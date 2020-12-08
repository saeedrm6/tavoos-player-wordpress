(function (jwplayer) {
    var template = function (player, config, div) {
        player.on("ready", function () {
            if (config.text) {
                div.innerHTML = config.text;
            }
        });

        player.on("beforePlay", function () {
            div.style.display = "none";
        });
    };
    jwplayer().registerPlugin('time', '1.0', template);
})(jwplayer);