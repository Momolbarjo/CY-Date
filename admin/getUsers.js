$(document).ready(function () {
    $(".navigationBar a").click(function (e) {
        if (!$(this).is("#out")) {
            e.preventDefault();
        }
        $(".navigationBar a").removeClass('active');
        $(this).addClass('active');
        if ($(this).is("#allUsers")) {
            $.get("getData/allUsers.php", function (data) {
                $("#userTable").html(data);
            });
        }
        else if ($(this).is("#report")) {
            $.get("getData/allReports.php", function (data) {
                $("#userTable").html(data);
            });
        }
        else if ($(this).is("#ban")) {
            $.get("getData/allBanned.php", function (data) {
                $("#userTable").html(data);
            });
        }
    });

    $(".logo").click(function () {
        $("#userTable").empty();
        $(".navigationBar a").removeClass('active');
    });
});
