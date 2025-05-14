
            jQuery(document).ready(function($) {
                // Mobile image upload
                $('#mobile_image_upload').on('click', function(e) {
                    e.preventDefault();
                    
                    var image_frame;
                    
                    if (image_frame) {
                        image_frame.open();
                        return;
                    }
                    
                    image_frame = wp.media({
                        title: 'Select Mobile Banner Image',
                        multiple: false,
                        library: {
                            type: 'image'
                        }
                    });
                    
                    image_frame.on('select', function() {
                        var attachment = image_frame.state().get('selection').first().toJSON();
                        $('#mobile_banner_image_id').val(attachment.id);
                        $('.mobile-image-preview').html('<img src="' + attachment.url + '" style="max-width: 100%; height: auto;">');
                        $('#mobile_image_upload').text('Change Mobile Banner');
                        
                        if ($('#mobile_image_remove').length === 0) {
                            $('.mobile-image-container').append('<button type="button" class="button mobile-image-remove" id="mobile_image_remove">Remove Mobile Banner</button>');
                        }
                    });
                    
                    image_frame.open();
                });
                
                // Mobile image remove
                $(document).on('click', '#mobile_image_remove', function(e) {
                    e.preventDefault();
                    $('#mobile_banner_image_id').val('');
                    $('.mobile-image-preview').html('');
                    $('#mobile_image_upload').text('Upload Mobile Banner');
                    $(this).remove();
                });
            });