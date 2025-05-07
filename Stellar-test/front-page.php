<?php get_header(); ?>
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center" id="Introtext">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 hero-gradient opacity-10"></div>
            <svg class="absolute bottom-0 left-0 w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="currentColor" fill-opacity="0.05" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,218.7C672,235,768,245,864,234.7C960,224,1056,192,1152,176C1248,160,1344,160,1392,160L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
        <div class="container mx-auto px-4 z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 fade-in" style="opacity: 1; transform: translateY(0px);">We Create <span class="text-indigo-500">Digital Experiences</span> That Matter</h1>
                <p class="text-xl md:text-2xl mb-10 opacity-80 fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">Transforming ideas into impactful digital solutions that drive growth and innovation for forward-thinking brands.</p>
                <div class="flex flex-col md:flex-row justify-center gap-4 fade-in stagger-delay-2" style="opacity: 1; transform: translateY(0px);">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-full transition-colors text-lg font-medium">
                        View Our Work
                    </button>
                    <button class="border-2 border-indigo-600 hover:bg-indigo-600 hover:text-white px-8 py-3 rounded-full transition-colors text-lg font-medium">
                        Our Process
                    </button>
                </div>
                <div class="mt-20 scroll-indicator fade-in stagger-delay-3" style="opacity: 1; transform: translateY(0px);">
                    <a href="#projects" class="inline-block">
                        <i class="fas fa-chevron-down text-2xl opacity-70"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="fade-in" style="opacity: 1; transform: translateY(0px);">
                    <div class="text-4xl font-bold text-indigo-500 mb-2">120+</div>
                    <div class="text-lg opacity-80">Projects Completed</div>
                </div>
                <div class="fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">
                    <div class="text-4xl font-bold text-indigo-500 mb-2">98%</div>
                    <div class="text-lg opacity-80">Client Satisfaction</div>
                </div>
                <div class="fade-in stagger-delay-2" style="opacity: 1; transform: translateY(0px);">
                    <div class="text-4xl font-bold text-indigo-500 mb-2">15+</div>
                    <div class="text-lg opacity-80">Industry Awards</div>
                </div>
                <div class="fade-in stagger-delay-3" style="opacity: 1; transform: translateY(0px);">
                    <div class="text-4xl font-bold text-indigo-500 mb-2">8+</div>
                    <div class="text-lg opacity-80">Years Experience</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 fade-in" style="opacity: 1; transform: translateY(0px);">Our Featured Projects</h2>
                <p class="max-w-2xl mx-auto opacity-80 fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">Explore our portfolio of innovative digital solutions that have helped our clients achieve their business goals.</p>
            </div>
            
            <!-- Filter Buttons -->
            <div class="flex flex-wrap justify-center gap-3 mb-12 fade-in stagger-delay-2" style="opacity: 1; transform: translateY(0px);">
    <button class="tech-filter active px-4 py-2 rounded-full border border-indigo-500 text-sm" data-filter="all">All Projects</button>
    <button class="tech-filter px-4 py-2 rounded-full border border-indigo-500 text-sm" data-filter="JavaScript">JavaScript</button>
    <button class="tech-filter px-4 py-2 rounded-full border border-indigo-500 text-sm" data-filter="Tailwind CSS">Tailwind CSS</button>
    <button class="tech-filter px-4 py-2 rounded-full border border-indigo-500 text-sm" data-filter="WordPress">WordPress</button>
    <button class="tech-filter px-4 py-2 rounded-full border border-indigo-500 text-sm" data-filter="REST API">REST API</button>
    <button class="tech-filter px-4 py-2 rounded-full border border-indigo-500 text-sm" data-filter="Bootstrap">Bootstrap</button>
    <button class="tech-filter px-4 py-2 rounded-full border border-indigo-500 text-sm" data-filter="Ajax">Ajax</button>
</div>           
            <?php
$args = array(
    'post_type'      => 'projects',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
);
$query = new WP_Query($args);

if ($query->have_posts()) :
    echo '<div id="project-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">';
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
    echo '</div>';
    wp_reset_postdata();
endif;
?>
            <div class="text-center mt-12 fade-in" style="opacity: 1; transform: translateY(0px);">
                <button id="load-more" data-page="2"  class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-full transition-colors text-lg font-medium">
                    View All Projects
                </button>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 relative" id="services">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 hero-gradient opacity-5"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 fade-in" style="opacity: 1; transform: translateY(0px);">Our Services</h2>
                <p class="max-w-2xl mx-auto opacity-80 fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">We offer comprehensive digital solutions tailored to your unique business needs.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg fade-in" style="opacity: 1; transform: translateY(0px);">
                    <div class="bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 w-16 h-16 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-laptop-code text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Web Development</h3>
                    <p class="opacity-80 mb-4">Custom websites and web applications built with cutting-edge technologies for optimal performance and user experience.</p>
                    <a href="#" class="text-indigo-500 font-medium flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">
                    <div class="bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 w-16 h-16 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Mobile App Development</h3>
                    <p class="opacity-80 mb-4">Native and cross-platform mobile applications that deliver seamless experiences across all devices.</p>
                    <a href="#" class="text-indigo-500 font-medium flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg fade-in stagger-delay-2" style="opacity: 1; transform: translateY(0px);">
                    <div class="bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 w-16 h-16 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-paint-brush text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">UI/UX Design</h3>
                    <p class="opacity-80 mb-4">User-centered design that combines aesthetics with functionality to create intuitive and engaging digital experiences.</p>
                    <a href="#" class="text-indigo-500 font-medium flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg fade-in stagger-delay-3" style="opacity: 1; transform: translateY(0px);">
                    <div class="bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 w-16 h-16 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-shopping-cart text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">E-commerce Solutions</h3>
                    <p class="opacity-80 mb-4">Scalable online stores with secure payment gateways, inventory management, and optimized checkout processes.</p>
                    <a href="#" class="text-indigo-500 font-medium flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg fade-in stagger-delay-4" style="opacity: 1; transform: translateY(0px);">
                    <div class="bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 w-16 h-16 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Digital Marketing</h3>
                    <p class="opacity-80 mb-4">Data-driven strategies to increase your online visibility, drive traffic, and convert leads into customers.</p>
                    <a href="#" class="text-indigo-500 font-medium flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg fade-in stagger-delay-5" style="opacity: 1; transform: translateY(0px);">
                    <div class="bg-rose-100 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 w-16 h-16 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-bullhorn text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Branding &amp; Identity</h3>
                    <p class="opacity-80 mb-4">Comprehensive branding solutions that help you stand out in the market and connect with your target audience.</p>
                    <a href="#" class="text-indigo-500 font-medium flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20" id="Clients">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 fade-in" style="opacity: 1; transform: translateY(0px);">What Our Clients Say</h2>
                <p class="max-w-2xl mx-auto opacity-80 fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">Don't just take our word for it. Here's what our clients have to say about working with us.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg fade-in" style="opacity: 1; transform: translateY(0px);">
                    <div class="flex items-center mb-4">
                        <div class="text-amber-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="italic mb-6">"Nexus Digital transformed our online presence completely. Their team's attention to detail and creative approach resulted in a website that perfectly represents our brand and has significantly increased our conversion rates."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-indigo-200 flex items-center justify-center text-indigo-600 font-bold text-xl">
                            JD
                        </div>
                        <div class="ml-4">
                            <div class="font-medium">Jane Doe</div>
                            <div class="text-sm opacity-70">CEO, TechStart Inc.</div>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg fade-in stagger-delay-1" style="opacity: 1; transform: translateY(0px);">
                    <div class="flex items-center mb-4">
                        <div class="text-amber-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="italic mb-6">"Working with Nexus Digital was a game-changer for our business. Their mobile app development expertise helped us launch a product that our customers love. The team was responsive, professional, and delivered beyond our expectations."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-emerald-200 flex items-center justify-center text-emerald-600 font-bold text-xl">
                            MS
                        </div>
                        <div class="ml-4">
                            <div class="font-medium">Michael Smith</div>
                            <div class="text-sm opacity-70">Founder, AppWorks</div>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 rounded-xl transition-all duration-300 dark:card-dark light:card-light shadow-lg fade-in stagger-delay-2" style="opacity: 1; transform: translateY(0px);">
                    <div class="flex items-center mb-4">
                        <div class="text-amber-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="italic mb-6">"The e-commerce platform Nexus Digital built for us has been instrumental in our growth. Their understanding of user experience and attention to detail resulted in a seamless shopping experience that our customers love."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-purple-200 flex items-center justify-center text-purple-600 font-bold text-xl">
                            SJ
                        </div>
                        <div class="ml-4">
                            <div class="font-medium">Sarah Johnson</div>
                            <div class="text-sm opacity-70">Marketing Director, Fashion Forward</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 relative" id="Contact">
        <div class="absolute inset-0 hero-gradient opacity-20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 fade-in" style="opacity: 1; transform: translateY(0px);">Ready to Transform Your Digital Presence?</h2>
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

<script>
jQuery(document).ready(function($) {
    let currentFilter = 'all';
    $('.tech-filter').on('click', function() {
        currentFilter = $(this).data('filter');

        $('.tech-filter').removeClass('active');
        $(this).addClass('active');
        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            type: 'POST',
            data: {
                action: 'filter_projects',
                technology: currentFilter,
                page: 1
            },
            success: function(response) {
                $('#project-list').html(response);
                $('#load-more').attr('data-page', 2).attr('data-filter', currentFilter).show();
            }
        });
    });

    // Load More Button Click
    $('#load-more').on('click', function () {
        const page = $(this).attr('data-page');
        const filter = $(this).attr('data-filter') || currentFilter;

        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            type: 'POST',
            data: {
                action: 'load_more_projects',
                technology: filter,
                page: page
            },
            success: function(response) {
                if (response.trim()) {
                    $('#project-list').append(response);
                    $('#load-more').attr('data-page', parseInt(page) + 1);
                } else {
                    $('#load-more').hide();
                }
            }
        });
    });
});

</script>

<style>
.tech-filter.active {
    background-color: #6366F1;
    color: #fff;
    border-color: #6366F1;
}
</style>