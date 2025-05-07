<?php get_header(); ?>
<body class="dark">
    <!-- Project Hero Section -->
    <section class="pt-32 pb-16 relative">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 hero-gradient opacity-10"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row items-start gap-8">
                <div class="w-full md:w-2/3">
                    <div class="mb-6 flex items-center">
                        <a href="https://dev-krishnaprojects.pantheonsite.io/" class="text-indigo-500 hover:text-indigo-400 transition-colors flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Projects
                        </a>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 fade-in" style="opacity: 1; transform: translateY(0px);"><?php the_title(); ?></h1>
                        <div class="flex flex-wrap gap-3 mb-6 fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">
                        <?php
$technologies = get_post_meta(get_the_ID(), '_technologies_used', true);
if ($technologies) {
    $tech_array = array_map('trim', explode(',', $technologies));
    echo '<div class="flex flex-wrap gap-3 mb-6 fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">';
    foreach ($tech_array as $tech) {
        echo '<span class="text-sm px-4 py-1 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400">'
            . esc_html($tech) .
            '</span>';
    }
    echo '</div>';
}
?>
</div>
                        <p class="text-xl opacity-80 mb-8 fade-in stagger-delay-2" style="opacity: 1; transform: translateY(0px);">
    <?php
        $content = get_the_content();
        $intro = strtok($content, '.');
        echo esc_html($intro) . '.';
    ?>
</p>
                    <div class="flex flex-wrap gap-6 mb-8 fade-in stagger-delay-3" style="opacity: 1; transform: translateY(0px);">
                        <div>
                            <div class="text-sm opacity-70 mb-1">Client</div>
                            <div class="font-medium">
    <?php
        $client_name = get_post_meta(get_the_ID(), '_client_name', true);
        
        if (!empty($client_name)) {
            echo esc_html($client_name);
        } else {
            echo 'No client name available';
        }
    ?>
</div>
          </div>
                       </div>
                    <?php
$project_url = get_post_meta(get_the_ID(), '_project_url', true);
if ($project_url) :
?>
<div class="flex flex-wrap gap-4 fade-in stagger-delay-4" style="opacity: 1; transform: translateY(0px);">
    <a href="<?php echo esc_url($project_url); ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-full transition-colors text-lg font-medium flex items-center" target="_blank" rel="noopener">
        <i class="fas fa-globe mr-2"></i> Visit Website
    </a>
    <a href="<?php echo esc_url($project_url); ?>" class="border-2 border-indigo-600 hover:bg-indigo-600 hover:text-white px-6 py-3 rounded-full transition-colors text-lg font-medium flex items-center" target="_blank" rel="noopener">
        <i class="fas fa-play mr-2"></i> Watch Demo
    </a>
</div>
<?php endif; ?>
                </div>
                <div class="w-full md:w-1/3 mt-8 md:mt-0"><div class="rounded-xl overflow-hidden shadow-lg transition-all duration-300 dark:card-dark light:card-light p-6 fade-in stagger-delay-2" style="opacity: 1; transform: translateY(0px);">
        
        <div class="text-center">
            <?php 
                if (has_post_thumbnail()) { 
                    the_post_thumbnail('cover', ['class' => 'img-fluid rounded w-100']);
                } else { 
                    echo '<p>No featured image available.</p>';
                } 
            ?>
        </div><br>                    
                    <h3 class="text-xl font-bold mb-4">Project Overview</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Design</span>
                                    <span class="text-sm font-medium">95%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                    <div class="progress-bar" style="width: 95%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Development</span>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Testing</span>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Deployment</span>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                                <div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Project Details -->
    <section class="py-16 bg-gradient-to-b from-transparent to-indigo-50/5">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-16">
                <div>
                    <h2 class="text-3xl font-bold mb-6 fade-in" style="opacity: 1; transform: translateY(0px);">Project Details</h2>
                    <div class="space-y-6 fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">
    <?php the_content(); ?>
</div></div></div>
        </div>
    </section>
    <!-- Results & Impact -->
    <section class="py-16 bg-gradient-to-b from-indigo-50/5 to-transparent">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-10 text-center fade-in" style="opacity: 1; transform: translateY(0px);">Results &amp; Impact</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg text-center fade-in" style="opacity: 1; transform: translateY(0px);">
                    <div class="text-4xl font-bold text-indigo-500 mb-2">42%</div>
                    <div class="text-lg opacity-80">Increase in Conversion Rate</div>
                </div>                
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg text-center fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">
                    <div class="text-4xl font-bold text-emerald-500 mb-2">68%</div>
                    <div class="text-lg opacity-80">Growth in Repeat Customers</div>
                </div>
                
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg text-center fade-in stagger-delay-2" style="opacity: 1; transform: translateY(0px);">
                    <div class="text-4xl font-bold text-purple-500 mb-2">3.2x</div>
                    <div class="text-lg opacity-80">Return on Investment</div>
                </div>                
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg text-center fade-in stagger-delay-3" style="opacity: 1; transform: translateY(0px);">
                    <div class="text-4xl font-bold text-amber-500 mb-2">12K+</div>
                    <div class="text-lg opacity-80">New Registered Users</div>
                </div>
            </div>
        </div>
    </section>
    <!-- Client Testimonial -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="testimonial-card p-8 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg fade-in" style="opacity: 1; transform: translateY(0px);">
                    <div class="flex items-center mb-6">
                        <div class="text-amber-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-2xl italic mb-8">"Nexus Digital transformed our vision into reality. Their team's expertise in both design and development resulted in a platform that not only looks beautiful but also effectively communicates our brand's commitment to sustainability. The carbon footprint tracking feature has been a game-changer for our business."</p>
                    <div class="flex items-center">
                        <div class="w-16 h-16 rounded-full bg-emerald-200 flex items-center justify-center text-emerald-600 font-bold text-xl">
                            RL
                        </div>
                        <div class="ml-4">
                            <div class="text-xl font-medium">Rebecca Lee</div>
                            <div class="opacity-70">CEO, GreenLife Organics</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Next Projects -->
    <section class="py-16 bg-gradient-to-b from-transparent to-indigo-50/5">
        <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold mb-10 text-center fade-in">Explore More Projects</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php
        $recent_projects = new WP_Query(array(
            'post_type' => 'projects',
            'posts_per_page' => 3,
            'post_status' => 'publish'
        ));
        if ($recent_projects->have_posts()) :
            while ($recent_projects->have_posts()) : $recent_projects->the_post();
                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                $title = get_the_title();
                $excerpt = get_the_excerpt();
                $permalink = get_permalink();
        ?>
            <div class="rounded-xl overflow-hidden shadow-lg transition-all duration-300 dark:card-dark light:card-light fade-in group">
                <div class="relative h-48 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                        <span class="text-white font-medium"><?php echo esc_html($title); ?></span>
                    </div>
                    <?php if ($thumbnail_url): ?>
                        <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover" />
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center text-gray-500">No Image</div>
                    <?php endif; ?>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2"><?php echo esc_html($title); ?></h3>
                    <p class="opacity-80 mb-4"><?php echo esc_html(wp_trim_words($excerpt, 20)); ?></p>
                    <a href="<?php echo esc_url($permalink); ?>" class="text-indigo-500 hover:text-indigo-400 transition-colors flex items-center">
                        View Project <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>
    </section>
    <!-- CTA Section -->
    <section class="py-20 relative">
        <div class="absolute inset-0 hero-gradient opacity-20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 fade-in" style="opacity: 1; transform: translateY(0px);">Ready to Start Your Project?</h2>
                <p class="text-xl mb-10 opacity-80 fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">Let's collaborate to create innovative digital solutions that drive your business forward.</p>
                <div class="flex flex-col md:flex-row justify-center gap-4 fade-in stagger-delay-2" style="opacity: 1; transform: translateY(0px);">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-full transition-colors text-lg font-medium">
                        Start a Project
                    </button>
                    <button class="border-2 border-indigo-600 hover:bg-indigo-600 hover:text-white px-8 py-3 rounded-full transition-colors text-lg font-medium">
                        Contact Us
                    </button>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>