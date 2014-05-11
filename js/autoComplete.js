$(document).ready(function() {

    function log(message) {

        $("<div/>").text(message).prependTo("#log");

        $("#log").scrollTop(0);

    }
    
    $(".locationSelect").autocomplete({

        source : "ajax/locationSuggest.php",

        minLength : 2,

        select : function(event, ui) {

            log(ui.item ? "Selected: " + ui.item.value + " aka " + ui.item.id : "Nothing selected, input was " + this.value);

        }

    });

});