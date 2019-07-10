function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace(
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;
	}
	return vars;
}

function QueryIncrementDownloadCounter(){

    var resolution_exploded = $_GET("content_resolution").split("-");

    $.ajax({
        url: "content_downloaded.php",
        data: {name: $_GET("content_name"), extension: $_GET("content_extension"), w_resolution: resolution_exploded[0], h_resolution: resolution_exploded[1]},
        cache: false,
        method: "POST",
        success: AnswerIncrementDownloadCounter(),
        error: function(){
            alert("error");
        }

    });
}

function AnswerIncrementDownloadCounter(){

}


$(document).ready(function(){

    $(".download_link").click(function(){
        QueryIncrementDownloadCounter();
    });
});
