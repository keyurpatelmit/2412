</main>
        <!-- footer part -->
        <!-- home footer subscribe section -->
     <section class="home-subscribe-section">
            <div class="container">
                <div class="home-inner-subscribe-box">
                    <!-- <div class="overlay"></div>
                    <div class="section-head-white">
                        <h3 class="section-title">
                            SUBSCRIBE NEWSLETTER
                        </h3>
                        <p class="section-paragraph">
                            Lorem ipsum dolor sit amet, cons aring elit sed dllao the eimod tempor inciunt ullaco laboris aliquip alora tempor inciunt temporin.
                        </p>
                    </div>
                    <div class="home-subscribe-form">
                        <form>
                            <div class="top-form">
                                <p>
                                    <input type="text" name="name" placeholder="Your Name*">
                                </p>
                                <p>
                                    <input type="email" name="email" placeholder="Email address*">
                                </p>
                            </div>
                            <input type="submit" name="submit" value="SUBSCRIBE NOW">
                        </form>
                    </div> -->
                </div>
            </div>
        </section> 
        <footer id="colophon" class="site-footer">
            <div class="footer-overlay overlay"></div>
            <div class="top-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <aside class="widget widget_text img-textwidget">
                                <div class="footer-logo">
                                    <a href="<?= base_url('home') ?>"><img src="themes/default/admin/assets/upload/logos/<?= $system_details->sitelogo; ?>" alt="logo"></a>
                                </div>
                                <div class="textwidget widget-text">
                                    Our mission is to empower businesses with  Qulity and Innovative automation solutions that drive efficiency, streamline processes, and fuel growth.
                                </div>
                            </aside>
                            <div class="footer-social-links">
                                <ul>
                                    <li>
                                        <a href="" target="_blank">
                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" target="_blank">
                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" target="_blank">
                                            <i class="fab fa-google"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" target="_blank">
                                            <i class="fab fa-instagram" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" target="_blank">
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <aside class="widget">
                                <h5 class="widget-title">CONTACT INFORMATION</h5>
                                <ul>
                                    <li>
                                        <a href="tel:<?= $system_details->mobile ?>">Phone: +91 <?= $system_details->mobile ?></a>
                                    </li>
                                    <li>
                                        <a href="mailto:<?= $system_details->email ?>" data-cfemail=""><?= $system_details->email ?></span></a>
                                    </li>
                                    <li>
                                        <a href="">Address: <?= $system_details->address ?></a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <aside class="widget">
                                <h5 class="widget-title">USEFUL LINKS</h5>
                                <ul class="widget-underline">
                                    <li>
                                        <a href="<?= base_url('team') ?>">Team </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('services') ?>">Service</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('about') ?>">About us</a>
                                    
                                    </li>
                                    <li>
                                        <a href="<?= base_url('contact') ?>">Contact us</a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <aside class="widget">
                                <h5 class="widget-title">GALLERY</h5>
                                <div class="gallery gallery-colum-3">
                                    <figure class="gallery-item">
                                        <a href=""><img src="<?= $front_assets; ?>certificate/image1.jpeg" alt=""></a>
                                    </figure>
                                    <figure class="gallery-item">
                                        <a href=""><img src="<?= $front_assets; ?>certificate/image2.jpeg" alt=""></a>
                                    </figure>
                                    <figure class="gallery-item">
                                        <a href=""><img src="<?= $front_assets; ?>certificate/image3.jpeg" alt=""></a>
                                    </figure>
                                    <figure class="gallery-item">
                                        <a href=""><img src="<?= $front_assets; ?>certificate/image6.jpeg" alt=""></a>
                                    </figure>
                                    <figure class="gallery-item">
                                        <a href=""><img src="<?= $front_assets; ?>certificate/image8.jpeg" alt=""></a>
                                    </figure>
                                    <figure class="gallery-item">
                                        <a href=""><img src="<?= $front_assets; ?>certificate/image4.jpeg" alt=""></a>
                                    </figure>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="bottom-footer">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-6 col-md-5">
                            <div class="copy-right">Copyright &copy; <?= date('Y') ?>. All rights reserved. 
                                 <a href="http://maahi.it/" target="_blank" rel="noopener noreferrer">Maahi IT</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-7">
                            <div class="legal-list">
                                <ul>
                                    <li> <a href="<?= base_url('privacy_policy') ?>">Privacy Policy</a></li>
                                    <li> <a href="<?= base_url('team_condition') ?>">Terms & Condition</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- back to top -->
        <a id="backTotop" href="" class="to-top-icon">
            <i class="fas fa-chevron-up"></i>
        </a>
        <!-- custom search field html -->
        <div class="header-search-form">
            <div class="container">
                <div class="header-search-container">
                    <form class="search-form" role="search" method="get">
                        <input type="text" name="s" placeholder="Enter your text...">
                    </form>
                    <a href="" class="search-close">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="<?= $front_assets; ?>/vendors/jquery/jquery.js"></script>
    <script src="<?= $front_assets; ?>/vendors/waypoint/jquery.waypoints.min.js"></script>
    <script src="<?= $front_assets; ?>/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= $front_assets; ?>/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= $front_assets; ?>/vendors/progressbar-fill-visible/js/progressBar.min.js"></script>
    <script src="<?= $front_assets; ?>/vendors/countdown-date-loop-counter/loopcounter.js"></script>
    <script src="<?= $front_assets; ?>/vendors/counterup/jquery.counterup.js"></script>
    <script src="<?= $front_assets; ?>/vendors/modal-video/jquery-modal-video.min.js"></script>
    <script src="<?= $front_assets; ?>/vendors/masonry/masonry.pkgd.min.js"></script>
    <script src="<?= $front_assets; ?>/vendors/isotope/isotope.pkgd.min.js"></script>
    <script src="<?= $front_assets; ?>/vendors/fancybox/dist/jquery.fancybox.min.js"></script>
    <script src="<?= $front_assets; ?>/vendors/slick/slick.min.js"></script>
    <script src="<?= $front_assets; ?>/vendors/slick-nav/jquery.slicknav.js"></script>
    <script src="<?= $front_assets; ?>/js/custom.js"></script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'8e3615f03a96f3a5',t:'MTczMTc0NTQ3Ny4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='<?= $front_assets; ?>/js/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>