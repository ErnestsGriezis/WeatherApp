$(document).ready(function () {
    $(document).on("click", ".city-add-submit", function () {
        const cityName = $("#city-name").val().trim();
        const $msg = $(".city-add-message");

        $msg.text("");

        if (!cityName) {
            $msg.text("City name is empty");
            return;
        }

        $.ajax({
            url: "/functions/city-add.php",
            method: "POST",
            dataType: "json",
            data: {city_name: cityName},
            success: function (res) {
                if (!res || !res.ok) {
                    $(".city-add-message").text(res && res.error ? res.error : "Error");
                    return;
                }

                $(".city-add-message").text("City added: " + res.city.name);
                $("#city-name").val("");
                location.reload();
            },
            error: function () {
                $msg.text("Server error");
            }
        });
    });
});
