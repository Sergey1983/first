	// Get the tour id:

	function get_tour_id() {
		
	

		var path = window.location.pathname;


		var path_edit = '/edit';

		var path_tour = '/tours_2/';

		
		var path_noedit = path.replace(path_edit, '');

		var id = path_noedit.replace(path_tour, '');

		return id;

	}