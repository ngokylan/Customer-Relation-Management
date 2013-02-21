// JavaScript Document

function candidateSummary() {
					$('#candidateSummary').show();
	} // Candidate Summary
	
function closeCandidateSummary() {	
			$('#candidateSummary').hide();
}
	
/*	closeCandidateSummary


function candidateSummary() {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#candidateSummary').hide();
		} else {
			$.post("rpc.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#candidateSummary').show();
					//$('#autoSuggestionsList').html(data);
				}
			});
		}
	}	
// Lookup Function for Search Autocomplete Function
function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("rpc.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup*/