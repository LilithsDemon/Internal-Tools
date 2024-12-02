$("#login_form").submit(function (e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "./php/log_in.php",
        data: $("#login_form").serialize(),
        success: function (data) {
            if (data == "true") window.location.href = "./main.php";
        },
        error: function (data) {
            $("#password").val = "";
            Swal.fire({
                title: "Registration Request Denied",
                text: data.responseText,
                icon: "error",
                heightAuto: false,
                color: "white",
            });
        },
    });
});