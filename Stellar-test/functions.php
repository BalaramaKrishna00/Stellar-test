<?php
function mytheme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('menus');
}
add_action('after_setup_theme', 'mytheme_setup');

function mytheme_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'mytheme_scripts');

function load_custom_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap', false);
}
add_action('wp_enqueue_scripts', 'load_custom_fonts');

function register_projects_cpt() {
    $labels = array(
        'name' => 'Projects',
        'singular_name' => 'Project',
        'add_new' => 'Add New Project',
        'add_new_item' => 'Add New Project',
        'edit_item' => 'Edit Project',
        'new_item' => 'New Project',
        'view_item' => 'View Project',
        'search_items' => 'Search Projects',
        'not_found' => 'No Projects found',
        'not_found_in_trash' => 'No Projects found in Trash',
    );

    $args = array(
        'label' => 'Projects',
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'projects'),
        'show_in_rest' => true,
    );

    register_post_type('projects', $args);
}
add_action('init', 'register_projects_cpt');

function add_project_meta_boxes() {
    add_meta_box(
        'project_details_meta',
        'Project Details',
        'project_details_meta_callback',
        'projects',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_project_meta_boxes');

function project_details_meta_callback($post) {
    $client_name = get_post_meta($post->ID, '_client_name', true);
    $project_url = get_post_meta($post->ID, '_project_url', true);
    $technologies_used = get_post_meta($post->ID, '_technologies_used', true);
    wp_nonce_field('save_project_details_meta', 'project_details_meta_nonce');
    ?>
    <p>
        <label>Client Name</label><br>
        <input type="text" name="client_name" value="<?php echo esc_attr($client_name); ?>" style="width:100%;" />
    </p>
    <p>
        <label>Project URL</label><br>
        <input type="url" name="project_url" value="<?php echo esc_attr($project_url); ?>" style="width:100%;" />
    </p>
    <p>
        <label>Technologies Used (comma separated)</label><br>
        <input type="text" name="technologies_used" value="<?php echo esc_attr($technologies_used); ?>" style="width:100%;" />
    </p>
    <?php
}

function save_project_details_meta($post_id) {
    if (!isset($_POST['project_details_meta_nonce']) ||
        !wp_verify_nonce($_POST['project_details_meta_nonce'], 'save_project_details_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    error_log("Saving meta for post $post_id");
    if (isset($_POST['client_name'])) {
        error_log("Client Name: " . $_POST['client_name']);
        update_post_meta($post_id, '_client_name', sanitize_text_field($_POST['client_name']));
    }
    if (isset($_POST['project_url'])) {
        update_post_meta($post_id, '_project_url', esc_url_raw($_POST['project_url']));
    }
    if (isset($_POST['technologies_used'])) {
        update_post_meta($post_id, '_technologies_used', sanitize_text_field($_POST['technologies_used']));
    }
}
add_action('save_post', 'save_project_details_meta');
function enable_webp_upload($mime_types) {
    $mime_types['webp'] = 'image/webp';
    return $mime_types;
}
add_filter('upload_mimes', 'enable_webp_upload');
function validate_webp_upload($file) {
    $filetype = wp_check_filetype($file['name']);

    if ($filetype['ext'] === 'webp' && $filetype['type'] !== 'image/webp') {
        $file['type'] = 'image/webp';
    }

    return $file;
}
add_filter('wp_check_filetype_and_ext', 'validate_webp_upload', 10, 1);

function enqueue_project_filter_assets() {
    wp_enqueue_script('jquery'); // Ensure jQuery is loaded
    wp_localize_script('jquery', 'projectFilterAjax', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_project_filter_assets');


add_action('wp_ajax_load_more_projects', 'load_more_projects');
add_action('wp_ajax_nopriv_load_more_projects', 'load_more_projects');

function load_more_projects() {
    $paged = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;

    $args = array(
        'post_type'      => 'projects',
        'posts_per_page' => 6,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        ob_start();
        while ($query->have_posts()) : $query->the_post();

            $client_name = get_post_meta(get_the_ID(), '_client_name', true);
            $technologies = get_post_meta(get_the_ID(), '_technologies_used', true);
            $intro = strtok(strip_tags(get_the_content()), '.');
            $intro = $intro ? $intro . '.' : '';
            $permalink = get_permalink();
            ?>
            <div class="flex flex-col h-full rounded-xl overflow-hidden shadow-lg transition-all duration-300 dark:card-dark light:card-light fade-in stagger-delay-2">
                <a href="<?php echo esc_url($permalink); ?>" class="block relative h-48 overflow-hidden">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full', ['class' => 'absolute inset-0 w-full h-full object-cover']); ?>
                    <?php else : ?>
                        <div class="absolute inset-0 flex items-center justify-center p-6 bg-gradient-to-r from-indigo-500/10 to-emerald-500/10">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    <?php endif; ?>
                </a>
                <div class="flex flex-col flex-grow p-6">
                    <a href="<?php echo esc_url($permalink); ?>">
                        <h3 class="text-xl font-bold mb-2 hover:text-indigo-500 transition-colors"><?php the_title(); ?></h3>
                    </a>
                    <p class="opacity-80 mb-4"><?php echo esc_html($intro); ?></p>
                    <?php if ($technologies) : ?>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php
                            $techs = array_map('trim', explode(',', $technologies));
                            foreach ($techs as $tech) :
                                ?>
                                <span class="text-xs px-3 py-1 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400">
                                    <?php echo esc_html($tech); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="mt-auto flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                        <span class="text-sm opacity-70">Client: <?php echo esc_html($client_name); ?></span>
                        <a href="<?php echo esc_url($permalink); ?>" class="text-indigo-500 hover:text-indigo-400 transition-colors">
                            View Project <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
        echo ob_get_clean();
    endif;

    wp_die(); //AJAX
}

add_action('wp_ajax_filter_projects', 'filter_projects_callback');
add_action('wp_ajax_nopriv_filter_projects', 'filter_projects_callback');

function filter_projects_callback() {
    $paged = $_POST['page'] ?? 1;
    $tech_filter = sanitize_text_field($_POST['technology'] ?? 'all');

    $args = array(
        'post_type'      => 'projects',
        'posts_per_page' => 6,
        'paged'          => $paged,
    );

    if ($tech_filter !== 'all') {
        $args['meta_query'] = [[
            'key'     => '_technologies_used',
            'value'   => $tech_filter,
            'compare' => 'LIKE',
        ]];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

            $client_name = get_post_meta(get_the_ID(), '_client_name', true);
            $project_url = get_post_meta(get_the_ID(), '_project_url', true);
            $technologies = get_post_meta(get_the_ID(), '_technologies_used', true);
            $intro = strtok(strip_tags(get_the_content()), '.');
            $intro = $intro ? $intro . '.' : '';
            $permalink = get_permalink();
            ?>
            <div class="flex flex-col h-full rounded-xl overflow-hidden shadow-lg transition-all duration-300 dark:card-dark light:card-light fade-in stagger-delay-2">
                <a href="<?php echo esc_url($permalink); ?>" class="block relative h-48 overflow-hidden">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full', ['class' => 'absolute inset-0 w-full h-full object-cover']); ?>
                    <?php else : ?>
                        <div class="absolute inset-0 flex items-center justify-center p-6 bg-gradient-to-r from-indigo-500/10 to-emerald-500/10">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    <?php endif; ?>
                </a>

                <div class="flex flex-col flex-grow p-6">
                    <a href="<?php echo esc_url($permalink); ?>">
                        <h3 class="text-xl font-bold mb-2 hover:text-indigo-500 transition-colors"><?php the_title(); ?></h3>
                    </a>
                    <p class="opacity-80 mb-4"><?php echo esc_html($intro); ?></p>

                    <?php if ($technologies) : ?>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php
                            $techs = array_map('trim', explode(',', $technologies));
                            foreach ($techs as $tech) :
                                ?>
                                <span class="text-xs px-3 py-1 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400">
                                    <?php echo esc_html($tech); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="mt-auto flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                        <span class="text-sm opacity-70">Client: <?php echo esc_html($client_name); ?></span>
                        <a href="<?php echo esc_url($permalink); ?>" class="text-indigo-500 hover:text-indigo-400 transition-colors">
                            View Project <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
    else :
        echo '<p class="text-center col-span-3">No projects found.</p>';
    endif;
    wp_reset_postdata();
    wp_die(); 
}

function scroll_to_section_with_hash() {
    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        if(window.location.hash) {
            var targetId = window.location.hash.substring(1); 
            var targetElement = document.getElementById(targetId);
            if (targetElement) {
                setTimeout(function() {
                    targetElement.scrollIntoView({ behavior: "smooth" });
                }, 5000); 
            }
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'scroll_to_section_with_hash');

?>