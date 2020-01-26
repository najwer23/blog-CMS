$(document).ready(function () {

    $("#submitMail").click(function () {

        var email = $('input[name="email"]').val();
        var name = $('input[name="name"]').val();
        var surname = $('input[name="surname"]').val();
        var topic = $('input[name="topic"]').val();
        var text = $('textarea#text').val();

        if (email != 0 && name != 0 && surname != 0 && topic != 0 && text != 0) {
            $('.animation').show();
            $('.animation2').show();
            $.ajax({
                type: "POST",
                url: "/contact/ajaxMail",
                data: {
                    'email': email,
                    'name': name,
                    'surname': surname,
                    'topic': topic,
                    'text': text
                },
                success: function (data) {
                    $('.animation').hide();
                    $('.animation2').hide();


                    if (data.a[0]["email"] > 0) {
                        var output = '<div class="msgSent"><i class="far fa-check-square"></i> Wiadomość została wysłana</div>';
                    } else {
                        var output = '<div class="msgWrongEmail"><i class="fas fa-exclamation-triangle"></i> Błędny adres Email!</div>';
                    }

                    $("#c").html(output);
                    email = $('input[name="email"]').val('');
                },
            });
        } else {
            var output = '<div class="msgWrongEmail"><i class="fas fa-exclamation-triangle"></i> Wypełnij wszystkie pola!</div>';
            $("#c").html(output);
        }
    });
});
