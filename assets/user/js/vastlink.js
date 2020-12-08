(function(jwplayer) {
  var template = function(player, config, div) {
    player.on('adPlay', function(vast) {
      if (vast.clickThroughUrl && vast.adtitle) {
        div.style.display = 'block';
        div.innerHTML = '<button type="button" class="vast-clickThrough">' + vast.adtitle + '</button>' + '<span class="glyphicon glyphicon-new-window"></span>';
      }

      var button = document.querySelector('.vast-clickThrough');
      button.addEventListener('click', function() {
        player.pause();
        var win = window.open(vast.clickThroughUrl, '_blank');
        win.focus();

      });
    });

    player.on('adSkipped', function() {
      div.style.display = 'none';
    });

    player.on('adComplete', function() {
      div.style.display = 'none';
    });
  };
  jwplayer().registerPlugin('vastlink', '1.0', template);
})(jwplayer);