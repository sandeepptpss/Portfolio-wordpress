<div class="container-xxl pb-5" id="contact">
        <div class="container py-5">
            <div class="row g-5 mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-6">
                    <h1 class="display-5 mb-0">Let's Work Together</h1>
                </div>
            </div>
            <div class="row g-5">
            <div class="col-lg-5 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
    <p class="mb-2">My office:</p>
    <h3 class="fw-bold"><?php echo get_theme_mod('office_address'); ?></h3>
    <hr class="w-100">
    <p class="mb-2">Call me:</p>
    <h3 class="fw-bold"><?php echo get_theme_mod('phone_number'); ?></h3>
    <hr class="w-100">
    <p class="mb-2">Mail me:</p>
    <h3 class="fw-bold"><?php echo get_theme_mod('email_address'); ?></h3>
    <hr class="w-100">
    <p class="mb-2">Follow me:</p>
    <?php $twitter = get_theme_mod('social_twitter'); ?>
    <?php $facebook = get_theme_mod('social_facebook'); ?>
    <?php $youtube = get_theme_mod('social_youtube'); ?>
    <?php $linkedin = get_theme_mod('social_linkedin'); ?>
    <?php $instagram = get_theme_mod('social_instagram'); ?>
    <div class="d-flex pt-2">
        <?php if (!empty($twitter)) : ?>
            <a class="btn btn-square btn-primary me-2" href="<?php echo esc_url($twitter); ?>">
                <i class="fab fa-twitter"></i>
            </a>
        <?php endif; ?>
            <a class="btn btn-square btn-primary me-2" href="<?php echo esc_url($instagram); ?>">
                <i class="fab fa-instagram"></i>
            </a>
            <a class="btn btn-square btn-primary me-2" href="<?php echo esc_url($facebook); ?>">
                <i class="fab fa-facebook-f"></i>
            </a>

        <?php if (!empty($youtube)) : ?>
            <a class="btn btn-square btn-primary me-2" href="<?php echo esc_url($youtube); ?>">
                <i class="fab fa-youtube"></i>
            </a>
        <?php endif; ?>
            <a class="btn btn-square btn-primary me-2" href="<?php echo esc_url($linkedin); ?>">
                <i class="fab fa-linkedin-in"></i>
            </a>
    </div>
    </div>
    <div class="col-lg-7 col-md-6 wow fadeInUp" data-wow-delay="0.5s" id="contact-me">
        <form id="contact-form">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                    <label for="name">Your Name</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                    <label for="email">Your Email</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                    <label for="subject">Subject</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 100px" required></textarea>
                    <label for="message">Message</label>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
            </div>
        </div>
        <div id="form-message" class="mt-3"></div>
    </form>
    </div>
    </div>
    </div>
    </div>
<script>
    document.getElementById("contact-form").addEventListener("submit", function (e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        formData.append("action", "custom_contact_form");
        fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            const msgDiv = document.getElementById("form-message");
            if (data.status === "success") {
                msgDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                form.reset();
            } else {
                msgDiv.innerHTML = `<div class="alert alert-warning">${data.message}</div>`;
            }
        })
        .catch(() => {
            document.getElementById("form-message").innerHTML = '<div class="alert alert-danger">Something went wrong.</div>';
        });
    });
</script>