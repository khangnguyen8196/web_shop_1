$(document).ready(function(){
    var jsonArrObj=[
        {

        }
    ];
    var page_number =1;
    var records_per_page =10;
    var total_page =Math.ceil(jsonArrObj.length/records_per_page);

    // display table rows from json data
    $.fn.displayTableData=function(){
        var start_index =(page_number-1)*records_per_page;
        var end_index = start_index+(records_per_page -1);
    }
})