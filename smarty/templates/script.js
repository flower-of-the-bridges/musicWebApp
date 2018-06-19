function player(id){

$scope.player = new window.Audio();

var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        $scope.player.src = window.URL.createObjectURL(this.response);
        $scope.player.play();
    }
};
xhr.open('GET', /deepmusic/song/play/id);
xhr.responseType = 'blob';
xhr.send();
}
