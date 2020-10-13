


// function calculateTankSales(fuel_tank_id) {
let    calculateTankSales  = function(fuel_tank_id) {
    // var url = base_url;
    var op_lt = $('#op_lt_tank' + fuel_tank_id).text();
    var cl_lt = $('#cl_lt_tank' + fuel_tank_id).val();
    var price = $('#price_tank' + fuel_tank_id).val();
    var from_pump_lt = $('#from_pump_lt_tank' + fuel_tank_id).val();
    var receipt_lt = $('#receipt_lt_tank' + fuel_tank_id).val();
    var receipt_loss_lt_tank = $('#receipt_loss_lt_tank' + fuel_tank_id).val();

    var sales_ltrs = 0;
    var sales_amount = 0;
    // alert(fuel_tank_id);
    if (cl_lt != '') {
        cl_lt = parseFloat(removeThousandSeparator(cl_lt))
    } else {
        cl_lt = 0;
    }
    if (op_lt != '') {
        op_lt = parseFloat(removeThousandSeparator(op_lt))
    } else {
        op_lt = 0;
    }
    if (price != '') {
        price = parseFloat(removeThousandSeparator(price))
    } else {
        price = 0;
    }
    if (from_pump_lt != '') {
        from_pump_lt = parseFloat(removeThousandSeparator(from_pump_lt))
    } else {
        from_pump_lt = 0;
    }
    if (receipt_lt != '') {
        receipt_lt = parseFloat(removeThousandSeparator(receipt_lt))
    } else {
        receipt_lt = 0;
    }
    if (receipt_loss_lt_tank != '') {
        receipt_loss_lt_tank = parseFloat(removeThousandSeparator(receipt_loss_lt_tank))
    } else {
        receipt_loss_lt_tank = 0;
    }

    // if (op_lt >= cl_lt) {
    //     sales_ltrs = op_lt + receipt_lt - receipt_loss_lt_tank - cl_lt;
    //     // saveFuelSale(fuel_tank_id);
    // }
    sales_ltrs = op_lt + receipt_lt - receipt_loss_lt_tank - cl_lt;
    if(sales_ltrs >= 0 || sales_ltrs < 0){
        saveTankFuelSale(fuel_tank_id);
    }else{
        /*invalid entry*/
        $("#save_tank_status"+fuel_tank_id).text('INVALID!');
        $("#save_tank_status"+fuel_tank_id).css("color", 'red');
    }
    sales_amount = price * sales_ltrs;

    /*assign values*/
    $('#sales_lt_tank' + fuel_tank_id).text(thousandSeparator(sales_ltrs.toFixed(2))).change();
    $('#amount_tank' + fuel_tank_id).text(thousandSeparator(sales_amount.toFixed(2))).change();

    // getTotals();
};


//--/*Save fuel sales*/--
function saveTankFuelSale(fuel_tank_id){
    var cl_lt = $('#cl_lt_tank' + fuel_tank_id).val();
    var price = $('#price_tank' + fuel_tank_id).val();
    var receipt_lt = $('#receipt_lt_tank' + fuel_tank_id).val();
    var receipt_loss_lt = $('#receipt_loss_lt_tank' + fuel_tank_id).val();
    // var from_pump_lt = $('#from_pump_lt_tank' + fuel_tank_id).val();
    var from_pump_lt = 0;
    var sales_lt = $('#sales_lt_tank' + fuel_tank_id).val();
    var sales_amount = $('#amount_tank' + fuel_tank_id).val();
    var shift_id = $('#shift_id').val();


    posting = $.post( base_url + "/operation/sales/tank/save_ajax" , {
        fuel_tank_id: fuel_tank_id,
        cl_lt: cl_lt,
        receipt_lt: receipt_lt,
        receipt_loss_lt: receipt_loss_lt,
        price: price,
        from_pump_lt: from_pump_lt,
        shift_id: shift_id,
        _method : "GET" } );
    posting.done(function( data ) {

        var sales_data_json = data.sales_data;
        var sales_data = JSON.parse(sales_data_json);
        var current_status = $("#save_tank_status"+fuel_tank_id).text();
        if(current_status == 'Saved')
        {
            current_status = 'Updated'
        }else if(current_status == 'Updated') {
            current_status = 'Updated';
        }
        else{
            current_status = 'Saved';
        }

        $("#save_tank_status"+fuel_tank_id).text(current_status);
        $("#save_tank_status"+fuel_tank_id).css("color", 'green');

        salesDataBindingAfterSave(sales_data_json, fuel_tank_id);

        /*total summary data*/
        // totalTankSummary(data.total_summary_data);
        getTotalTankOpLtByProduct(sales_data.product_id)
    });
}



/*sales dara binding*/
function salesDataBindingAfterSave(sales_data_json, fuel_tank_id)
{
    var sales_data = JSON.parse(sales_data_json);
    /*lg_lt*/
    var lg_lt = accountingNumberPresentation(sales_data.lg_lt);
    var lg_amount = accountingNumberPresentation(sales_data.lg_amount);
    var lg_percent = accountingNumberPresentation(sales_data.lg_percent);
    $('#lg_lt_tank'+ fuel_tank_id).text(lg_lt);
    $('#lg_amount_tank'+ fuel_tank_id).text(lg_amount);
    $('#lg_percent_tank'+ fuel_tank_id).text(lg_percent);
}




/*Total tank sale summary*/
// function totalTankSummary(total_summary_data_json)
// {
//     var  total_summary_data = JSON.parse(total_summary_data_json);
//     var product_id = total_summary_data.product_id;
//
//     $('#total_tank_op'+ product_id).text(accountingNumberPresentation(total_summary_data.total_op_lt)).change();
//     $('#total_tank_cl'+ product_id).text(accountingNumberPresentation(total_summary_data.total_cl_lt)).change();
//     $('#total_sales_lt'+ product_id).text(accountingNumberPresentation(total_summary_data.total_sales_lt)).change();
//     $('#total_sales_amount'+ product_id).text(accountingNumberPresentation(total_summary_data.total_sales_amount)).change();
//     $('#total_lg_lt'+ product_id).text(accountingNumberPresentation(total_summary_data.total_lg_lt)).change();
//     $('#total_lg_amount'+ product_id).text(accountingNumberPresentation(total_summary_data.total_lg_amount)).change();
// }

/*get total tank op by product*/

function getTotalTankOpLtByProduct(product_id)
{
    var fuel_tank_id, op_lt,cl_lt, sales_lt, sales_amount, lg_lt, lg_amount;
    var total_op_lt = 0;
    var total_cl_lt = 0;
    var total_sales_lt = 0;
    var total_sales_amount = 0;
    var total_lg_lt = 0;
    var total_lg_amount = 0;
    $( ".tank_product_" + product_id.toString() ).each(function(e) {
        var element_id = this.id;
        fuel_tank_id = element_id.substr(15);
        op_lt = $('#op_lt_tank'+ fuel_tank_id).text();
        cl_lt = $('#cl_lt_tank'+ fuel_tank_id).val();
        sales_lt = $('#sales_lt_tank'+ fuel_tank_id).text();
        sales_amount = $('#amount_tank'+ fuel_tank_id).text();
        lg_lt = $('#lg_lt_tank'+ fuel_tank_id).text();
        lg_lt = removeAccountingNumberPresentation(lg_lt);
        lg_amount = $('#lg_amount_tank'+ fuel_tank_id).text();
        lg_amount = removeAccountingNumberPresentation(lg_amount);
        /*total*/
        total_op_lt = parseFloat(removeThousandSeparator(op_lt)) + total_op_lt;
        total_cl_lt = parseFloat(removeThousandSeparator(cl_lt)) + total_cl_lt;
        total_sales_lt = parseFloat(removeThousandSeparator(sales_lt)) + total_sales_lt;
        total_sales_amount = parseFloat(removeThousandSeparator(sales_amount)) + total_sales_amount;
        total_lg_lt = parseFloat((lg_lt)) + total_lg_lt;
        total_lg_amount = parseFloat((lg_amount)) + total_lg_amount;

    });
    total_op_lt = thousandSeparator(total_op_lt.toFixed(2));
    total_cl_lt = thousandSeparator(total_cl_lt.toFixed(2));
    total_sales_lt = thousandSeparator(total_sales_lt.toFixed(2));
    total_sales_amount = thousandSeparator(total_sales_amount.toFixed(2));
    total_lg_lt = accountingNumberPresentation(total_lg_lt);
    total_lg_amount = accountingNumberPresentation(total_lg_amount);

    /*data binding*/
    $('#total_tank_op'+ product_id).text(total_op_lt).change();
    $('#total_tank_cl' + product_id).text(total_cl_lt).change();
    $('#total_sales_lt' + product_id).text(total_sales_lt).change();
    $('#total_sales_amount' + product_id).text(total_sales_amount).change();
    $('#total_lg_lt' + product_id).text(total_lg_lt).change();
    $('#total_lg_amount' + product_id).text(total_lg_amount).change();

}