jQuery(document).ready(function($){
    function ws_set_image(){
        var frame;
        $('.category-media-button').on('click', function(e) {
            e.preventDefault();
            var button = $(this);
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: 'Select or Upload Media Of Your Chosen Persuasion',
                button: {
                    text: 'Use this media'
                },
                multiple: false
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#category-image-id').val(attachment.id);
                $('#category-image-wrapper').html('<img src="'+attachment.url+'" style="max-width:100%;"/>');
            });
            frame.open();
        });

        $('.category-media-remove').on('click', function(e) {
            e.preventDefault();
            $('#category-image-id').val('');
            $('#category-image-wrapper').html('');
        });
    }
    ws_set_image();
});