/*
* Send a POST-request to the server to get geodata
*/
function geodataShowController() {
	var model = new GeodataShow();
	model.save(getFormData(), {

		before: function() {
			Progress.start('.filter-progress');
		},

        success: function (data, response) {
			Progress.stop('.filter-progress');
			new GeodataShowView(response);
			if (ContentView.active instanceof MapView) {
				ContentView.active.addGeodataToMap(response);
			}
        },
        
        error: function() {
			Progress.stop('.filter-progress');
			MessageBox.addError('Die Geodaten konnten nicht geladen werden.');
		},
		
		skipped: function() {
			Progress.stop('.filter-progress');
		}
   });
};

/**
 * Executes the search if the MapView is active.
 */
function executeSearch() {
	if (ContentView.active instanceof MapView) {
		ContentView.active.doSearch();
	}
}

/**
 * Executes the search if the MapView is active.
 * @param object form element, e.g. this.form
 */
function resetSearch(form) {
	if (ContentView.active instanceof MapView) {
		ContentView.active.resetSearch(form);
	}
}

function saveSearch() {
	$('#mapFilterShare').popover({
		title: 'Suchergebnisse teilen',
		placement: 'left auto',
		content: '<div id="permalinkContent"><img src="/img/loading.gif" /> Permalink wird generiert...</div>',
		html: true,
		trigger: 'manual',
		viewport: '#mapDataPanel'
	});
	var model = new PermalinkSave();
	model.save(getFormData(), {
        success: function (model, response) {
			$('#permalinkContent').html('<a href="' + response.permalink + '" target="_blank">' + response.permalink + '</a>');
        },
        error: function() {
			$('#permalinkContent').html('Permalink konnte leider nicht generiert werden.<br />Bitte versuchen Sie es erneut.');
		},
		before: function() {
			$('#mapFilterShare').popover('show');
		},
		skipped: function() {
			$('#mapFilterShare').popover('toggle');
			$('#permalinkContent').html('Leider zu häufig geklickt.<br />Bitte in 15 Sekunden erneut versuchen. ;)');
		}
   });
	
}

/*
* Send a POST-request to the server
*/
function commentAddFirstStepController(model, details) {
	model.save(details, {
		
		before: function() {
			Progress.start('.modal-progress');
		},
		
        success: function (model, response) {
        	Debug.log('Try to validate URL');
        	FormErrorMessages.remove('#form-comment-firstStep');
        	$('#ModalAddComment').modal('hide');
			ContentView.register(new CommentAddViewStep2({metadata: response.geodata}));
        },
        
        error: function(model, response) {
        	Debug.log('Can not validate URL');
			Progress.stop('.modal-progress');
        	FormErrorMessages.apply('#form-comment-firstStep', response.responseJSON);
		}
   });
};

/*
* Send a POST-request (because no id is specified) to the server to save a comment
*/
function commentAddSecondStepController(model, details) {
	
	model.save(details, {
		
		// In case of successfull adding of comment
		success: function (model, response) {
			Debug.log("Adding comment was successful: " + JSON.stringify(response.responseJSON));
			FormErrorMessages.remove('#form-comment-secondStep');
			router.navigate('', {trigger: true}); // Redirect to frontpage
			MessageBox.addSuccess('Ihr Kommentar wurde erfolgreich hinzugefügt.');
		},
	
		// In case of failed adding of comment
		error: function (model, response) {
			Debug.log("Adding comment failed");
			FormErrorMessages.apply('#form-comment-secondStep', response.responseJSON);
		}
	});
};

/*
* Send a POST-request to the server to get comments to a geodata
*/
function commentsToGeodataController(id) {
	var progressClass = '.comment-' + id + '-progress';
	Progress.start(progressClass);
	var model = new CommentsToGeodata();
	model.id = id;
	model.save(getFormData(), {
		
        success: function (data, response) {
        	Debug.log('Showing comments to geodata succeded');
			Progress.stop(progressClass);
			new CommentsShowView(response);
        },
        
        error: function() {
        	Debug.log('Showing comments to geodata failed');
			Progress.stop(progressClass);
			MessageBox.addError('Die Kommentare zu diesem Geodatensatz konnten nicht geladen werden.');
		},
   });
};

function getFormData() {
	var bbox = null;
	if (ContentView.active instanceof MapView) {
		bbox = ContentView.active.getBoundingBox();
	}
	return {
		q : $("#SearchTerms").val(),
		bbox: bbox,
		radius : $("#spatialFilter").val(),
		start: $("#filterStartTime").val(),
		end: $("#filterEndTime").val(),		
		minrating: $("#ratingFilter").val(),
		metadata : $('#includeMetadata').is(':checked')
	};
}