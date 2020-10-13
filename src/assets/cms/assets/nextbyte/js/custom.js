

/* start ---Enable - Disable attributes of elements*/

/*Work for element id*/
function enable_disable(action_type, element_id)
{
    switch (action_type) {
        case 'enable_id':
            $("#"+element_id).prop("disabled", false);
            break;
        case 'disable_id':
            $("#"+element_id).prop("disabled", true);
            break;
        case 'enable_class':
            $("."+element_id).prop("disabled", false);
            break;
        case 'disable_class':
            $("."+element_id).prop("disabled", true);
            break;
    }
}

/*End - Enable_Disable*/

/* start ---HIDE - SHOW attributes of elements*/

/*Work for element id*/
function hide_show(action_type, element_id)
{
    switch (action_type) {
        case 'hide_id':
            $("#" + element_id).hide();
            break;
        case 'show_id':
            $("#"+ element_id).show();
            break;
        case 'hide_class':
            $("." + element_id).hide();
            break;
        case 'show_class':
            $("."+ element_id).show();
            break;
    }
}

/*End - hide_show*/




/* start ---CHECKED - UNCHECKED attributes of elements*/

/*Work for element id*/
function checker(action_type, element_id)
{
    switch (action_type) {
        case 'check_id':
            $("#"+element_id).prop("checked", true);
            break;
        case 'uncheck_id':
            $("#"+element_id).prop("checked", false);
            break;
        case 'check_class':
            $("."+element_id).prop("checked", true);
            break;
        case 'uncheck_class':
            $("."+element_id).prop("checked", false);
            break;
    }
}

/*End - checker*/




/**
 * INITIALIZE VALUES FOR PLUGINS ---=========Start=========----
 */


/* start ----Maskmoney -----*/

/* start : mask all money input */
$('.money').maskMoney({
    precision : 2,
    allowZero : false,
    affixesStay : false
});

$('.money0').maskMoney({
    precision : 2,
    allowZero : true,
    affixesStay : false
});

/*--End ----Maskmoney---------*/



/*------Start------Number Only ------*/

//for number check
$('body').off('keydown', '.number').on('keydown', '.number', function(e) {
    number_only(e);
});

function number_only(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl+A, Command+A
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}


/*------End--------Number only---------*/

/*Text area - Text content*/
$('.text_content').on( 'change keyup keydown paste cut', 'textarea', function (){
    $(this).height(0).height(this.scrollHeight);
}).find( 'textarea' ).change();

/*End initialize values -----===========-----------*/

/*Thousand separator*/
function thousandSeparator(num) {
    if(num){
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

}


/*Remove thousands separator*/
function removeThousandSeparator(num) {
    if(num){
        return num.replace(/,/g, "");
    }

}



/*Please wait submit button - Presq - empty label to substitute submit button when hidden*/
//action type i.e. 1 => hide button, 2 = reshow button
function pleaseWaitSubmitButton(submit_button_id,label_wait_id, please_wait_text, action_type)
{
    if(action_type == 1){
        /*hide button*/
        $('#'+ submit_button_id).prop('hidden', true);
        $('#' + label_wait_id).text(please_wait_text).change();
    }else{
        /*show button*/

        $('#'+ submit_button_id).prop('hidden', false);
        $('#' + label_wait_id).text('').change();

    }

}


function resetForm(form) // Reset button clicked
{
    // $(".submit").attr("hidden", false);
    // $('#label').text('').change();
    // $('#resetButton').prop('hidden', true);
}


/*Get value of element id on form*/
function element_id_value(element_id)
{
    return $('#' + element_id).val();
}



/*Get value of element class on form*/
function element_class_value(class_id)
{
    return $('.' + class_id).val();
}

function accountingNumberPresentation(number)
{
    if(number < 0)
    {
        number = (parseFloat(number) * -1);
        number = thousandSeparator(number.toFixed(2));
        return '(' + number.toString() + ')';
    }else{
        number = parseFloat(number).toFixed(2);
        return thousandSeparator(number);
    }
}

function removeAccountingNumberPresentation(number)
{
    var number_no_bracket = number;
    if(number.includes("(") && number.includes(")")){

        number_no_bracket =  removeBrackets(number);
        number_no_bracket = parseFloat(removeThousandSeparator(number_no_bracket)) * -1;
    }else{
        number_no_bracket = parseFloat(removeThousandSeparator(number_no_bracket));
    }
    return number_no_bracket;
}

/*remove brackets ()*/
function removeBrackets(string)
{
    return string.replace(/["'\(\)]/g, "");
}