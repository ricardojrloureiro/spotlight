var playlistIds =  document.getElementById("playList").value;

// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '550',
        width: '780',
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
    }

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
    player.cuePlaylist(playlistIds);

}

// 5. The API calls this function when the player's state changes.
var done = false;
function onPlayerStateChange(event) {
 }

function nextVideo() {
 }

function stopVideo() {
    player.stopVideo();
}