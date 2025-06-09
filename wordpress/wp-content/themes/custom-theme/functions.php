<?php

// Enable featured image support
add_theme_support('post-thumbnails');
add_theme_support('custom-header');

register_nav_menus([
    'left_side_menu' => __('Left Side Menu'),
    'right_side_menu' => __('Right Side Menu'), 
    // 'side_menu' => __('Side Menu'), 
]);

function mytheme_customize_register( $wp_customize ) {

    // Section
    $wp_customize->add_section('custom_content_section', array(
        'title' => __('Banner', 'mytheme'),
        'priority' => 30,
    ));

    // Image
    $wp_customize->add_setting('custom_image_setting', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_image_setting', array(
        'label' => __('Upload an Image', 'mytheme'),
        'section' => 'custom_content_section',
        'settings' => 'custom_image_setting',
    )));

    // Text (Single Line)
    $wp_customize->add_setting('custom_text_setting', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('custom_text_setting', array(
        'label' => __('Heading', 'mytheme'),
        'section' => 'custom_content_section',
        'type' => 'text',
    ));

    // Link
    $wp_customize->add_setting('custom_link_setting', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('custom_link_setting', array(
        'label' => __('Enter Link URL', 'mytheme'),
        'section' => 'custom_content_section',
        'type' => 'url',
    ));

    // Textarea
    $wp_customize->add_setting('custom_textarea_setting', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('custom_textarea_setting', array(
        'label' => __('Text', 'mytheme'),
        'section' => 'custom_content_section',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'mytheme_customize_register');



add_action('wp_ajax_custom_contact_form', 'handle_custom_contact_form');
add_action('wp_ajax_nopriv_custom_contact_form', 'handle_custom_contact_form');

function handle_custom_contact_form() {
    global $wpdb;

    $table = $wpdb->prefix . 'contact_messages';
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    // Check for duplicate email
    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table WHERE email = %s", $email
    ));

    if ($exists > 0) {
        wp_send_json([
            'status' => 'duplicate',
            'message' => 'This email has already submitted a message.'
        ]);
    }

    $inserted = $wpdb->insert($table, [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message,
        'submitted_at' => current_time('mysql'),
    ]);

    if ($inserted === false) {
        wp_send_json([
            'status' => 'error',
            'message' => 'Failed to save your message. Please try again.'
        ]);
    }

    wp_send_json([
        'status' => 'success',
        'message' => 'Thank you! Your message has been sent successfully.'
    ]);
}




function create_contact_messages_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_messages';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        subject varchar(255) DEFAULT '',
        message text NOT NULL,
        submitted_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
// Run this once manually
create_contact_messages_table();

register_activation_hook(__FILE__, 'create_contact_messages_table');

add_action('admin_menu', 'contact_messages_menu');
function contact_messages_menu() {
    add_menu_page(
        'Submission Data',
        'Submission Data',
        'manage_options',
        'contact-messages',
        'display_contact_messages',
        'dashicons-email-alt',
        26
    );
}

function display_contact_messages() {
    global $wpdb;
    $table = $wpdb->prefix . 'contact_messages';
    $messages = $wpdb->get_results("SELECT * FROM $table ORDER BY submitted_at DESC");

    echo '<div class="wrap"><h1>Contact Form Submissions</h1>';
    
    // Modal placeholder
    echo '
    <div id="editModal" style="display:none; position:fixed; top:10%; left:30%; width:40%; background:#fff; border:1px solid #ccc; padding:20px; z-index:9999;">
        <h2>Edit Message</h2>
        <form id="editForm">
            <input type="hidden" name="id" id="edit-id">
            <p><label>Name</label><br><input type="text" name="name" id="edit-name" style="width:100%;"></p>
            <p><label>Email</label><br><input type="email" name="email" id="edit-email" style="width:100%;"></p>
            <p><label>Subject</label><br><input type="text" name="subject" id="edit-subject" style="width:100%;"></p>
            <p><label>Message</label><br><textarea name="message" id="edit-message" style="width:100%;"></textarea></p>
            <p>
                <button type="submit" class="button button-primary">Save</button>
                <button type="button" onclick="document.getElementById(\'editModal\').style.display=\'none\'" class="button">Cancel</button>
            </p>
        </form>
        <div id="editResponse"></div>
    </div>';

    echo '<table class="widefat fixed"><thead>
            <tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Date</th><th>Actions</th></tr>
          </thead><tbody>';
    
    foreach ($messages as $msg) {
        echo "<tr>
            <td>{$msg->name}</td>
            <td>{$msg->email}</td>
            <td>{$msg->subject}</td>
            <td>{$msg->message}</td>
            <td>{$msg->submitted_at}</td>
            <td>
                <button class='button edit-btn' 
                    data-id='{$msg->id}' 
                    data-name='{$msg->name}' 
                    data-email='{$msg->email}' 
                    data-subject='{$msg->subject}' 
                    data-message='{$msg->message}'>Edit</button>
                <a href='" . admin_url("admin.php?page=contact-messages&delete_message={$msg->id}") . "' class='button delete-btn' onclick='return confirm(\"Delete this message?\")'>Delete</a>
            </td>
        </tr>";
    }

    echo '</tbody></table></div>';

    // Handle delete
    if (isset($_GET['delete_message'])) {
        $id = intval($_GET['delete_message']);
        $wpdb->delete($table, ['id' => $id]);
        echo "<script>location.href='" . admin_url('admin.php?page=contact-messages') . "';</script>";
    }

    // JavaScript for popup edit
    echo "
    <script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit-id').value = this.dataset.id;
            document.getElementById('edit-name').value = this.dataset.name;
            document.getElementById('edit-email').value = this.dataset.email;
            document.getElementById('edit-subject').value = this.dataset.subject;
            document.getElementById('edit-message').value = this.dataset.message;
            document.getElementById('editModal').style.display = 'block';
        });
    });

    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch(ajaxurl, {
            method: 'POST',
            body: new URLSearchParams([...formData, ['action', 'update_contact_message']])
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('editResponse').innerText = data.message;
            if (data.success) {
                setTimeout(() => window.location.reload(), 1000);
            }
        });
    });
    </script>";
}

add_action('wp_ajax_update_contact_message', 'update_contact_message');

function update_contact_message() {
    global $wpdb;
    $table = $wpdb->prefix . 'contact_messages';

    $id = intval($_POST['id']);
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);
    $updated = $wpdb->update($table, [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message
    ], ['id' => $id]);

    if ($updated !== false) {
        wp_send_json(['success' => true, 'message' => 'Message updated successfully.']);
    } else {
        wp_send_json(['success' => false, 'message' => 'Failed to update message.']);
    }
}


// Contact Info Section
function custom_contact_customizer($wp_customize) {

    $wp_customize->add_section('contact_info_section', array(
        'title' => __('Contact Info'),
        'priority' => 30,
    ));

    // Office Address
    $wp_customize->add_setting('office_address', array('default' => '123 Street, New York, USA'));
    $wp_customize->add_control('office_address', array(
        'label' => __('Office Address'),
        'section' => 'contact_info_section',
        'type' => 'text',
    ));

    // Phone
    $wp_customize->add_setting('phone_number', array('default' => '+012 345 6789'));
    $wp_customize->add_control('phone_number', array(
        'label' => __('Phone Number'),
        'section' => 'contact_info_section',
        'type' => 'text',
    ));

    // Email
    $wp_customize->add_setting('email_address', array('default' => 'you@example.com'));
    $wp_customize->add_control('email_address', array(
        'label' => __('Email Address'),
        'section' => 'contact_info_section',
        'type' => 'email',
    ));

    // Social Media
    $socials = ['twitter', 'facebook', 'youtube', 'linkedin','instagram'];
    foreach ($socials as $social) {
        $wp_customize->add_setting("social_{$social}", array('default' => '#'));
        $wp_customize->add_control("social_{$social}", array(
            'label' => ucfirst($social) . ' URL',
            'section' => 'contact_info_section',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'custom_contact_customizer');

function custom_google_map($wp_customize) {
    $wp_customize->add_section('google_map_section', array(
        'title'    => __('Google Map Embed'),
        'priority' => 31,
    ));

    $wp_customize->add_setting('google_map', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_iframe', // Use custom sanitizer
    ));

    $wp_customize->add_control('google_map', array(
        'label'    => __('Google Map Embed Code'),
        'section'  => 'google_map_section',
        'type'     => 'textarea',
    ));
}
add_action('customize_register', 'custom_google_map');

function sanitize_iframe($input) {
    return wp_kses($input, array(
        'iframe' => array(
            'src'             => true,
            'width'           => true,
            'height'          => true,
            'frameborder'     => true,
            'style'           => true,
            'allowfullscreen' => true,
            'aria-hidden'     => true,
            'tabindex'        => true,
        )
    ));
}


  // Allow SVG for admins only

function enable_svg_upload_for_admin($mimes) {
  
    if (current_user_can('administrator')) {
        $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter('upload_mimes', 'enable_svg_upload_for_admin');


?>
