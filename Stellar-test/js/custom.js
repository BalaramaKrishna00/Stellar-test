jQuery(document).ready(function($) {
    let currentPage = 1;
    let currentFilter = 'all';

    const loadMoreBtn = jQuery('#load-more');
    const projectList = jQuery('#project-list');

    if (loadMoreBtn.length && projectList.length) {
        loadMoreBtn.on('click', function () {
            let page = parseInt(jQuery(this).attr('data-page'));

            jQuery.ajax({
                url: '<?php echo admin_url("admin-ajax.php"); ?>',
                type: 'POST',
                data: {
                    action: 'load_more_projects',
                    page: page
                },
                success: function (data) {
                    if (jQuery.trim(data)) {
                        projectList.append(data);
                        loadMoreBtn.attr('data-page', page + 1);
                    } else {
                        loadMoreBtn.hide();
                    }
                }
            });
        });
    }

    function loadProjects(page = 1, technology = 'all', append = false) {
        jQuery.ajax({
            url: projectFilterAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_projects',
                technology: technology,
                page: page
            },
            beforeSend: function() {
                if (!append) {
                    projectList.html('<p class="text-center col-span-3">Loading...</p>');
                }
            },
            success: function(response) {
                if (append) {
                    projectList.append(response);
                } else {
                    projectList.html(response);
                }
                currentPage = page;
                if (loadMoreBtn.length) {
                    loadMoreBtn.attr('data-page', page + 1).show();
                }
            }
        });
    }

    // Filter button click
    jQuery('.tech-filter').on('click', function() {
        jQuery('.tech-filter').removeClass('active');
        jQuery(this).addClass('active');

        currentFilter = jQuery(this).data('filter');
        currentPage = 1;
        loadProjects(currentPage, currentFilter, false);
    });
});