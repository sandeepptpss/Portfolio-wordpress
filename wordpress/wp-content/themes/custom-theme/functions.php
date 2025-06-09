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
        'Contact Messages',
        'Contact Messages',
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


?>
