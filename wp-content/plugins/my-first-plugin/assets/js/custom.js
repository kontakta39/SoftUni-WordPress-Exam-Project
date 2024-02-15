jQuery(document).ready(function ($) {

    var posts_per_page = 3;

    function cxc_load_more_posts(cxc_this, pageNumber) {
        var page_count = 0;
        var str = '&pageNumber=' + pageNumber + '&posts_per_page=' + posts_per_page + '&action=codex_load_more_post_ajax';

        if (!cxc_this.hasClass('cxc-disabled')) {

            jQuery.ajax({
                type: "POST",
                dataType: "html",
                url: ajax_posts.ajaxurl,
                data: str,
                success: function (response) {
                    if (response) {
                        cxc_this.removeClass('cxc-active');
                        var json_html = JSON.parse(response);
                        if (json_html.html.length) {
                            page_count = parseInt(pageNumber) + parseInt(1);
                            cxc_this.attr('data-page', page_count);
                            cxc_this.parents('.cxc-post-wrapper').find(".cxc-posts").append(json_html.html);
                        } else {
                            cxc_this.remove(); // Remove the button if there are no more posts
                        }
                    }
                }
            });
        }
        return false;
    }

    jQuery(document).on("click", ".codex-load-more", function () {
        var cxc_this = jQuery(this);
        var paged = cxc_this.attr('data-page');
        cxc_this.addClass('cxc-active');
        cxc_load_more_posts(cxc_this, paged);
        cxc_this.insertAfter('.cxc-posts'); // Move the 'Load More' button to the end of the the newly added posts.

        // Center the button after moving it
        var buttonContainer = cxc_this.parent();
        buttonContainer.css('text-align', 'center');
    });

});