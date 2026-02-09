$(document).ready(function () {
    $(document).on("click", ".city-add-submit", function () {
        const cityName = $("#city-name").val().trim();
        const $msg = $(".city-add-message");
        const $btn = $(this);

        loading($btn)

        $msg.text("");

        if (!cityName) {
            $msg.text("City name is empty");
            stopLoading($btn);
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

                $msg.text("City added: " + res.city.name);
                $("#city-name").val("");
                location.reload();
            },
            error: function () {
                $msg.text("Server error");
            },
            complete: function () {
                stopLoading($btn);
            }
        });
    });


    function loading($button) {
        $button.addClass("is-loading");
    }

    function stopLoading($button) {
        $button.removeClass("is-loading");
    }
});
