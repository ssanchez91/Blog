<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 02/07/2020
 * Time: 15:45
 */
?>
<div class="content">
    <div class="row">
        <div class="col-lg-2 offset-md-1">
            <div class="team-member">
                <img class="mx-auto rounded-circle" src="./Public/img/profil.png" alt="profil">
                <h4>Steeve SANCHEZ</h4>

                <p class="text-muted">Web Developer</p>
                <a data-container="body" data-toggle="popover" data-placement="bottom" data-content="Go to my GitHub."
                   class="btn btn-dark btn-social mx-2" href="https://github.com/ssanchez91"><i class="fa fa-github"
                                                                                                aria-hidden="true"
                                                                                                focusable="false"
                                                                                                data-prefix="fab"
                                                                                                data-icon="twitter"
                                                                                                role="img"
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                viewBox="0 0 512 512"
                                                                                                data-fa-i2svg="">
                        <path fill="currentColor"
                              d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                    </i><!-- <i class="fab fa-twitter"></i> --></a>
                <a data-container="body" data-toggle="popover" data-placement="bottom"
                   data-content="Go to my BitBucket." class="btn btn-dark btn-social mx-2"
                   href="https://bitbucket.org/iinext/"><i class="fa fa-bitbucket" aria-hidden="true" focusable="false"
                                                           data-prefix="fab" data-icon="facebook-f" role="img"
                                                           xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                                           data-fa-i2svg="">
                        <path fill="currentColor"
                              d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                    </i><!-- <i class="fab fa-facebook-f"></i> --></a>
                <a data-container="body" data-toggle="popover" data-placement="bottom" data-content="Go to my Linkedin."
                   class="btn btn-dark btn-social mx-2" href="https://www.linkedin.com/in/steeve-sanchez-53793a8a"><i
                        class="fa fa-linkedin" aria-hidden="true" focusable="false" data-prefix="fab"
                        data-icon="linkedin-in" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                        data-fa-i2svg="">
                        <path fill="currentColor"
                              d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path>
                    </i><!-- <i class="fab fa-linkedin-in"></i> --></a>
            </div>
        </div>
        <div class="col-md-7 offset-md-1">
            <div class="jumbotron">
                <h1 class="display-4">Hello, world!</h1>

                <p class="lead">Welcome on my Blog, you are at home here !</p>
                <hr class="my-4">
                <p>
                    When we share something, we divide it, when we share knowledge, we multiply it!</p>
                <a class="btn btn-primary btn-lg" href="./Public/cv/CURRICULUM VITAE STEEVE SANCHEZ.pdf"
                   role="button"><i class="fa fa-eye" aria-hidden="true"></i> Consult my curriculum vitae</a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-10 offset-md-1">
            <section class="page-section" id="contact">
                <div class="container">
                    <div class="text-center">
                        <h2 class="section-heading text-uppercase"><i class="fa fa-envelop" aria-hidden="true"></i>
                            Contact Me</h2>
                        <h4 class="section-subheading text-muted">You can use the form below to send me an email.</h4>
                    </div>
                    <form method="post" action="sendEmail" id="contactForm" name="sentMessage">
                        <div class="row align-items-stretch mb-5">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" id="fullname" name="fullname" type="text"
                                           placeholder="Your Firstname and Lastname *" required="required"
                                           data-validation-required-message="Please enter your fullname."/>

                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="contactEmail" name="contactEmail" type="email"
                                           placeholder="Your Email *" required="required"
                                           data-validation-required-message="Please enter your email address."/>

                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-textarea mb-md-0">
                                    <textarea class="form-control" id="message" name="message"
                                              placeholder="Your Message *" required="required"
                                              data-validation-required-message="Please enter a message."></textarea>

                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-center offset-md-3">
                                <div id="success"></div>
                                <button class="btn btn-warning btn-lg text-uppercase" id="sendMessageButton"
                                        type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send your
                                    message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>


