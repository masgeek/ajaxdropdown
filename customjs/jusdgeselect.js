/**
 * Created by ANUBIS on 10/31/2015.
 */
jQuery( document ).ready(function() {
loadAllJudges('FIRST');
    //if selection on the first dropdown changes

});

function loadAllJudges(action)
{
//the variable action denotes if it is the first dropdown or the second
    var dropdownId = null;
    var filteredJudge = '';
    if(action==='FIRST')
    {
        //load first dropdown
        dropdownId=jQuery('#input_1');
    }else
    {
        //load second dropdown
        dropdownId=jQuery('#input_3');
        //get teh selected value of the first dropdown
        //we will exclude this from loading in teh second dropdown
        filteredJudge = jQuery('#input_1').val();

    }

    //alert('Jusde selected is '+filteredJudge);
    //now for the ajax function
    jQuery.ajax({
        url: './phpfile/ddjudges.php',
        type:'POST',
        data:{
            judgename:filteredJudge
        },
        dataType: 'JSON',
        success: function(data) {
            //populate the dropdown with teh judges names
            //clear the current content of the select
            dropdownId.html('');//clear teh current dropdown
            //iterate over the data and append a select option*
            dropdownId.append('<option id="">Select a judge</option>');
            jQuery.each(data, function(key, val){
                dropdownId.append('<option id="' + val.judge_name + '">' + val.judge_name+ '</option>');
            })
        },
        error: function( req, status, err ) {
            console.log( 'something went wrong', status, err );
        }
    });
}