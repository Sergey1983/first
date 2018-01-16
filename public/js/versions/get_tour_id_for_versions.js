console.log('get_tour_id_for_versions.js loaded');

	function get_tour_id_for_versions() {
		
	

		var path = window.location.pathname;


		var path_versions = '/versions';

		var path_tour = '/tours/';

		
		var path_noedit = path.replace(path_versions, '');

		var id = path_noedit.replace(path_tour, '');

		return id;

	}