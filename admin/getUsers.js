$(document).ready(function () {
    $(".navigationBar a").click(function (e) {
        if (!$(this).is("#out")) {
            e.preventDefault();
        }
        $(".navigationBar a").removeClass('active');
        $(this).addClass('active');
        if ($(this).is("#allUsers")) {
            $.get("allUsers.php", function (data) {
                $("#userTable").html(data);
            });
        }
    });

    $(".logo").click(function () {
        $("#userTable").empty();
        $(".navigationBar a").removeClass('active');
    });
});
