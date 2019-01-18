<footer class="footer">
    <div class="container">
        <div class="footer__content">
            @section ('footer-menu')
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="footer-menu">
                                <h4 class="footer-menu__title">Company</h4>
                                <ul class="footer-menu__list">
                                    <li>
                                        <a href="#">Link 1</a>
                                    </li>
                                    <li>
                                        <a href="#">Link 2</a>
                                    </li>
                                    <li>
                                        <a href="#">Link 3</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="footer-menu">
                                <h4 class="footer-menu__title">About Us</h4>
                                <ul class="footer-menu__list">
                                    <li>
                                        <a href="#">Link 1</a>
                                    </li>
                                    <li>
                                        <a href="#">Link 2</a>
                                    </li>
                                    <li>
                                        <a href="#">Link 3</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="footer-menu">
                                <h4 class="footer-menu__title">Contact</h4>
                                <ul class="footer-menu__list">
                                    <li>
                                        <a href="#">
                                            <i class="far fa-question-circle fa-lg"></i>
                                            F.A.Q.
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="far fa-envelope fa-lg"></i>
                                            Contact us
                                        </a>
                                    </li>
                                </ul>
                                <a class="social-link" href="https://www.facebook.com/" target="_blank">
                                    <i class="fab fa-facebook-f fa-lg"></i>
                                </a>
                                <a class="social-link" href="https://twitter.com/" target="_blank">
                                    <i class="fab fa-twitter fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            @show

            <div class="row additional-links">
                <div class="col-md-8">
                    <ul>
                        <li><a href="#">Terms and conditions</a></li>
                        <li><a href="#">Privacy</a></li>
                    </ul>
                </div>
                <div class="col-md-4 text-md-right">
                    <div class="copyright">
                        © {{ date('Y') }} 
                        <a href="#" target="_blank">
                            {{ config('app.author') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>