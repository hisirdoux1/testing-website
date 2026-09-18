<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="A modern website built using HTML, CSS, and JavaScript."
    >

    <title>Glenn Studio</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h2>Hello, Glenn!</h2>

    <!-- Decorative background lights -->
    <div class="background-light light-one"></div>
    <div class="background-light light-two"></div>


    <!-- NAVIGATION -->

    <header class="site-header" id="siteHeader">

        <nav class="navbar container">

            <a href="#home" class="brand">
                <span class="brand-logo">G</span>

                <span>
                    Glenn<span class="brand-highlight">Studio</span>
                </span>
            </a>


            <button
                class="menu-button"
                id="menuButton"
                aria-label="Open navigation menu"
                aria-expanded="false"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>


            <ul class="nav-links" id="navLinks">

                <li>
                    <a href="#home">Home</a>
                </li>

                <li>
                    <a href="#about">About</a>
                </li>

                <li>
                    <a href="#services">Services</a>
                </li>

                <li>
                    <a href="#projects">Projects</a>
                </li>

<li>
    <a href="#contact">
        Contact
    </a>
</li>

<li>
    <a href="#contact" class="nav-button" title="Login is unavailable in the temporary static preview">
        Contact Me
    </a>
</li>

            </ul>

        </nav>

    </header>


    <main>

        <!-- HOME -->

        <section id="home" class="hero section">

            <div class="container hero-grid">

                <div class="hero-content">

                    <div class="eyebrow">
                        <span class="status-dot"></span>
                        Available for digital projects
                    </div>


                    <h1>
                        Building websites that look
                        <span class="gradient-text">
                            modern and memorable.
                        </span>
                    </h1>


                    <p class="hero-description">
                        I create responsive and user-friendly websites using
                        HTML, CSS, JavaScript, and modern web technologies.
                    </p>


                    <div class="hero-buttons">

                        <a href="#projects" class="button button-primary">
                            View Projects
                            <span>→</span>
                        </a>

                        <a href="#contact" class="button button-secondary">
                            Contact Me
                        </a>

                    </div>


                    <div class="hero-statistics">

                        <div class="statistic">
                            <strong>100%</strong>
                            <span>Responsive</span>
                        </div>

                        <div class="statistic">
                            <strong>Clean</strong>
                            <span>Modern Code</span>
                        </div>

                        <div class="statistic">
                            <strong>Fast</strong>
                            <span>Performance</span>
                        </div>

                    </div>

                </div>


                <!-- WEBSITE PREVIEW -->

                <div class="hero-visual">

                    <div class="floating-shape shape-one"></div>
                    <div class="floating-shape shape-two"></div>


                    <div class="browser-card">

                        <div class="browser-header">

                            <div class="browser-buttons">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>

                            <div class="browser-address">
                                glennstudio.dev
                            </div>

                        </div>


                        <div class="browser-content">

                            <div class="code-panel">

                                <div class="code-title">
                                    index.html
                                </div>

                                <div class="code-lines">

                                    <p>
                                        <span class="line-number">01</span>
                                        <span class="code-purple">
                                            &lt;section
                                        </span>
                                        class=
                                        <span class="code-green">
                                            "hero"
                                        </span>
                                        <span class="code-purple">
                                            &gt;
                                        </span>
                                    </p>

                                    <p>
                                        <span class="line-number">02</span>
                                        &nbsp;&nbsp;
                                        <span class="code-purple">
                                            &lt;h1&gt;
                                        </span>
                                        Create.
                                    </p>

                                    <p>
                                        <span class="line-number">03</span>
                                        &nbsp;&nbsp;
                                        Design.
                                    </p>

                                    <p>
                                        <span class="line-number">04</span>
                                        &nbsp;&nbsp;
                                        Build.
                                        <span class="code-purple">
                                            &lt;/h1&gt;
                                        </span>
                                    </p>

                                    <p>
                                        <span class="line-number">05</span>
                                        <span class="code-purple">
                                            &lt;/section&gt;
                                        </span>
                                    </p>

                                </div>

                            </div>


                            <div class="preview-panel">

                                <span class="preview-label">
                                    LIVE PREVIEW
                                </span>

                                <div class="preview-card">

                                    <div class="preview-icon">
                                        G
                                    </div>

                                    <h3>Modern Website</h3>

                                    <p>
                                        Clean design with strong visual identity.
                                    </p>

                                    <div class="preview-button">
                                        Explore
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        <!-- ABOUT -->

        <section id="about" class="section">

            <div class="container">

                <div class="section-heading">

                    <span class="section-label">
                        ABOUT
                    </span>

                    <h2>
                        Design and development working together.
                    </h2>

                    <p>
                        A good website should not only look attractive. It should
                        also be responsive, accessible, organized, and easy to use.
                    </p>

                </div>


                <div class="about-grid">

                    <article class="information-card">

                        <div class="card-icon">
                            01
                        </div>

                        <h3>Modern Design</h3>

                        <p>
                            Clean layouts, readable typography, balanced spacing,
                            and consistent visual elements.
                        </p>

                    </article>


                    <article class="information-card featured-card">

                        <div class="card-icon">
                            02
                        </div>

                        <h3>Responsive Layout</h3>

                        <p>
                            The website automatically adjusts to desktop,
                            tablet, and mobile screen sizes.
                        </p>

                    </article>


                    <article class="information-card">

                        <div class="card-icon">
                            03
                        </div>

                        <h3>Clean Development</h3>

                        <p>
                            Organized HTML, reusable CSS classes, and simple
                            JavaScript functionality.
                        </p>

                    </article>

                </div>

            </div>

        </section>


        <!-- SERVICES -->

        <section id="services" class="section alternate-section">

            <div class="container">

                <div class="section-heading">

                    <span class="section-label">
                        SERVICES
                    </span>

                    <h2>
                        What I can build.
                    </h2>

                    <p>
                        Websites designed for different users, businesses,
                        organizations, and digital projects.
                    </p>

                </div>


                <div class="services-grid">

                    <article class="service-card">

                        <div class="service-number">
                            01
                        </div>

                        <h3>Landing Pages</h3>

                        <p>
                            Promotional pages designed to present a product,
                            service, campaign, or company.
                        </p>

                        <a href="#contact">
                            Learn more →
                        </a>

                    </article>


                    <article class="service-card">

                        <div class="service-number">
                            02
                        </div>

                        <h3>Business Websites</h3>

                        <p>
                            Professional websites with company information,
                            services, projects, and contact details.
                        </p>

                        <a href="#contact">
                            Learn more →
                        </a>

                    </article>


                    <article class="service-card">

                        <div class="service-number">
                            03
                        </div>

                        <h3>Portfolio Websites</h3>

                        <p>
                            Personal websites for developers, designers,
                            creatives, students, and professionals.
                        </p>

                        <a href="#contact">
                            Learn more →
                        </a>

                    </article>

                </div>

            </div>

        </section>


        <!-- PROJECTS -->

        <section id="projects" class="section">

            <div class="container">

                <div class="section-heading">

                    <span class="section-label">
                        PROJECTS
                    </span>

                    <h2>
                        Selected website concepts.
                    </h2>

                    <p>
                        These are sample project cards that you can later replace
                        with your real OJT projects.
                    </p>

                </div>


                <div class="projects-grid">

                    <article class="project-card">

                        <div class="project-visual project-purple">

                            <div class="project-window">

                                <div class="project-navigation"></div>

                                <div class="project-heading"></div>

                                <div class="project-text"></div>

                                <div class="project-button"></div>

                            </div>

                        </div>


                        <div class="project-information">

                            <div>
                                <span>WEB DESIGN</span>
                                <h3>Creative Agency</h3>
                            </div>

                            <span class="project-arrow">
                                ↗
                            </span>

                        </div>

                    </article>


                    <article class="project-card">

                        <div class="project-visual project-blue">

                            <div class="mobile-device">

                                <div class="mobile-speaker"></div>

                                <div class="mobile-content">

                                    <div class="mobile-circle"></div>

                                    <div class="mobile-line"></div>

                                    <div class="mobile-line short-line"></div>

                                </div>

                            </div>

                        </div>


                        <div class="project-information">

                            <div>
                                <span>RESPONSIVE DESIGN</span>
                                <h3>Mobile Application</h3>
                            </div>

                            <span class="project-arrow">
                                ↗
                            </span>

                        </div>

                    </article>

                </div>

            </div>

        </section>


        <!-- CONTACT -->

        <section id="contact" class="section contact-section">

            <div class="container contact-container">

                <div class="contact-information">

                    <span class="section-label">
                        CONTACT
                    </span>

                    <h2>
                        Let’s create something useful.
                    </h2>

                    <p>
                        Fill out the form to test the website interaction.
                        This is currently a demonstration form.
                    </p>


                    <div class="contact-details">

                        <div>
                            <span>Email</span>
                            <strong>example@gmail.com</strong>
                        </div>

                        <div>
                            <span>Location</span>
                            <strong>Philippines</strong>
                        </div>

                    </div>

                </div>


                <form class="contact-form" id="contactForm">

                    <div class="form-row">

                        <div class="form-field">

                            <label for="name">
                                Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Your name"
                                required
                            >

                        </div>


                        <div class="form-field">

                            <label for="email">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="you@example.com"
                                required
                            >

                        </div>

                    </div>


                    <div class="form-field">

                        <label for="subject">
                            Subject
                        </label>

                        <input
                            type="text"
                            id="subject"
                            name="subject"
                            placeholder="Website project"
                            required
                        >

                    </div>


                    <div class="form-field">

                        <label for="message">
                            Message
                        </label>

                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            placeholder="Tell me about your project..."
                            required
                        ></textarea>

                    </div>


                    <button
                        type="submit"
                        class="button button-primary form-button"
                    >
                        Send Message
                        <span>→</span>
                    </button>


                    <p
                        class="form-message"
                        id="formMessage"
                        aria-live="polite"
                    ></p>

                </form>

            </div>

        </section>

    </main>


    <!-- FOOTER -->

    <footer class="footer">

        <div class="container footer-content">

            <a href="#home" class="brand">

                <span class="brand-logo">
                    G
                </span>

                <span>
                    Glenn<span class="brand-highlight">Studio</span>
                </span>

            </a>


            <p>
                © <span id="currentYear"></span>
                Glenn Studio. Built using HTML, CSS, and JavaScript.
            </p>

        </div>

    </footer>


    <script src="script.js"></script>

</body>
</html>
