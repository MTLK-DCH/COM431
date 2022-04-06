$(document).ready(function($) {
    $("#btnGet").click(function() {
        var message = "";
        //Loop through all checked CheckBoxes in GridView. 
        $(".table input[type=checkbox]:checked").each(function() {
            var row = $(this).closest("tr")[0];
            // message += row.cells[2].innerHTML; 
            message += " " + row.cells[2].innerHTML;
            // message += " " + row.cells[4].innerHTML; 
            message += "\n-----------------------\n";
        });
        //Display selected Row data in Alert Box. 
        $("#messageList").html(message);
        return false;
    });
    $("#copy").click(function() {
        $("#messageList").select();
        document.execCommand("copy");
        alert("Copied On clipboard");
    });
});