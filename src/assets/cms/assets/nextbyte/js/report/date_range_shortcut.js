

$(".date_shortcut").click(function(){
    var element_id = this.id;
    var date_shortcut_id = element_id.substr(13);
    getDateRangeShortcut(date_shortcut_id);
});


/*Get date range shortcut*/
function getDateRangeShortcut(date_shortcut_id)
{
    posting = $.post( base_url + "/report/date_range_shortcut" , {
        // client_id: client_id,
        date_shortcut_id: date_shortcut_id,
        from_date: element_id_value('from_date'),
        _method : "GET" } );
    posting.done(function( data ) {
        //Action/Response
        $('#from_date').val(data.from_date).change();
        $('#to_date').val(data.to_date).change();

        /*Class*/
        $(".date_shortcut").removeClass("badge-success");
        $(".date_shortcut").addClass("badge-default");
        $("#date_shortcut"+date_shortcut_id).removeClass("badge-default");
        $("#date_shortcut"+date_shortcut_id).addClass("badge-success");

    });
}