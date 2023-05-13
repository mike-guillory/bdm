// Mike Guillory
// Credo Web Development
// 20160403

(function($){
	$(window).load(function(){
		$('#upcoming-performances-listing').mCustomScrollbar({
			mouseWheel:{scrollAmount: 210},
			// snapAmount: 210,
			theme: "3d-dark",
			// autoHideScrollbar: true
		});
	});
})(jQuery);

$('#listen-here').click(function(e){
	localStorage.setItem('lastPage', '1');
})