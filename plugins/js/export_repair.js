$(document).ready(function(){
    $(".export").click(function(){
        var export_type = $(this).data('export-type');
        $('#data_table').export_data({
            type:export_type,
            escape :'false',
            ignoreColumn:[]
        });
    });
});