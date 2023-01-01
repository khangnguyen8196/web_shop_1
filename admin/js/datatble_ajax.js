$(document).ready(function() {
        $('#pagination_data').dataTable({
            "ajax": {
                "processing": true,
                "serverSide": true,
                "serverMethod":"POST",
                "url":"pagination_data.php",
                "dataSrc":''
            },
        });
    
   
});