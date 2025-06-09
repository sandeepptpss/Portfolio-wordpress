<div class="col-lg-7 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
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

                </div>