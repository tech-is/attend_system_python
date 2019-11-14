<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ANIMARL | 誰でも手軽に業務効率化！</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootstrap 4 landing page template for developers and startups">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link
        href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
        rel='stylesheet' type='text/css'>
    <!-- FontAwesome JS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            }; if (!f._fbq) f._fbq = n;
            n.push = n; n.loaded = !0; n.version = '2.0'; n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t, s)
        }(window,
            document, 'script', '//connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1506230579705064');
        fbq('track', "PageView");</script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1506230579705064&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->
</head>
<body>
    <!-- ******HEADER****** -->
    <header id="header" class="header">
        <div class="container">
            <h1 class="logo">
                <a class="scrollto" href="#hero">
                    <span class="logo-icon-wrapper"><img class="logo-icon" src="assets/images/logo-icon.svg"
                            alt="icon"></span>
                    <span class="text"><span class="highlight">ANI</span>MARL</span></a>
            </h1>
            <!--//logo-->
            <nav class="main-nav navbar-expand-md float-right navbar-inverse" role="navigation">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--//nav-toggle-->
                <div id="navbar-collapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="active nav-link scrollto" href="#about">ANIMARLについて</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scrollto" href="#features">特徴</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scrollto" href="#team">チーム</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scrollto" href="#pricing">料金</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scrollto" href="#contact">お問い合わせ</a>
                        </li>
                    </ul>
                    <!--//nav-->
                </div>
                <!--//navabr-collapse-->
            </nav>
            <!--//main-nav-->
        </div>
        <!--//container-->
    </header>
    <!--//header-->
    <div id="hero" class="hero-section">
        <div id="hero-carousel" class="hero-carousel carousel carousel-fade slide" data-ride="carousel"
            data-interval="10000">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li class="active" data-slide-to="0" data-target="#hero-carousel"></li>
                <li data-slide-to="1" data-target="#hero-carousel"></li>
                <li data-slide-to="2" data-target="#hero-carousel"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="carousel-item item-1 active">
                    <div class="item-content container">
                        <div class="item-content-inner">
                            <h2 class="heading"> <br class="d-none d-md-block">ﾍﾟｯﾄｻﾛﾝ専用CRM</h2>
                            <p class="intro">無料で始めるシンプルな顧客＆ﾍﾟｯﾄ管理</p>
                            <a class="btn btn-primary btn-cta" href="<?php echo base_url()."login";?>" target="_blank">会員登録して始める</a>
                        </div>
                        <!--//item-content-inner-->
                    </div>
                    <!--//item-content-->
                </div>
                <!--//item-->
                    </div>
                </div>

                <!--//item-->
        <!--
                <div class="carousel-item item-3">
                    <div class="item-content container">
                        <div class="item-content-inner">
                            <h2 class="heading">顧客管理<br>営業支援システム</h2>
                            <p class="intro">誰でも手軽に シンプル顧客管理</p>
                            <a class="btn btn-primary btn-cta" href="cl_main/login" target="_blank">会員登録して始める</a>
                        </div>
                    </div>
                </div>
        -->
                <!--//item-->
            </div>
            <!--//carousel-inner-->
        </div>
        <!--//carousel-->
    </div>
    <!--//hero-->
    <div id="about" class="about-section">
        <div class="container text-center">
            <h2 class="section-title">WHY ANIMARL</h2>
            <p class="intro">ANIMARL(アニマール)とは</p>
            <p class="intro_text">膨大な顧客情報、手間がかかり大変な顧客管理も、ANIMARLなら効率よくスマートに行えます。
                <br>誰でも簡単に扱うことを目指し、必要な機能だけを搭載したWebサービスを実現しました。</p>
            <div class="items-wrapper row">
                <div class="item col-md-4 col-12">
                    <div class="item-inner">
                        <div class="figure-holder">
                            <img class="figure-image" src="assets/images/figure-1.png" alt="image">
                        </div>
                        <!--//figure-holder-->
                        <h3 class="item-title">紙管理の終了</h3>
                        <div class="item-desc">
                            全てをデータ化することでサロンワークを高速化します。
                            顧客管理から予約管理などペットサロンにおけるＰＣワークはすべてこれ一本で。
                            
                        </div>
                        <!--//item-desc-->
                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
                <div class="item col-md-4 col-12">
                    <div class="item-inner">
                        <div class="figure-holder">
                            <img class="figure-image" src="assets/images/figure-2.png" alt="image">
                        </div>
                        <!--//figure-holder-->
                        <h3 class="item-title">直観的な操作感</h3>
                        <div class="item-desc">
                            ＰＣに詳しくない方でも直感で分かるようにGmailなどで馴染みのあるユニバーサルデザインを採用しました。機能もシンプルに。
                        </div>
                        <!--//item-desc-->
                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
                <div class="item col-md-4 col-12">
                    <div class="item-inner">
                        <div class="figure-holder">
                            <img class="figure-image" src="assets/images/figure-3.png" alt="image">
                        </div>
                        <!--//figure-holder-->
                        <h3 class="item-title">顧客へのメールマガジン自動送信</h3>
                        <div class="item-desc">
                            自動送信機能を使うと適切なタイミングで顧客にアプローチできるんだ！すごい！ </div>
                        <!--//item-desc-->
                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
            </div>
            <!--//items-wrapper-->
        </div>
        <!--//container-->
    </div>
    <!--//about-section-->
    <div id="features" class="features-section">
        <div class="container text-center">
            <h2 class="section-title">FUNCTION</h2>
            <p class="intro">自身をもって提供する機能一覧</p>
            <div class="tabbed-area row">
                <!-- Nav tabs -->
                <div class="feature-nav nav nav-pill flex-column col-lg-4 col-md-6 col-12 order-0 order-md-1"
                    role="tablist" aria-orientation="vertical">
                    <a class="nav-link active mb-lg-3" href="#feature-1" aria-controls="feature-1" data-toggle="pill"
                        role="tab" aria-selected="true"><i class="fas fa-magic mr-2"></i>顧客管理機能</a>
                    <a class="nav-link mb-lg-3" href="#feature-2" aria-controls="feature-2" data-toggle="pill"
                        role="tab" aria-selected="false"><i class="fas fa-cubes mr-2"></i>ペット管理機能</a>
                    <a class="nav-link mb-lg-3" href="#feature-3" aria-controls="feature-3" data-toggle="pill"
                        role="tab" aria-selected="false"><i class="fas fa-chart-bar mr-2"></i>予約管理機能</a>
                    <a class="nav-link mb-lg-3" href="#feature-4" aria-controls="feature-4" data-toggle="pill"
                        role="tab" aria-selected="false"><i class="fas fa-code mr-2"></i>メルマガ配信管理機能</a>
                    <a class="nav-link mb-lg-3" href="#feature-8" aria-controls="feature-8" data-toggle="pill"
                        role="tab" aria-selected="false"><i class="fas fa-heart mr-2"></i>スタッフ管理</a>
                </div>
                <!-- Tab panes -->
                <div class="feature-content tab-content col-lg-8 col-md-6 col-12 order-1 order-md-0">
                    <div role="tabpanel" class="tab-pane fade show active" id="feature-1">
                        <a href="index.php/cl_main/login" target="_blank"><img class="img-fluid"
                                src="assets/images/feature-1.png" alt="screenshot"></a>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="feature-2">
                        <a href="index.php/cl_main/login" target="_blank"><img class="img-fluid"
                                src="assets/images/feature-2.png" alt="screenshot"></a>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="feature-3">
                        <a href="index.php/cl_main/login" target="_blank"><img class="img-fluid"
                                src="assets/images/feature-3.png" alt="screenshot"></a>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="feature-4">
                        <a href="index.php/cl_main/login" target="_blank"><img class="img-fluid"
                                src="assets/images/feature-4.png" alt="screenshot"></a>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="feature-5">
                        <a href="index.php/cl_main/login" target="_blank"><img class="img-fluid"
                                src="assets/images/feature-5.png" alt="screenshot"></a>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="feature-6">
                        <a href="index.php/cl_main/login" target="_blank"><img class="img-fluid"
                                src="assets/images/feature-6.png" alt="screenshot"></a>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="feature-7">
                        <a href="index.php/cl_main/login" target="_blank"><img class="img-fluid"
                                src="assets/images/feature-7.png" alt="screenshot"></a>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="feature-8">
                        <a href="index.php/cl_main/login" target="_blank"><img class="img-fluid"
                                src="assets/images/feature-8.png" alt="screenshot"></a>
                    </div>
                </div>
                <!--//feature-content-->
            </div>
            <!--//tabbed-area-->
        </div>
        <!--//container-->
    </div>
    <!--//features-->
    <div class="team-section" id="team">
        <div class="container text-center">
            <h2 class="section-title">PROVIDE BY UMWN</h2>
            <div class="story">
                <p>愛媛県で共にプログラマを学習した仲間でチームを結成<br>
            それぞれの技術を活かしAnimarlを開発しました。
        </p>
            </div>
            <div class="members-wrapper row">
                <div class="item col-md-3 col-12">
                    <div class="item-inner">
                        <div class="profile mb-2">
                            <img class="profile-image" src="assets/images/team-1.png" alt="Xiaoying Riley" />
                        </div>
                        <div class="member-content">
                            <h3 class="member-name">森裕信</h3>
                            <div class="member-title">開発・設計</div>
                            <ul class="social list-inline">
                                <li class="list-inline-item">
                                    <a class="facebook" href="https://www.facebook.com/3rdwavethemes/" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="github" href="https://github.com/xriley" target="_blank">
                                        <i class="fab fa-github"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="member-desc">
                                <p>サーバ構築<br>PG設計<br>プログラム開発</p>
                            </div>
                            <!--//member-desc-->
                        </div>
                        <!--//member-content-->
                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
                <div class="item col-md-3 col-12">
                    <div class="item-inner">
                        <div class="profile mb-2">
                            <img class="profile-image" src="assets/images/team-2.png" alt="Tom Najdek" />
                        </div>
                        <div class="member-content">
                            <h3 class="member-name">若林 朋</h3>
                            <div class="member-title">開発・設計</div>
                            <ul class="social list-inline">
                                <li class="list-inline-item">
                                    <a class="twitter" href="http://twitter.com/tnajdek" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item"><a class="github" href="https://github.com/tnajdek" target="_blank"><i class="fab fa-github"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="member-desc">
                                <p>サーバ構築<br>PG設計<br>プログラム開発</p>
                            </div>
                            <!--//member-desc-->
                        </div>
                        <!--//member-content-->
                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
                <div class="item col-md-3 col-12">
                    <div class="item-inner">
                        <div class="profile mb-2">
                            <img class="profile-image" src="assets/images/team-3.png" alt="Xiaoying Riley" />
                        </div>
                        <div class="member-content">
                            <h3 class="member-name">浦川花</h3>
                            <div class="member-title">フロント開発</div>
                            <ul class="social list-inline">
                                <li class="list-inline-item">
                                    <a class="twitter" href="https://twitter.com/3rdwave_themes" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="facebook" href="https://www.facebook.com/3rdwavethemes/" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="member-desc">
                                <p>WEBデザイン・コーディング</p>
                            </div>
                            <!--//member-desc-->
                        </div>
                        <!--//member-content-->
                    </div>
                    <!--//item-inner-->
                </div>
                <div class="item col-md-3 col-12">
                    <div class="item-inner">
                        <div class="profile mb-2">
                            <img class="profile-image" src="assets/images/team-4.png" alt="Xiaoying Riley" />
                        </div>
                        <div class="member-content">
                            <h3 class="member-name">永井祐大郎</h3>
                            <div class="member-title">開発・設計</div>
                            <ul class="social list-inline">
                                <li class="list-inline-item"><a class="twitter"
                                        href="https://twitter.com/3rdwave_themes" target="_blank"><i
                                            class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a class="github" href="https://github.com/xriley"
                                        target="_blank"><i class="fab fa-github"></i></a></li>
                            </ul>
                            <div class="member-desc">
                                <p>サーバ構築<br>PG設計<br>プログラム開発</p>
                            </div>
                            <!--//member-desc-->
                        </div>
                        <!--//member-content-->
                    </div>
                    <!--//item-inner-->
                </div>
            </div>
            <!--//members-wrapper-->
        </div>
    </div>
    <!--//team-section-->

    <div id="pricing" class="pricing-section">
        <div class="container text-center">
            <h2 class="section-title">PRICING</h2>
            <div class="intro">利用料金について</div>
            <div class="pricing-wrapper row">
                <div class="item item-1 col-md-4 col-12">
                    <div class="item-inner">
                        <h3 class="item-heading">フリー<br><span class="item-heading-desc">(CC BY 3.0)</span></h3>
                        <div class="price-figure">
                            <span class="currency">￥</span><span class="number">0</span>
                        </div>
                        <!--//price-figure-->
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2">
                                <i class="fas fa-check"></i> Single installation
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check"></i> Multiple installations
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-times"></i> Use without attribution link
                            </li>
                        </ul>
                        <div class="mb-3"><a href="index.php/cl_main/login" target="_blank">License Details</a></div>
                        <a class="btn btn-cta" href="index.php/cl_main/login">
                            ダウンロード<br>（無料）</a>

                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
                <div class="item item-2 col-md-4 col-12">
                    <div class="item-inner">
                        <h3 class="item-heading">カスタム<br><span class="item-heading-desc">(Commercial
                                License)</span></h3>
                        <div class="price-figure">
                            <span class="currency">￥</span><span class="number">29</span>
                        </div>
                        <!--//price-figure-->
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2"><i class="fas fa-check"></i> Single installation</li>
                            <li class="mb-2"><i class="fas fa-times"></i> Multiple installations</li>
                            <li class="mb-2"><i class="fas fa-check"></i> Use without attribution link</li>
                        </ul>
                        <div class="mb-3"><a href="index.php/cl_main/login" target="_blank">License Details</a></div>
                        <a class="btn btn-cta" href="index.php/cl_main/login">
                            ダウンロード（有料）</a>

                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->

                <div class="item item-3 col-md-4 col-12">
                    <div class="item-inner">
                        <h3 class="item-heading">プレミアム版<br><span class="item-heading-desc">(Commercial
                                License)</span></h3>
                        <div class="price-figure">
                            <span class="currency">￥</span><span class="number">35億</span>
                        </div>
                        <!--//price-figure-->
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2"><i class="fas fa-check"></i> Single installation</li>
                            <li class="mb-2"><i class="fas fa-check"></i> Multiple installations</li>
                            <li class="mb-2"><i class="fas fa-check"></i> Use without attribution link</li>
                        </ul>
                        <div class="mb-3"><a href="index.php/cl_main/login" target="_blank">License Details</a></div>
                        <a class="btn btn-cta" href="index.php/cl_main/login" target="_blank">ダウンロード（有料）</a>

                    </div>
                    <!--//item-inner-->
                </div>
                <!--//item-->
            </div>
            <!--//pricing-wrapper-->

        </div>
        <!--//container-->
    </div>
    <!--//pricing-section-->
    <div id="contact" class="contact-section">
        <div class="container text-center">
            <h2 class="section-title">✉ CONTACT US</h2>
            <div class="contact-content">
                <p>ご利用に関するお問い合わせ</p>
                <p>システムのバグ・機能の拡張・フィードバックなどあらゆる問い合わせに対応させていただきます！<br><br>
                    何かご不明な点等ございましたらこちらからお問い合わせください。
                </p>
            </div>
            <a class="btn btn-cta btn-primary" href="index.php/cl_main/login">
                お問い合わせはこちらから</a>

        </div>
        <!--//container-->
    </div>
    <!--//contact-section-->

    <footer class="footer text-center">
        <div class="container">
            <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can buy the commercial license via our website: themes.3rdwavemedia.com */-->
            <small class="copyright">Designed with <i class="fas fa-heart"></i> by <a
                    href="https://themes.3rdwavemedia.com/" target="_blank">Xiaoying Riley</a> for developers</small>


        </div>
        <!--//container-->
    </footer>

    <!-- Javascript -->
    <script type="text/javascript" src="assets/plugins/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

</body>

</html>