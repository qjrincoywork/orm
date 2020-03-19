function initialize() {
    var options = {
        componentRestrictions: {country: "ph"}
    };
    
    var input = document.getElementById('nf-address');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
}
google.maps.event.addDomListener(window, 'load', initialize);