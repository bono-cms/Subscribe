
(function($){
    // Site subscribe handler
    $(function(){
        $("[data-button='subscribe']").click(function(event){
            event.preventDefault();

            // Save a referrer to the button
            var $button = $(this);

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "/module/subscribe/subscribe",
                data: {
                    email: $("[data-subscribe-input='email']").val(),
                    name: $("[data-subscribe-input='name']").val()
                },
                success: function(response){
                    var $modal = $("#subscribe-modal");

                    $modal.modal('show');
                    $body = $modal.find(".modal-body");

                    // If operation completed
                    if (response.code) {
                        // Update with code
                        $body.text(response.message);

                        // Disable the button if successful
                        if (response.code == 1){
                            $button.prop('disabled', true);
                        }

                    } else {
                        var ul = document.createElement('ul');

                        for (var key in response) {
                            var value = response[key];
                            var li = document.createElement('li');

                            $(li).text(value);
                            $(ul).append(li);
                        }

                        $body.html($(ul).html());
                    }
                }
            });
        });
    });

})(jQuery);
