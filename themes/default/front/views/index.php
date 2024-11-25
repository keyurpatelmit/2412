            <!-- home banner section html start -->
            <section class="home-banner">
                <div class="wave-banner-patten-overlay"></div>
                <div class="home-banner-slider">
                    <div class="home-banner-content" style="background-image: url('themes/default/admin/assets/images/comman_image/<?= $home_banner->image_1; ?>');">
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="home-banner-detail col-lg-10 offset-lg-1">
                                <h2 class="home-banner-title"><?= $home_banner->main_title; ?></h2>
                                <p class="home-banner-paragraph"><?= $home_banner->sub_title; ?></p>
                                <a href="<?= base_url('services') ?>" class="button-primary">Our Services</a>
                            </div>
                        </div>
                    </div>
                    <div class="home-banner-content" style="background-image: url('themes/default/admin/assets/images/comman_image/<?= $home_banner->image_2; ?>');">
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="home-banner-detail col-lg-10 offset-lg-1">
                                <h2 class="home-banner-title"><?= $home_banner->main_title_2; ?></h2>
                                <p class="home-banner-paragraph"><?= $home_banner->sub_title_2; ?></p>
                                <a href="<?= base_url('certificate') ?>" class="button-primary">View Certificates</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- home service html section -->
            <section class="home-service-section">
                <div class="wave-pattern-bottom"></div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="section-head-white">
                                <h3 class="section-title">
                                    WHY CHOOSE US FOR INSPECTION!
                                </h3>
                                <p class="section-paragraph">
                                    Ensure the reliability, safety, and performance of your equipment with our comprehensive inspection solutions. This category covers detailed assessments, compliance checks, preventive maintenance evaluations, and condition monitoring for machinery across industries. Designed to meet industry standards, our inspections help you identify potential issues early, reduce downtime, and enhance operational efficiency.
                                <a href="<?= base_url('services') ?>" class="button-white-border section-btn"> view all services</a>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="service-type-group">
                                <div class="service-type">
                                    <figure class="service-type-img">
                                        <img src="<?= $front_assets; ?>/img/builderon-img5.png" alt="">
                                    </figure>
                                    <div class="service-detail">
                                        <a href="">
                                            <h5 class="service-title">
                                                MODERN TECHNIQUE
                                            </h5>
                                        </a>
                                        <p class="service-info">
                                            We use cutting-edge tools and methods to enhance efficiency and precision in every project.
                                        </p>
                                    </div>
                                </div>
                                <div class="service-type">
                                    <figure class="service-type-img">
                                        <img src="<?= $front_assets; ?>/img/builderon-img6.png" alt="">
                                    </figure>
                                    <div class="service-detail">
                                        <a href="">
                                            <h5 class="service-title">
                                                QUALITY INSURES
                                            </h5>
                                        </a>
                                        <p class="service-info">
                                            Only premium, durable, and sustainable materials are chosen to ensure long-lasting results.
                                        </p>
                                    </div>
                                </div>
                                <div class="service-type">
                                    <figure class="service-type-img">
                                        <img src="<?= $front_assets; ?>/img/builderon-img7.png" alt="">
                                    </figure>
                                    <div class="service-detail">
                                        <a href="">
                                            <h5 class="service-title">
                                                PROFESSIONAL TEAM
                                            </h5>
                                        </a>
                                        <p class="service-info">
                                             Our team of skilled professionals brings expertise and dedication to every project.
                                        </p>
                                    </div>
                                </div>
                                <div class="service-type">
                                    <figure class="service-type-img">
                                        <img src="<?= $front_assets; ?>/img/builderon-img8.png" alt="">
                                    </figure>
                                    <div class="service-detail">
                                        <a href="">
                                            <h5 class="service-title">
                                                24/7 SUPPORT
                                            </h5>
                                        </a>
                                        <p class="service-info">
                                            We are always available to provide assistance and ensure seamless project execution.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- home comment html section -->
            <section class="home-comment-section">
                <div class="container">
                    <div class="comment-content">
                       <!--  <figure class="comment-img">
                            <img src="<?= $front_assets; ?>/img/builderon-img04.png" alt="">
                        </figure> -->
                        <div class="comment-detail">
                            <h4 class="comment-title">"We craft seamless automation solutions with cutting-edge technology for your business success."</h4>
                            <!-- <h5 class="comment-author">- Henry scott, ceo</h5> -->
                        </div>
                        <!-- <figure class="comment-fig">
                            <img src="<?= $front_assets; ?>/img/builderon-img001.png" alt="">
                        </figure> -->
                    </div>
                </div>
            </section>
            <!-- home client slider section -->
            <div class="home-client-slider-section">
                <div class="container">
                    <div class="client-slider">
                        <figure class="client-logo-img">
                            <img src="<?= $front_assets; ?>/img/client_1.png" alt="">
                        </figure>
                        <figure class="client-logo-img">
                            <img src="<?= $front_assets; ?>/img/client_2.png" alt="">
                        </figure>
                        <figure class="client-logo-img">
                            <img src="<?= $front_assets; ?>/img/client_3.png" alt="">
                        </figure>
                        <figure class="client-logo-img">
                            <img src="<?= $front_assets; ?>/img/client_4.png" alt="">
                        </figure>
                        <figure class="client-logo-img">
                            <img src="<?= $front_assets; ?>/img/client_5.png" alt="">
                        </figure>
                        <figure class="client-logo-img">
                            <img src="<?= $front_assets; ?>/img/client_6.png" alt="">
                        </figure>
                        <figure class="client-logo-img">
                            <img src="<?= $front_assets; ?>/img/client_8.png" alt="">
                        </figure>
                    </div>
                </div>
            </div>
            <!-- home about us  htnml section -->
          <!--   <section class="home-about-section">
                <div class="overlay"></div>
                <div class="container">
                    <div class="about-us-inner">
                        <div class="about-left-content">
                            <div class="pattern-overlay"></div>
                            <div class="section-head">
                                <span class="section-title-divider">INTRODUCTION</span>
                                <h3 class="section-title">HOW WE BECAME BEST AMONG OTHERS?</h3>
                                <p class="section-paragraph"> Through relentless innovation, commitment to quality, and a customer-centric approach, we have set a benchmark in the industry. Our dedication to excellence ensures that we consistently deliver outstanding results.</p>
                                <div class="about-list">
                                    <ul>
                                        <li>
                                            <i aria-hidden="true" class="fas fa-minus"></i>
                                             Quality Control Systems with 100% Satisfaction Guaranteess
                                        </li>
                                        <li>
                                            <i aria-hidden="true" class="fas fa-minus"></i>
                                           A Highly Professional Team and Accurate Testing Processes
                                        </li>
                                        <li>
                                            <i aria-hidden="true" class="fas fa-minus"></i>
                                            Exceptional Workmanship from Experienced and Qualified Experts
                                        </li>
                                    </ul>
                                </div>
                                <a href="" class="section-btn button-primary"> more about us</a>
                            </div>
                        </div>
                        <div class="about-right-content">
                            <div class="pattern-overlay box-orange"></div>
                            <figure class="about-right-img">
                                <div class="video-button">
                                    <a id="video-container" data-video-id="IUN664s7N-c">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </section> -->
            <!-- home call html section -->
            <section class="home-call-section">
                <div class="top-pattern"></div>
                <!-- <div class="bottom-pattern"></div> -->
                <div class="pattern-overlay right-pattern"></div>
                <div class="overlay"></div>
                <div class="container">
                    <div class="call-inner">
                        <div class="call-content">
                            <div class="call-icon"></div>
                            <div class="section-head-white">
                                <span class="section-title-divider">
                                    CALL TO ACTION
                                </span>
                                <h4 class="section-title">
                                    WE BELIEVE GOOD SERVICE
                                </h4>
                                <h3 class="section-title secondary-color">
                                    GOOD HAPPY BUSINESS RELATIONSHIPS.
                                </h3>
                                <span class="section-divider"></span>
                            </div>
                            <div class="contact-info-list">
                                <ul>
                                    <li>
                                        <a href="tel:<?= $system_details->mobile ?>">
                                            <h3> +91 <?= $system_details->mobile ?></h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:<?= $system_details->email ?>">
                                            <h3><span class="__cf_email__" data-cfemail=""><?= $system_details->email ?></span></h3>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <figure class="call-img">
                        </figure>
                    </div>
                </div>
            </section>
            <!-- home gallery html section -->
<!--             <section class="home-gallery-section">
                <div class="pattern-overlay trangle-top"></div>
                <div class="pattern-overlay trangle-bottom"></div>
                <div class="container">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="section-head text-center">
                            <div class="section-head">
                                <span class="section-title-divider">
                                    CONSTRUCTION PROJECTS
                                </span>
                                <h3 class="section-title">
                                    OUR RECENT PROJECTS
                                </h3>
                                <p class="section-paragraph">
                                    Magna voluptatum dolorem! Dolores! Sociosqu commodo nobis imperdiet lacinia? Magni! Felis, elementum nobis imperdiet lacinia nobis imperdiet lacinia.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-nav">
                        <ul class="filter-menu">
                            <li class="button filtering-button is-checked" data-filter="*">All</li>
                            <li class="button filtering-button" data-filter=".construction">construction</li>
                            <li class="button filtering-button" data-filter=".mechanical">mechanical</li>
                            <li class="button filtering-button" data-filter=".consulting">consulting</li>
                        </ul>
                    </div>
                    <div class="gallery-container">
                        <div class="gallery-grid">
                            <div class="mix single-gallery gallery-grid-item construction">
                                <figure class="gallery-img">
                                    <a href="<?= $front_assets; ?>/img/builderon-img27.jpg" data-fancybox="gallery" class="img-box">
                                        <img src="<?= $front_assets; ?>/img/builderon-img27.jpg" alt="">
                                    </a>
                                    <div class="facility-gallery-wrapper">
                                        <div class="facility-content">
                                            <h5 class="facility-title">
                                                <a href="">CONSTRUCTING BUILDING</a>
                                            </h5>
                                            <p class="facility-info">
                                                Lorem quam reprehenderit sunt posuere. Voluptatum justo, cillum ac nihil magni ut reprehenderit purus nibh sed, ornare etiam? Vehicula facilisi
                                            </p>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                            <div class="single-gallery gallery-grid-item construction">
                                <figure class="gallery-img">
                                    <a href="<?= $front_assets; ?>/img/builderon-img28.jpg" data-fancybox="gallery" class="img-box">
                                        <img src="<?= $front_assets; ?>/img/builderon-img28.jpg" alt="">
                                    </a>
                                    <div class="facility-gallery-wrapper">
                                        <div class="facility-content">
                                            <h5 class="facility-title">
                                                <a href="">MINING PROJECT</a>
                                            </h5>
                                            <p class="facility-info">
                                                Lorem quam reprehenderit sunt posuere. Voluptatum justo, cillum ac nihil magni ut reprehenderit purus nibh sed, ornare etiam? Vehicula facilisi
                                            </p>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                            <div class="single-gallery gallery-grid-item mechanical">
                                <figure class="gallery-img">
                                    <a href="<?= $front_assets; ?>/img/builderon-img29.jpg" data-fancybox="gallery" class="img-box">
                                        <img src="<?= $front_assets; ?>/img/builderon-img29.jpg" alt="">
                                    </a>
                                    <div class="facility-gallery-wrapper">
                                        <div class="facility-content">
                                            <h5 class="facility-title">
                                                <a href="">METAL ENGINEERING</a>
                                            </h5>
                                            <p class="facility-info">
                                                Lorem quam reprehenderit sunt posuere. Voluptatum justo, cillum ac nihil magni ut reprehenderit purus nibh sed, ornare etiam? Vehicula facilisi
                                            </p>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                            <div class="single-gallery gallery-grid-item mechanical">
                                <figure class="gallery-img">
                                    <a href="<?= $front_assets; ?>/img/builderon-img35.jpg" data-fancybox="gallery" class="img-box">
                                        <img src="<?= $front_assets; ?>/img/builderon-img35.jpg" alt="">
                                    </a>
                                    <div class="facility-gallery-wrapper">
                                        <div class="facility-content">
                                            <h5 class="facility-title">
                                                <a href="">HEAVY-DUTY WORK</a>
                                            </h5>
                                            <p class="facility-info">
                                                Lorem quam reprehenderit sunt posuere. Voluptatum justo, cillum ac nihil magni ut reprehenderit purus nibh sed, ornare etiam? Vehicula facilisi
                                            </p>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                            <div class="single-gallery gallery-grid-item consulting">
                                <figure class="gallery-img">
                                    <a href="<?= $front_assets; ?>/img/builderon-img30.jpg" data-fancybox="gallery" class="img-box">
                                        <img src="<?= $front_assets; ?>/img/builderon-img30.jpg" alt="">
                                    </a>
                                    <div class="facility-gallery-wrapper">
                                        <div class="facility-content">
                                            <h5 class="facility-title">
                                                <a href="">BUILDING PROJECT</a>
                                            </h5>
                                            <p class="facility-info">
                                                Lorem quam reprehenderit sunt posuere. Voluptatum justo, cillum ac nihil magni ut reprehenderit purus nibh sed, ornare etiam? Vehicula facilisi
                                            </p>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                            <div class="single-gallery gallery-grid-item consulting">
                                <figure class="gallery-img">
                                    <a href="<?= $front_assets; ?>/img/builderon-img34.jpg" data-fancybox="gallery" class="img-box">
                                        <img src="<?= $front_assets; ?>/img/builderon-img34.jpg" alt="">
                                    </a>
                                    <div class="facility-gallery-wrapper">
                                        <div class="facility-content">
                                            <h5 class="facility-title">
                                                <a href="">PAINTING PROJECT</a>
                                            </h5>
                                            <p class="facility-info">
                                                Lorem quam reprehenderit sunt posuere. Voluptatum justo, cillum ac nihil magni ut reprehenderit purus nibh sed, ornare etiam? Vehicula facilisi
                                            </p>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <!-- home testimonial html section -->
            <!-- <section class="home-testimonial-section">
                <div class="container">
                    <div class="home-testimonial-inner">
                        <div class="row g-0 align-items-md-end">
                            <div class="col-md-6">
                                <div class="home-testimonial-left">
                                    <div class="overlay"></div>
                                    <div class="section-head-white">
                                        <span class="section-title-divider">
                                            TESTIMONIALS
                                        </span>
                                        <h3 class="section-title">
                                            APPRECIATED BY OUR CLIENTS
                                        </h3>
                                    </div>
                                    <div class="testimonial-slider">
                                        <div class="home-testimonial-content">
                                            <figure class="author-img">
                                                <img src="<?= $front_assets; ?>/img/builderon-img36.png" alt="">
                                            </figure>
                                            <div class="testimonila-detail">
                                                <p>
                                                    "Tempora illo placeat do senectus atque? Corporis ratione dolore? Elit quia, expedita? Eget tellus lorem amet ducimus ipsa duis malesuada urna dolorum! Dapibus lacinia bibendum, dictumst! Fuga cillum platea, odit facilisi dictumst!"
                                                </p>
                                                <div class="author-info">
                                                    <h5 class="author-name">Alison White</h5>
                                                    <span class="author-desc">Customer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="home-testimonial-content">
                                            <figure class="author-img">
                                                <img src="<?= $front_assets; ?>/img/builderon-img37.png" alt="">
                                            </figure>
                                            <div class="testimonila-detail">
                                                <p>
                                                    "Tempora illo placeat do senectus atque? Corporis ratione dolore? Elit quia, expedita? Eget tellus lorem amet ducimus ipsa duis malesuada urna dolorum! Dapibus lacinia bibendum, dictumst! Fuga cillum platea, odit facilisi dictumst!"
                                                </p>
                                                <div class="author-info">
                                                    <h5 class="author-name">Author Smith</h5>
                                                    <span class="author-desc">Customer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="home-testimonial-content">
                                            <figure class="author-img">
                                                <img src="<?= $front_assets; ?>/img/builderon-img38.png" alt="">
                                            </figure>
                                            <div class="testimonila-detail">
                                                <p>
                                                    "Tempora illo placeat do senectus atque? Corporis ratione dolore? Elit quia, expedita? Eget tellus lorem amet ducimus ipsa duis malesuada urna dolorum! Dapibus lacinia bibendum, dictumst! Fuga cillum platea, odit facilisi dictumst!"
                                                </p>
                                                <div class="author-info">
                                                    <h5 class="author-name">Sammy james</h5>
                                                    <span class="author-desc">Customer</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="home-testimonial-right">
                                    <figure class="home-testimonial-img">
                                        <img src="<?= $front_assets; ?>/img/builderon-img039.jpg" alt="">
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <!-- home progress html section -->
            <div class="home-progress-section">
                <div class="wave-pattern-bottom"></div>
                <div class="overlay"></div>
                <div class="container">
                    <div class="counter-up-inner">
                        <div class="counter-item-wrap row">
                            <div class="col-lg-3 col-sm-6">
                                <div class=" counter-item">
                                    <div class="count-img">
                                        <i aria-hidden="true" class="fas fa-users"></i>
                                    </div>
                                    <div class="counter-no">
                                        <span class="counter">15,000</span>+
                                    </div>
                                    <div class="Completed">
                                        Happy Customers
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class=" counter-item">
                                    <div class="count-img">
                                        <i aria-hidden="true" class="fas fa-project-diagram"></i>
                                    </div>
                                    <div class="counter-no">
                                        <span class="counter">2,800</span>+
                                    </div>
                                    <div class="Completed">
                                        Projects Done
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class=" counter-item">
                                    <div class="count-img">
                                        <i aria-hidden="true" class="fas fa-users-cog"></i>
                                    </div>
                                    <div class="counter-no">
                                        <span class="counter">750</span>+
                                    </div>
                                    <div class="Completed">
                                        Qualified Employees
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class=" counter-item">
                                    <div class="count-img">
                                        <i aria-hidden="true" class="fas fa-network-wired"></i>
                                    </div>
                                    <div class="counter-no">
                                        <span class="counter">88</span>+
                                    </div>
                                    <span class="Completed">
                                        Office Branches
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- home blog html section -->
            <!-- <section class="home-blog-section">
                <div class="pattern-overlay"></div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-9">
                            <div class="section-head">
                                <span class="section-title-divider">
                                    LATEST BLOG
                                </span>
                                <h3 class="section-title">
                                    LEARN MORE FROM OUR BLOG
                                </h3>
                                <p class="section-paragraph">
                                    Magna voluptatum dolorem! Dolores! Sociosqu commodo nobis imperdiet lacinia? Magni! Felis, elementum nobis imperdiet lacinia nobis imperdiet lacinia.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="home-blog-btn">
                                <a href="" class="button-primary"> view all blog</a>
                            </div>
                        </div>
                    </div>
                    <div class="inner-blog-wrapper">
                        <article class="post">
                            <figure class="feature-image">
                                <img src="<?= $front_assets; ?>/img/builderon-img074.jpg" alt="">
                            </figure>
                            <div class="entry-content">
                                <h5>
                                    <a href="">CONSTRUCTION IS HARD WORKING PROJECT</a>
                                </h5>
                                <p class="blog-info">
                                    Praesent, congue cubilia id rem a. Justo scelerisque beatae cupiditate autem do, porro? Porro corrupti,
                                </p>
                                <span class="blog-link">
                                    <a href="">READ MORE</a>
                                </span>
                            </div>
                        </article>
                        <article class="post">
                            <figure class="feature-image">
                                <img src="<?= $front_assets; ?>/img/builderon-img073.jpg" alt="">
                            </figure>
                            <div class="entry-content">
                                <h5>
                                    <a href="">BUILDING THE CONSTRUCTION PROJECT</a>
                                </h5>
                                <p class="blog-info">
                                    Praesent, congue cubilia id rem a. Justo scelerisque beatae cupiditate autem do, porro? Porro corrupti,
                                </p>
                                <span class="blog-link">
                                    <a href="single-blog.html">READ MORE</a>
                                </span>
                            </div>
                        </article>
                        <article class="post">
                            <figure class="feature-image">
                                <img src="<?= $front_assets; ?>/img/builderon-img075.jpg" alt="">
                            </figure>
                            <div class="entry-content">
                                <h5>
                                    <a href="">DISCUSSING PROJECT WITH TEAMMATES</a>
                                </h5>
                                <p class="blog-info">
                                    Praesent, congue cubilia id rem a. Justo scelerisque beatae cupiditate autem do, porro? Porro corrupti,
                                </p>
                                <span class="blog-link">
                                    <a href="">READ MORE</a>
                                </span>
                            </div>
                        </article>
                    </div>
                </div>
            </section> -->
            <!-- home contact html section -->
            <div class="home-contact-img-section">
                <div class="overlay"></div>
                <div class="wave-pattern-top"></div>
            </div>
            <section class="home-contact-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="home-contact-inner">
                                <div class="home-contact-inner-box">
                                    <figure class="home-contact-img">
                                    </figure>
                                    <div class="home-contact-info-title">
                                        <h5>WE ARE SERVICING IN MORE THAN 100 COUNTRIES</h5>
                                    </div>
                                </div>
                                <div id="accordion-tab-one" class="accordion-content" role="tablist">
                                    <div id="accordion-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="accordion-A">
                                        <div class="card-header" role="tab" id="qus-A">
                                            <h6 class="mb-0">
                                                <a data-bs-toggle="collapse" href="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                                    HOW WE BECAME BEST AMONG OTHERS?
                                                </a>
                                            </h6>
                                        </div>
                                        <div id="collapse-one" class="collapse show" data-bs-parent="#accordion-tab-one" role="tabpanel" aria-labelledby="qus-A">
                                            <div class="card-body">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accordion-B" class="card tab-pane" role="tabpanel" aria-labelledby="accordion-B">
                                        <div class="card-header" role="tab" id="qus-B">
                                            <h6 class="mb-0">
                                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-two" aria-expanded="false" aria-controls="collapse-two">
                                                    WHY CHOOSE US FOR YOUR PROJECTS?
                                                </a>
                                            </h6>
                                        </div>
                                        <div id="collapse-two" class="collapse" data-bs-parent="#accordion-tab-one" role="tabpanel" aria-labelledby="qus-B">
                                            <div class="card-body">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accordion-C" class="card tab-pane" role="tabpanel" aria-labelledby="accordion-C">
                                        <div class="card-header" role="tab" id="qus-C">
                                            <h6 class="mb-0">
                                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-three" aria-expanded="true" aria-controls="collapse-three">
                                                    WHAT WE OFFER TO YOU?
                                                </a>
                                            </h6>
                                        </div>
                                        <div id="collapse-three" class="collapse" data-bs-parent="#accordion-tab-one" role="tabpanel" aria-labelledby="qus-C">
                                            <div class="card-body">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accordion-D" class="card tab-pane" role="tabpanel" aria-labelledby="accordion-D">
                                        <div class="card-header" role="tab" id="qus-D">
                                            <h6 class="mb-0">
                                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-four" aria-expanded="true" aria-controls="collapse-four">
                                                    HOW WE PROVIDE SERVICES FOR YOU?
                                                </a>
                                            </h6>
                                        </div>
                                        <div id="collapse-four" class="collapse" data-bs-parent="#accordion-tab-one" role="tabpanel" aria-labelledby="qus-D">
                                            <div class="card-body">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accordion-E" class="card tab-pane" role="tabpanel" aria-labelledby="accordion-E">
                                        <div class="card-header" role="tab" id="qus-E">
                                            <h6 class="mb-0">
                                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-five" aria-expanded="true" aria-controls="collapse-five">
                                                    ARE WE AFFORDABLE TO HIRE?
                                                </a>
                                            </h6>
                                        </div>
                                        <div id="collapse-five" class="collapse" data-bs-parent="#accordion-tab-one" role="tabpanel" aria-labelledby="qus-E">
                                            <div class="card-body">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-form">
                                <h5>CONTACT & HIRE US</h5>
                                <form>
                                    <p>
                                        <input type="text" name="name" placeholder="Your Name*">
                                    </p>
                                    <p>
                                        <input type="email" name="email" placeholder="Your Email*">
                                    </p>
                                    <p>
                                        <input type="number" name="number" placeholder="Mobile Number*">
                                    </p>
                                    <p>
                                        <textarea rows="8" placeholder="Enter your message*"></textarea>
                                    </p>
                                    <input type="submit" name="submit" value="SUBMIT MESSAGE">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>