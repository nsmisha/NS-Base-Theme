(function ($) {


    /**
     * Set text for each field in repeater
     *
     * @param $this
     */
    function setTextForRepeater($this) {
        var elements = $this.find('input[type="text"], select, textarea');
        if (elements.length > 0) {
            $this.closest('li.vc_param').find('.custom_text_for_repeater').first().remove();
            $this.closest('li.vc_param').prepend('<div class="wpb_element_label custom_text_for_repeater">' + $(elements[0]).val() + '</div>');
        }
    }

    /**
     * Add text preview for VC repeater
     */
    function previewTextForRepeater() {
        $('.vc_param_group-list > li').each(function () {
            setTextForRepeater($(this));
        });
        $(document).on('change', '.vc_param_group-list > li', function () {
            setTextForRepeater($(this));
        });
    }

    $(document).ready(function () {
        $('.chosen-select').chosen(
            {no_results_text: "Oops, nothing found!"}
        );

        $(document).on('click', '.vc_param_group-add_content', function () {
            var parent = $(this).parents('.vc_param_group-list');
            setTimeout(function () {
                parent.find('li.vc_param').eq(-1).find('.vc_control.column_toggle').click();
            }, 50);
        });

        // On VC widget loaded
        $(document).ajaxSuccess(function (event, xhr, settings) {
            if (settings.data !== undefined && settings.data.indexOf('vc_edit_form') > 0) {
                // Add text preview for VC repeater
                previewTextForRepeater();
            }
        });
    });

})(jQuery);


jQuery(document).on('click', '[data-action="toggle-upload-img"]', function (e) {
    e.preventDefault();
    var target = jQuery(this).attr('data-target');
    var preview = jQuery(this).attr('data-preview');

    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
        title: 'Upload Image',
        button: {
            text: jQuery(this).data('uploader_button_text')
        },
        multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected, run a callback.
    file_frame.on('select', function () {

        // We set multiple to false so only get one image from the uploader
        attachment = file_frame.state().get('selection').first().toJSON();
        jQuery(target).val(attachment.url);
        jQuery(preview).attr('src', attachment.url);

    });

    file_frame.on('close', function () {
        if (jQuery('.modal-backdrop').length > 0) {
            jQuery('body').addClass('modal-open');
        }
    });

    // Finally, open the modal
    file_frame.open();
});