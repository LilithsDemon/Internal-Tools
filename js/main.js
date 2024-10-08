let current_id = 0;

$('#change_request').click(function(){
    $('main').load('./php/Components/change_request.php');
});

$('#dashboard').click(function(){
    $('main').load('./php/Components/dashboard.php');
});

$('#messages').click(function(){
    $('main').load('./php/Components/messages.php');
});

$('#stakeholder_meetings').click(function(){
    $('main').load('./php/Components/stakeholder_meetings.php');
});

$('#scrum_meetings').click(function(){ 
    $('main').load('./php/Components/scrum_meetings.php');
});

function loadPage(page)
{
    $('main').load('./php/Components/' + page + '.php');
}

$('#add_button').click(function(){
    let today = new Date().toISOString().substr(0, 10);
    $('#prefilled_date').attr('value', today);
});

function change_request(id)
{
    $('#change_request_review_modal').load('./php/Components/change_request.php?id=' + id);
    current_id = id;
}

$('#approve_request_btn').click(function(){
    $.ajax({
        type: 'POST',
        url: '../php/approve_request.php',
        data: {
            id: current_id,
        },
        success: function(response){
            Swal.fire({
                title: "Request Approved",
                text: data.responseText,
                icon: "success",
                heightAuto: false,
                color: "white",
            });
        },
        error: function(response){
            Swal.fire({
                title: "Error Approving Request",
                text: data.responseText,
                icon: "error",
                heightAuto: false,
                color: "white",
            });
        }
    });
});

$('#reject_request_btn').click(function(){
    $.ajax({
        type: 'POST',
        url: '../php/reject_request.php',
        data: {
            id: current_id,
        },
        success: function(response){
            Swal.fire({
                title: "Request Denied Successfully",
                text: data.responseText,
                icon: "success",
                heightAuto: false,
                color: "white",
            });
        },
        error: function(response){
            Swal.fire({
                title: "Error Denying Request",
                text: data.responseText,
                icon: "error",
                heightAuto: false,
                color: "white",
            });
        }
    });
});