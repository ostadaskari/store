@extends('front.layouts.app')

@section('style')

    <style>
        /* =========================================================
           ABOUT PAGE
           ========================================================= */

        .about-page {
            --about-primary: #ffb301;
            --about-primary-dark: #d99300;
            --about-dark: #101828;
            --about-text: #475467;
            --about-muted: #667085;
            --about-light: #f8fafc;
            --about-border: #eaecf0;
            direction: rtl;
        }

        .about-page *,
        .about-page *::before,
        .about-page *::after {
            box-sizing: border-box;
        }

        /* ---------------------------------------------------------
           Breadcrumb
           --------------------------------------------------------- */

        .about-breadcrumb-wrapper {
            padding-top: 115px;
            margin-bottom: 25px;
        }

        .about-breadcrumb {
            background: #fff;
            border: 1px solid var(--about-border);
            border-radius: 14px;
            padding: 12px 18px;
            display: inline-flex;
            margin: 0;
            box-shadow: 0 5px 20px rgba(16, 24, 40, 0.04);
        }

        .about-breadcrumb a {
            color: var(--about-muted);
            text-decoration: none;
            transition: .2s ease;
        }

        .about-breadcrumb a:hover {
            color: var(--about-primary-dark);
        }

        .about-breadcrumb .active {
            color: var(--about-dark);
            font-weight: 600;
        }

        /* ---------------------------------------------------------
           Hero
           --------------------------------------------------------- */

        .about-hero {
            position: relative;
            min-height: 520px;
            border-radius: 30px;
            overflow: hidden;
            margin-bottom: 80px;

            background:
                radial-gradient(
                    circle at 80% 25%,
                    rgba(255, 179, 1, .20),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 15% 80%,
                    rgba(255, 255, 255, .08),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #101828 0%,
                    #182230 50%,
                    #0b111b 100%
                );

            box-shadow:
                0 25px 70px rgba(16, 24, 40, .18);
        }

        .about-hero::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 50%;
            left: -170px;
            bottom: -250px;
        }

        .about-hero::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border: 1px solid rgba(255,179,1,.18);
            border-radius: 50%;
            right: -120px;
            top: -130px;
        }

        .about-hero-content {
            position: relative;
            z-index: 2;
            min-height: 520px;
            display: flex;
            align-items: center;
            padding: 70px;
        }

        .about-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--about-primary);
            background: rgba(255,179,1,.10);
            border: 1px solid rgba(255,179,1,.25);
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 22px;
        }

        .about-hero-badge span {
            width: 7px;
            height: 7px;
            background: var(--about-primary);
            border-radius: 50%;
            box-shadow: 0 0 12px rgba(255,179,1,.8);
        }

        .about-hero h1 {
            color: #fff;
            font-size: clamp(38px, 5vw, 68px);
            line-height: 1.25;
            font-weight: 800;
            margin: 0 0 22px;
            letter-spacing: -1.5px;
        }

        .about-hero h1 strong {
            color: var(--about-primary);
        }

        .about-hero-description {
            color: #d0d5dd;
            max-width: 650px;
            font-size: 18px;
            line-height: 2;
            margin-bottom: 30px;
        }

        .about-hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .about-btn-primary {
            background: var(--about-primary);
            color: #111;
            border: none;
            border-radius: 12px;
            padding: 13px 25px;
            font-weight: 700;
            text-decoration: none;
            transition: .25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .about-btn-primary:hover {
            background: #ffc43d;
            color: #111;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255,179,1,.25);
        }

        .about-btn-outline {
            color: #fff;
            border: 1px solid rgba(255,255,255,.22);
            background: rgba(255,255,255,.05);
            border-radius: 12px;
            padding: 13px 25px;
            font-weight: 600;
            text-decoration: none;
            transition: .25s ease;
        }

        .about-btn-outline:hover {
            color: #fff;
            background: rgba(255,255,255,.1);
        }

        /* Decorative circuit */

        .about-hero-visual {
            position: absolute;
            left: 7%;
            top: 50%;
            transform: translateY(-50%);
            width: 330px;
            height: 330px;
            border-radius: 50%;
            border: 1px solid rgba(255,179,1,.25);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .about-hero-visual::before {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            border-radius: 50%;
            border: 1px dashed rgba(255,255,255,.18);
        }

        .about-hero-visual::after {
            content: "";
            position: absolute;
            width: 110px;
            height: 110px;
            border-radius: 24px;
            background: rgba(255,179,1,.12);
            border: 1px solid rgba(255,179,1,.4);
            transform: rotate(45deg);
        }

        .about-hero-icon {
            position: relative;
            z-index: 2;
            width: 75px;
            height: 75px;
            border-radius: 22px;
            background: var(--about-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #111;
            font-size: 30px;
            box-shadow: 0 15px 45px rgba(255,179,1,.25);
        }

        /* ---------------------------------------------------------
           Stats
           --------------------------------------------------------- */

        .about-stats {
            margin-top: -35px;
            position: relative;
            z-index: 5;
            margin-bottom: 90px;
        }

        .about-stat-card {
            background: #fff;
            border: 1px solid var(--about-border);
            border-radius: 20px;
            padding: 28px 20px;
            text-align: center;
            height: 100%;
            box-shadow: 0 12px 35px rgba(16,24,40,.07);
            transition: .25s ease;
        }

        .about-stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 45px rgba(16,24,40,.11);
        }

        .about-stat-number {
            font-size: 34px;
            font-weight: 800;
            color: var(--about-dark);
            margin-bottom: 5px;
        }

        .about-stat-number span {
            color: var(--about-primary);
        }

        .about-stat-title {
            color: var(--about-muted);
            font-size: 14px;
        }

        /* ---------------------------------------------------------
           Section heading
           --------------------------------------------------------- */

        .about-section {
            margin-bottom: 100px;
        }

        .about-section-heading {
            margin-bottom: 45px;
        }

        .about-section-label {
            color: var(--about-primary-dark);
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 10px;
            display: block;
        }

        .about-section-heading h2 {
            color: var(--about-dark);
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 800;
            margin-bottom: 15px;
        }

        .about-section-heading p {
            color: var(--about-muted);
            max-width: 700px;
            line-height: 2;
            margin: 0;
        }

        /* ---------------------------------------------------------
           Story
           --------------------------------------------------------- */

        .about-story-card {
            background: #fff;
            border: 1px solid var(--about-border);
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(16,24,40,.06);
        }

        .about-story-accent {
            min-height: 100%;
            background:
                radial-gradient(
                    circle at 20% 20%,
                    rgba(255,179,1,.25),
                    transparent 35%
                ),
                linear-gradient(145deg, #111827, #1d2939);
            padding: 45px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .about-story-year {
            font-size: 72px;
            font-weight: 900;
            line-height: 1;
            color: var(--about-primary);
            margin-bottom: 15px;
        }

        .about-story-accent h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .about-story-accent p {
            color: #d0d5dd;
            line-height: 2;
            margin: 0;
        }

        .about-story-content {
            padding: 45px;
        }

        .about-story-content h3 {
            color: var(--about-dark);
            font-size: 25px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .about-story-content p {
            color: var(--about-text);
            line-height: 2.2;
            margin: 0;
        }

        /* ---------------------------------------------------------
           Mission cards
           --------------------------------------------------------- */

        .about-values {
            background: var(--about-light);
            border-radius: 30px;
            padding: 70px 35px;
            margin-bottom: 100px;
        }

        .about-value-card {
            background: #fff;
            border: 1px solid var(--about-border);
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            transition: .25s ease;
        }

        .about-value-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(16,24,40,.08);
        }

        .about-value-icon {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            background: rgba(255,179,1,.13);
            color: var(--about-primary-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .about-value-card h3 {
            font-size: 19px;
            font-weight: 800;
            color: var(--about-dark);
            margin-bottom: 12px;
        }

        .about-value-card p {
            color: var(--about-muted);
            line-height: 2;
            margin: 0;
            font-size: 14px;
        }

        /* ---------------------------------------------------------
           Timeline
           --------------------------------------------------------- */

        .about-timeline {
            position: relative;
            padding: 15px 0;
        }

        .about-timeline::before {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            right: 50%;
            width: 2px;
            background: linear-gradient(
                to bottom,
                transparent,
                #e4e7ec 8%,
                #e4e7ec 92%,
                transparent
            );
            transform: translateX(50%);
        }

        .about-timeline-item {
            position: relative;
            width: 50%;
            padding: 15px 45px;
            margin-bottom: 35px;
        }

        .about-timeline-item:nth-child(odd) {
            margin-left: 50%;
        }

        .about-timeline-item:nth-child(even) {
            margin-right: 50%;
        }

        .about-timeline-dot {
            position: absolute;
            top: 40px;
            width: 17px;
            height: 17px;
            border-radius: 50%;
            background: var(--about-primary);
            border: 4px solid #fff;
            box-shadow:
                0 0 0 3px rgba(255,179,1,.25),
                0 5px 15px rgba(255,179,1,.25);
            z-index: 3;
        }

        .about-timeline-item:nth-child(odd) .about-timeline-dot {
            right: -9px;
        }

        .about-timeline-item:nth-child(even) .about-timeline-dot {
            left: -9px;
        }

        .about-timeline-card {
            background: #fff;
            border: 1px solid var(--about-border);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(16,24,40,.05);
            transition: .25s ease;
        }

        .about-timeline-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px rgba(16,24,40,.09);
        }

        .about-timeline-year {
            display: inline-block;
            background: rgba(255,179,1,.12);
            color: var(--about-primary-dark);
            border-radius: 50px;
            padding: 6px 13px;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .about-timeline-card h3 {
            color: var(--about-dark);
            font-size: 19px;
            line-height: 1.7;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .about-timeline-card p {
            color: var(--about-muted);
            line-height: 2;
            margin: 0;
            font-size: 14px;
        }

        /* ---------------------------------------------------------
           Products / capabilities
           --------------------------------------------------------- */

        .about-products-box {
            background: #101828;
            border-radius: 30px;
            padding: 55px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .about-products-box::after {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            border: 1px solid rgba(255,179,1,.18);
            left: -150px;
            bottom: -180px;
        }

        .about-products-box h2 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .about-products-box > p {
            color: #d0d5dd;
            line-height: 2;
            max-width: 700px;
            position: relative;
            z-index: 2;
        }

        .about-product-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 25px;
            position: relative;
            z-index: 2;
        }

        .about-product-tag {
            padding: 9px 15px;
            border: 1px solid rgba(255,255,255,.12);
            background: rgba(255,255,255,.05);
            border-radius: 50px;
            color: #eaecf0;
            font-size: 13px;
        }

        /* ---------------------------------------------------------
           Final CTA
           --------------------------------------------------------- */

        .about-final-cta {
            text-align: center;
            padding: 90px 25px;
        }

        .about-final-cta h2 {
            color: var(--about-dark);
            font-size: clamp(30px, 4vw, 44px);
            font-weight: 800;
            margin-bottom: 15px;
        }

        .about-final-cta p {
            color: var(--about-muted);
            max-width: 650px;
            margin: 0 auto 25px;
            line-height: 2;
        }

        /* ---------------------------------------------------------
           Responsive
           --------------------------------------------------------- */

        @media (max-width: 991px) {

            .about-hero {
                min-height: 480px;
            }

            .about-hero-content {
                min-height: 480px;
                padding: 45px;
            }

            .about-hero-visual {
                opacity: .18;
                left: 0;
            }

            .about-timeline::before {
                right: 20px;
                transform: none;
            }

            .about-timeline-item,
            .about-timeline-item:nth-child(odd),
            .about-timeline-item:nth-child(even) {
                width: 100%;
                margin-right: 0;
                margin-left: 0;
                padding-right: 60px;
                padding-left: 0;
            }

            .about-timeline-item:nth-child(odd) .about-timeline-dot,
            .about-timeline-item:nth-child(even) .about-timeline-dot {
                right: 12px;
                left: auto;
            }

            .about-timeline-card {
                text-align: right;
            }
        }

        @media (max-width: 767px) {

            .about-breadcrumb-wrapper {
                padding-top: 95px;
            }

            .about-hero {
                border-radius: 20px;
                margin-bottom: 65px;
            }

            .about-hero-content {
                padding: 35px 25px;
            }

            .about-hero h1 {
                font-size: 38px;
            }

            .about-hero-description {
                font-size: 15px;
            }

            .about-hero-visual {
                display: none;
            }

            .about-stats {
                margin-top: -25px;
                margin-bottom: 65px;
            }

            .about-stat-card {
                margin-bottom: 12px;
            }

            .about-section,
            .about-values {
                margin-bottom: 65px;
            }

            .about-story-accent,
            .about-story-content {
                padding: 30px 25px;
            }

            .about-story-year {
                font-size: 55px;
            }

            .about-values {
                padding: 45px 20px;
            }

            .about-products-box {
                padding: 40px 25px;
                border-radius: 22px;
            }

            .about-products-box h2 {
                font-size: 27px;
            }

            .about-final-cta {
                padding: 65px 20px;
            }
        }
    </style>

@endsection


@section('content')

    <div class="about-page">

        {{-- =====================================================
             Breadcrumb
        ====================================================== --}}
        <div class="container about-breadcrumb-wrapper">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb about-breadcrumb">

                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">
                            خانه
                        </a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">
                        درباره ما
                    </li>

                </ol>

            </nav>

        </div>


        {{-- =====================================================
             HERO
        ====================================================== --}}
        <div class="container">

            <section class="about-hero">

                <div class="about-hero-content">

                    <div>

                        <div class="about-hero-badge">
                            <span></span>
                            شیرازچیپ؛ مهندسی برای آینده صنعت
                        </div>

                        <h1>
                            نوآوری،
                            <strong>مهندسی</strong>
                            و اتوماسیون صنعتی
                        </h1>

                        <p class="about-hero-description">
                            شیرازچیپ فعالیت خود را با هدف ارائه خدمات الکترونیک
                            و اتوماسیون صنعتی آغاز کرد و با توسعه دانش فنی،
                            طراحی و تولید تجهیزات صنعتی، مسیر خود را ادامه داده است.
                        </p>

                        <div class="about-hero-actions">

                            <a href="{{ url('/products') }}" class="about-btn-primary">
                                مشاهده محصولات
                                <span>←</span>
                            </a>

                            <a href="#our-story" class="about-btn-outline">
                                داستان شیرازچیپ
                            </a>

                        </div>

                    </div>

                </div>


                <div class="about-hero-visual">

                    <div class="about-hero-icon">
                        ⚙
                    </div>

                </div>

            </section>

        </div>


        {{-- =====================================================
             STATS
        ====================================================== --}}
        <div class="container about-stats">

            <div class="row g-3">

                <div class="col-6 col-lg-3">
                    <div class="about-stat-card">

                        <div class="about-stat-number">
                            ۱۳۹۰<span>+</span>
                        </div>

                        <div class="about-stat-title">
                            آغاز مسیر فعالیت
                        </div>

                    </div>
                </div>


                <div class="col-6 col-lg-3">
                    <div class="about-stat-card">

                        <div class="about-stat-number">
                            ۱۳۹۴
                        </div>

                        <div class="about-stat-title">
                            تولید اولین محصول
                        </div>

                    </div>
                </div>


                <div class="col-6 col-lg-3">
                    <div class="about-stat-card">

                        <div class="about-stat-number">
                            ۱۴۰۳
                        </div>

                        <div class="about-stat-title">
                            توسعه محصولات دما و آنالوگ
                        </div>

                    </div>
                </div>


                <div class="col-6 col-lg-3">
                    <div class="about-stat-card">

                        <div class="about-stat-number">
                            ۱۰<span>+</span>
                        </div>

                        <div class="about-stat-title">
                            سال تجربه و توسعه
                        </div>

                    </div>
                </div>

            </div>

        </div>


        {{-- =====================================================
             STORY
        ====================================================== --}}
        <section id="our-story" class="container about-section">

            <div class="about-section-heading">

            <span class="about-section-label">
                داستان ما
            </span>

                <h2>
                    داستان شروع شیرازچیپ
                </h2>

                <p>
                    مسیری از خدمات مهندسی و اتوماسیون صنعتی
                    تا طراحی و تولید تجهیزات تخصصی
                </p>

            </div>


            <div class="about-story-card">

                <div class="row g-0">

                    <div class="col-lg-4">

                        <div class="about-story-accent">

                            <div class="about-story-year">
                                ۱۳۹۲
                            </div>

                            <h3>
                                شروع جدی فعالیت
                            </h3>

                            <p>
                                فعالیت جدی شیرازچیپ در زمینه تولید تجهیزات
                                اتوماسیون صنعتی و ترانسمیترهای الکترونیکی.
                            </p>

                        </div>

                    </div>


                    <div class="col-lg-8">

                        <div class="about-story-content">

                            <h3>
                                از ایده تا تولید
                            </h3>

                            <p>
                                شرکت شیرازچیپ فعالیت خود را به صورت جدی از سال
                                1392 در زمینه تولید تجهیزات اتوماسیون صنعتی و
                                ترانسمیترهای الکترونیکی آغاز نمود و هم اکنون از
                                تولیدکنندگان قابل اعتماد تجهیزات اتوماسیون صنعتی
                                در ایران می‌باشد.

                                <br><br>

                                شیرازچیپ طیف گسترده‌ای از محصولات اتوماسیون صنعتی
                                شامل ترانسمیترهای وزن، نمایشگرهای وزن، ماژول‌های
                                ورودی و خروجی دیجیتال و آنالوگ، ایزولاتورهای
                                سیگنال، مبدل‌ها و موارد دیگر را تولید و به بازار
                                عرضه می‌کند.

                                <br><br>

                                محصولات این شرکت توسط مهندسان خبره کشور در
                                کاربردهای مختلف صنعتی آزموده و مورد تایید
                                قرار گرفته‌ است.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             MISSION / VISION
        ====================================================== --}}
        <section class="container">

            <div class="about-values">

                <div class="about-section-heading text-center">

                <span class="about-section-label">
                    چشم‌انداز و ماموریت
                </span>

                    <h2>
                        آینده‌ای که برای آن مهندسی می‌کنیم
                    </h2>

                    <p class="mx-auto">
                        هدف شیرازچیپ توسعه محصولات با کیفیت، قیمت رقابتی
                        و ارائه ارزش جدید در حوزه اتوماسیون صنعتی است.
                    </p>

                </div>


                <div class="row g-4">

                    <div class="col-md-4">

                        <div class="about-value-card">

                            <div class="about-value-icon">
                                ◈
                            </div>

                            <h3>
                                توسعه بازار
                            </h3>

                            <p>
                                چشم‌انداز شیرازچیپ به دست آوردن سهم حداکثری
                                از بازار ایران و عرضه محصولات به سایر کشورهای
                                همسایه و جهان است.
                            </p>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="about-value-card">

                            <div class="about-value-icon">
                                ✓
                            </div>

                            <h3>
                                کیفیت و رضایت مشتری
                            </h3>

                            <p>
                                ارائه محصولاتی با کیفیت در سطح محصولات صاحب‌نام
                                و معتبر جهانی، همراه با قیمت رقابتی و تمرکز
                                بر رضایتمندی مشتریان.
                            </p>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="about-value-card">

                            <div class="about-value-icon">
                                ✦
                            </div>

                            <h3>
                                ارزش‌آفرینی
                            </h3>

                            <p>
                                ادامه ارائه محصولات و خدمات اتوماسیون با کیفیت
                                بالا و تلاش برای غنی‌سازی کیفیت زندگی انسان‌ها
                                با ارائه ارزش‌های جدید.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             INDUSTRIES / PRODUCTS
        ====================================================== --}}
        <section class="container about-section">

            <div class="about-products-box">

                <h2>
                    راهکارهایی برای صنایع مختلف
                </h2>

                <p>
                    افتخار شیرازچیپ فروش محصولات به شرکت‌های مختلف صنعتی
                    در زمینه‌های ماشین‌آلات بسته‌بندی، دستگاه‌های اندازه‌گیری
                    و آزمایشگاهی، کارخانجات تولید سیمان و بتن، آرد و مواد غذایی
                    و طیف وسیعی از صنایع دیگر است.
                </p>


                <div class="about-product-tags">

                <span class="about-product-tag">
                    ترانسمیتر وزن
                </span>

                    <span class="about-product-tag">
                    نمایشگر وزن
                </span>

                    <span class="about-product-tag">
                    ماژول ورودی و خروجی
                </span>

                    <span class="about-product-tag">
                    ایزولاتور سیگنال
                </span>

                    <span class="about-product-tag">
                    مبدل‌ها
                </span>

                    <span class="about-product-tag">
                    ترانسمیتر جریان
                </span>

                    <span class="about-product-tag">
                    ترانسمیتر دما
                </span>

                    <span class="about-product-tag">
                    محصولات آنالوگ
                </span>

                </div>

            </div>

        </section>


        {{-- =====================================================
             TIMELINE
        ====================================================== --}}
        <section class="container about-section">

            <div class="about-section-heading text-center">

            <span class="about-section-label">
                مسیر رشد
            </span>

                <h2>
                    سال‌ها تجربه، توسعه و نوآوری
                </h2>

                <p class="mx-auto">
                    نگاهی به مهم‌ترین مراحل شکل‌گیری و توسعه شیرازچیپ
                </p>

            </div>


            <div class="about-timeline">


                {{-- 1 --}}
                <div class="about-timeline-item">

                    <span class="about-timeline-dot"></span>

                    <div class="about-timeline-card">

                    <span class="about-timeline-year">
                        ۱۳۹۰ تا ۱۳۹۵
                    </span>

                        <h3>
                            ایده اولیه شیرازچیپ
                        </h3>

                        <p>
                            فعالیت گروه مهندسی کهربا (شیرازچیپ) در ابتدا با هدف
                            ارائه خدمات الکترونیک و اتوماسیون صنعتی آغاز شد.
                            انجام انواع پروژه‌های اتوماسیون صنعتی در حوزه‌های
                            مختلف و پروژه‌های برون‌سپاری شده الکترونیک از جمله
                            تجارب آن سال‌ها می‌باشد.
                        </p>

                    </div>

                </div>


                {{-- 2 --}}
                <div class="about-timeline-item">

                    <span class="about-timeline-dot"></span>

                    <div class="about-timeline-card">

                    <span class="about-timeline-year">
                        ۱۳۹۴
                    </span>

                        <h3>
                            تولید اولین محصول
                        </h3>

                        <p>
                            از ابتدای سال 1394 با توجه به تخصص و سابقه گروه
                            و نیازسنجی بازار، تحقیق و طراحی برای تولید محصولات
                            اتوماسیون صنعتی شروع شد. پس از چندین ماه تلاش،
                            اولین محصول با عنوان ترانسمیتر وزن تک کانال
                            PM-LT01 تکمیل و آماده ارائه شد.
                        </p>

                    </div>

                </div>


                {{-- 3 --}}
                <div class="about-timeline-item">

                    <span class="about-timeline-dot"></span>

                    <div class="about-timeline-card">

                    <span class="about-timeline-year">
                        ۱۳۹۴ تا ۱۳۹۵
                    </span>

                        <h3>
                            تکمیل محصولات حوزه توزین
                        </h3>

                        <p>
                            پس از جلب رضایت مشتریان و اطمینان از پایداری
                            PM-LT01، ترانسمیترهای PM-LT01A و PM-LT02
                            و PM-LT02A به سبد محصولات شیرازچیپ اضافه شد.
                        </p>

                    </div>

                </div>


                {{-- 4 --}}
                <div class="about-timeline-item">

                    <span class="about-timeline-dot"></span>

                    <div class="about-timeline-card">

                    <span class="about-timeline-year">
                        ۱۳۹۵
                    </span>

                        <h3>
                            بروزرسانی، تولید و موفقیت
                        </h3>

                        <p>
                            بازنگری و بروزرسانی طراحی محصولات جهت افزایش کیفیت
                            و کاربری بهتر که منجر به تولید ترانسمیترهای
                            PM-LT11T، PM-LT11A، PM-LT12 و ... شد.
                            طراحی و تولید مبدل آنالوگ PM-AT13 و نمایشگر وزن
                            PM-LD01 نیز از دستاوردهای این دوره بود.

                            <br><br>

                            تایید دانش‌بنیان بودن محصولات شرکت شیرازچیپ
                            از سوی کارگروه تشخیص و ارزیابی شرکت‌ها و مؤسسات
                            دانش‌بنیان نیز دستاورد مهمی برای شرکت در این سال بود.
                        </p>

                    </div>

                </div>


                {{-- 5 --}}
                <div class="about-timeline-item">

                    <span class="about-timeline-dot"></span>

                    <div class="about-timeline-card">

                    <span class="about-timeline-year">
                        ۱۳۹۶ تا ۱۴۰۲
                    </span>

                        <h3>
                            حضور در جمع بزرگان صنعت ایران
                        </h3>

                        <p>
                            اولین حضور شرکت در هجدهمین نمایشگاه بین‌المللی
                            صنعت تهران در این سال رقم خورد که باعث معرفی رسمی
                            شیرازچیپ به عنوان یک تولیدکننده خوش‌آتیه تجهیزات
                            اتوماسیون صنعتی شد.

                            <br><br>

                            ارتباط مستقیم با فعالین این حوزه و آشنایی هرچه بیشتر
                            متخصصین با محصولات شرکت از دستاوردهای این نمایشگاه بود.
                        </p>

                    </div>

                </div>


                {{-- 6 --}}
                <div class="about-timeline-item">

                    <span class="about-timeline-dot"></span>

                    <div class="about-timeline-card">

                    <span class="about-timeline-year">
                        ۱۳۹۶ تا ۱۴۰۲
                    </span>

                        <h3>
                            افزایش سبد محصولات
                        </h3>

                        <p>
                            شرکت در نمایشگاه تهران به مدت 4 سال متوالی،
                            ارائه محصول جدید کنترلر و نمایشگر وزن PM-WI01
                            و اضافه شدن سه نمایشگر ثانویه به سبد محصولات
                            شیرازچیپ.
                        </p>

                    </div>

                </div>


                {{-- 7 --}}
                <div class="about-timeline-item">

                    <span class="about-timeline-dot"></span>

                    <div class="about-timeline-card">

                    <span class="about-timeline-year">
                        ۱۳۹۶ تا ۱۴۰۲
                    </span>

                        <h3>
                            گسترش بخش فنی و پشتیبانی
                        </h3>

                        <p>
                            خرید دستگاه مونتاژ پیشرفته موجب افزایش سرعت و دقت
                            بخش فنی در مونتاژ محصولات شد. همچنین حضور دوباره
                            در نمایشگاه تهران و افزودن بخش پشتیبانی فنی باعث
                            رضایت هرچه بیشتر مشتریان شد.
                        </p>

                    </div>

                </div>


                {{-- 8 --}}
                <div class="about-timeline-item">

                    <span class="about-timeline-dot"></span>

                    <div class="about-timeline-card">

                    <span class="about-timeline-year">
                        ۱۳۹۶ تا ۱۴۰۲
                    </span>

                        <h3>
                            توسعه ترانسمیتر جریان و دما
                        </h3>

                        <p>
                            توسعه تنوع محصولات شیرازچیپ و اضافه کردن محصولات
                            PM-SS12، سری AD11ها، سری PM-CT11،
                            PM-CT11A، PM-CTR11 و PM-CTR11A.

                            <br><br>

                            همچنین تولید اولین ترانسمیتر دمای شرکت PM-TT1X
                            و شرکت در دو نمایشگاه اصفهان و تهران.
                        </p>

                    </div>

                </div>


                {{-- 9 --}}
                <div class="about-timeline-item">

                    <span class="about-timeline-dot"></span>

                    <div class="about-timeline-card">

                    <span class="about-timeline-year">
                        ۱۴۰۳
                    </span>

                        <h3>
                            گسترش محصولات دما و ترانسمیترهای آنالوگ
                        </h3>

                        <p>
                            شرکت در نمایشگاه تهران و اصفهان، افزودن سه محصول
                            ترانسمیتر دما PM-TT4K، PM-TT1R و PM-TT4R،
                            افزودن دو ترانسمیتر آنالوگ با خروجی و ورودی آنالوگ
                            PM-AD04 و PM-AD40 و همچنین افزودن ترانسمیتر جریان
                            سه کانال PM-CT13.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             FINAL CTA
        ====================================================== --}}
        <section class="container">

            <div class="about-final-cta">

            <span class="about-section-label">
                شیرازچیپ
            </span>

                <h2>
                    با ما یک قدم جلوتر باشید
                </h2>

                <p>
                    محصولات اتوماسیون صنعتی شیرازچیپ را بررسی کنید
                    و راهکار مناسب برای نیاز صنعتی خود را پیدا کنید.
                </p>

                <a href="{{ url('/products') }}" class="about-btn-primary">
                    مشاهده محصولات
                    <span>←</span>
                </a>

            </div>

        </section>

    </div>

@endsection


@section('script')

@endsection
