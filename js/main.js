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


$('main').on('click', '#send_request', function () {
    $.ajax({
        type: "POST",
        url: "./php/send_change_request.php",
        data: $("#change_request_form").serialize(),
        success: function(data) {
            Swal.fire({
                title: "Request Sent Successfully",
                text: data.responseText,
                icon: "success",
                heightAuto: false,
                color: "white",
            });
            $('main').load('./php/Components/change_request.php');
        },
        error: function(data){
            Swal.fire({
                title: "Error Sending Request",
                text: data.responseText,
                icon: "error",
                heightAuto: false,
                color: "white",
            });
        },
    });
});

$('main').on('click', '#save_scrum_btn', function () {
    var selected_ids = [];
    $("input:checkbox:checked").each(function() { 
        selected_ids.push($(this).attr('data-id')); 
    });
    $.ajax({
        type: "POST",
        url: "./php/send_scrum_meeting.php",
        data: { users: JSON.stringify(selected_ids),
            meeting_title: $('#meeting_title').val(),
            meeting_notes: $('#meeting_notes').val(),
        },
        success: function(data) {
            Swal.fire({
                title: "Scrum meeting saved Successfully",
                text: data.responseText,
                icon: "success",
                heightAuto: false,
                color: "white",
            });
            $('main').load('./php/Components/scrum_meetings.php');
        },
        error: function(data){
            Swal.fire({
                title: "Error Saving Meeting",
                text: data.responseText,
                icon: "error",
                heightAuto: false,
                color: "white",
            });
        },
    });
});

$('main').on('click', '#save_sh_btn', function () {
    var selected_ids = [];
    $("input:checkbox:checked").each(function() { 
        selected_ids.push($(this).attr('data-id')); 
    });
    $.ajax({
        type: "POST",
        url: "./php/send_stakeholder_meeting.php",
        data: { users: JSON.stringify(selected_ids),
            meeting_title: $('#meeting_title').val(),
            meeting_notes: $('#meeting_notes').val(),
        },
        success: function(data) {
            Swal.fire({
                title: "Stakeholder meeting saved successfully",
                text: data.responseText,
                icon: "success",
                heightAuto: false,
                color: "white",
            });
            $('main').load('./php/Components/stakeholder_meetings.php');
        },
        error: function(data){
            Swal.fire({
                title: "Error Saving Meeting",
                text: data.responseText,
                icon: "error",
                heightAuto: false,
                color: "white",
            });
        },
    });
});

function loadPage(page)
{
    $('main').load('./php/Components/' + page + '.php');
}

$('main').on('click', '#add_button', function () {
    let today = new Date().toISOString().substr(0, 10);
    $('#prefilled_date').attr('value', today);
});

$('main').on('click', '#change_request_review_btn', function () {
    id = $(this).attr('data-id');
    $('#change_request_review_modal_inner').load('../php/modal_change_request.php?id=' + id);
    current_id = id;
});

$('main').on('click', '#create_user_btn', function () {
    $.ajax({
        type: 'POST',
        url: './php/create_users.php',
        data: {
            user_name: $('#user_title').val(),
            user_first_name: $('#user_first_name').val(),
            user_last_name: $('#user_last_name').val(),
            stakeholder: $('#stakeholder').val(),
            admin: $('#admin').val(),
        },
        success: function(data){
            Swal.fire({
                title: "User Created Successfully",
                text: data.responseText,
                icon: "success",
                heightAuto: false,
                color: "white",
            });
        },
        error: function(data){
            Swal.fire({
                title: "Error Creating User",
                text: data.responseText,
                icon: "error",
                heightAuto: false,
                color: "white",
            });
        }
    });
});

$('main').on('click', '#approve_request_btn', function () {
    let review_notes = $('#review_notes').val();
    $.ajax({
        type: 'POST',
        url: './php/approve_request.php',
        data: {
            id: current_id,
            notes: review_notes,
        },
        success: function(data){
            Swal.fire({
                title: "Request Approved",
                text: data.responseText,
                icon: "success",
                heightAuto: false,
                color: "white",
            });
            $('main').load('./php/Components/change_request.php');
        },
        error: function(data){
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

$('main').on('click', '#reject_request_btn', function () {
    let review_notes = $('#review_notes').val();
    $.ajax({
        type: 'POST',
        url: './php/reject_request.php',
        data: {
            id: current_id,
            notes: review_notes,
        },
        success: function(data){
            Swal.fire({
                title: "Request Denied Successfully",
                text: data.responseText,
                icon: "success",
                heightAuto: false,
                color: "white",
            });
            $('main').load('./php/Components/change_request.php');
        },
        error: function(data){
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