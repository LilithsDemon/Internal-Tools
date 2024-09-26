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

function loadDate()
{
    let today = new Date().toISOString().substr(0, 10);
    $('#prefilled_date').attr('value', today);
}