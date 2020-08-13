<?php

use NSL\Notices;

class NextendSocialLoginPROProviderExtension {

    /** @var NextendSocialProvider */
    protected $provider;

    private $context = array();

    /**
     * NextendSocialLoginPROProviderExtension constructor.
     *
     * @param $provider NextendSocialProvider
     */
    public function __construct($provider) {
        $this->provider = $provider;

        add_action('nsl_providers_loaded', array(
            $this,
            'loaded'
        ));
    }

    public function loaded() {

        $id = $this->provider->getId();

        add_filter('nsl_' . $id . '_is_login_allowed', array(
            $this,
            'isLoginAllowed'
        ), 10, 3);

        add_action('nsl_' . $id . '_register_new_user', array(
            $this,
            'afterRegister'
        ));

        add_action('nsl_' . $id . '_before_register', array(
            $this,
            'beforeRegister'
        ));

        add_filter('nsl_' . $id . '_auto_link_allowed', array(
            $this,
            'isAutoLinkAllowed'
        ), 10, 1);

        add_filter('nsl_update_settings_validate_' . $this->provider->getOptionKey(), array(
            $this,
            'validateSettings'
        ), 10, 2);
    }

    public function validateSettings($newData, $postedData) {

        foreach ($postedData AS $key => $value) {
            switch ($key) {
                case 'disabled_roles':
                    $newData[$key] = array_filter((array)$value);
                    break;
                case 'register_roles':
                    $value = array_filter((array)$value);
                    if (empty($value)) {
                        $value[] = 'default';
                    }
                    $newData[$key] = $value;
                    break;
                case 'ask_email':
                case 'ask_user':
                case 'ask_password':
                case 'auto_link':
                    $newData[$key] = trim(sanitize_text_field($value));
                    break;
            }
        }

        if (!empty($postedData['sync_fields']) && is_array($postedData['sync_fields'])) {
            $sync_fields = $postedData['sync_fields'];

            if (isset($sync_fields['login'])) {
                $newData['sync_fields/login'] = intval($sync_fields['login']) ? 1 : 0;
            }

            if (isset($sync_fields['link'])) {
                $newData['sync_fields/link'] = intval($sync_fields['link']) ? 1 : 0;
            }

            if (!empty($sync_fields['fields']) && is_array($sync_fields['fields'])) {
                foreach ($sync_fields['fields'] AS $fieldName => $fieldSettings) {
                    if (isset($fieldSettings['enabled'])) {
                        $newData['sync_fields/fields/' . $fieldName . '/enabled'] = intval($fieldSettings['enabled']) ? 1 : 0;
                    }
                    if (isset($fieldSettings['meta_key'])) {
                        $newData['sync_fields/fields/' . $fieldName . '/meta_key'] = preg_replace("/[^A-Za-z0-9\-_ ]/", '', $fieldSettings['meta_key']);
                    }

                    if (empty($newData['sync_fields/fields/' . $fieldName . '/meta_key'])) {
                        $newData['sync_fields/fields/' . $fieldName . '/enabled'] = 0;
                    }
                }
            }
        }

        return $newData;
    }

    public function isLoginAllowed($isAllowed, $provider, $user_id) {
        if ($isAllowed) {
            $disable_roles = $this->provider->settings->get('disabled_roles');
            if (is_array($disable_roles) && count($disable_roles) > 0) {
                $user_info = get_userdata($user_id);
                foreach ($user_info->roles AS $user_role) {
                    if (in_array($user_role, $disable_roles)) {

                        Notices::addError(__('Social login is not allowed with this role!', 'nextend-facebook-connect'));
                        $isAllowed = false;
                    }
                }
            }
        }

        return $isAllowed;
    }

    public function afterRegister($user_id) {
        $register_roles = $this->provider->settings->get('register_roles');
        if (!is_array($register_roles) || count($register_roles) == 0 || (count($register_roles) === 1 && $register_roles[0] == 'default')) {
            //Do nothing as the user role is fine
        } else {
            $user = new WP_User($user_id);
            foreach ($register_roles as $k => $register_role) {
                if ($register_roles[$k] == 'default') {
                    $register_roles[$k] = get_option('default_role');
                }
            }

            $user->set_role($register_roles[0]);
            array_shift($register_roles);


            foreach ($register_roles as $register_role) {
                $user->add_role($register_role);
            }
        }
    }

    public function beforeRegister() {

        add_filter('nsl_registration_require_extra_input', array(
            $this,
            'require_extra_input_username'
        ), 0, 2);

        add_filter('nsl_registration_require_extra_input', array(
            $this,
            'require_extra_input_email'
        ), 0, 2);

        add_filter('nsl_registration_require_extra_input', array(
            $this,
            'require_extra_input_password'
        ), 0, 2);
    }

    public function require_extra_input_username($askExtraData, $userData) {

        $askUsername = false;
        switch ($this->provider->settings->get('ask_user')) {
            case 'always':
                $askUsername = true;
                break;
            case 'when-empty':
                if (empty($userData['username'])) {
                    $askUsername = true;
                }
                break;
        }

        if ($askUsername) {
            add_filter('nsl_registration_validate_extra_input', array(
                $this,
                'validate_extra_input_username'
            ), 10, 2);

            add_action('nsl_registration_form_start', array(
                $this,
                'registration_form_username'
            ), -30);
        }

        return $askExtraData || $askUsername;
    }

    /**
     * @param array    $userData
     * @param WP_Error $errors
     *
     * @return array
     */
    public function validate_extra_input_username($userData, $errors) {

        $isPost = isset($_POST['submit']);
        if ($isPost) {
            if (isset($_POST['user_login']) && is_string($_POST['user_login'])) {
                $hasError = false;

                $user_login           = $_POST['user_login'];
                $sanitized_user_login = sanitize_user($user_login);

                if ($sanitized_user_login == '') {
                    $errors->add('empty_username', '<strong>' . __('ERROR', 'nextend-facebook-connect') . '</strong>: ' . __('Please enter a username.'));
                    $hasError = true;
                } else if (!validate_username($user_login)) {
                    $errors->add('invalid_username', '<strong>' . __('ERROR') . '</strong>: ' . __('This username is invalid because it uses illegal characters. Please enter a valid username.'));
                    $sanitized_user_login = '';
                    $hasError             = true;
                } else if (!apply_filters('nsl_validate_username', true, $sanitized_user_login, $errors)) {
                    $hasError = true;
                } else if (username_exists($sanitized_user_login)) {
                    $errors->add('username_exists', '<strong>' . __('ERROR') . '</strong>: ' . __('This username is already registered. Please choose another one.'));
                    $hasError = true;

                } else {
                    /** This filter is documented in wp-includes/user.php */
                    $illegal_user_logins = array_map('strtolower', (array)apply_filters('illegal_user_logins', array()));
                    if (in_array(strtolower($sanitized_user_login), $illegal_user_logins)) {
                        $errors->add('invalid_username', '<strong>' . __('ERROR') . '</strong>: ' . __('Sorry, that username is not allowed.'));
                        $hasError = true;
                    }
                }

                if (!$hasError) {
                    $userData['username']   = $sanitized_user_login;
                    $userData['user_login'] = $sanitized_user_login;
                }
            }
        }

        return $userData;
    }

    public function registration_form_username($userData) {
        ?>
        <p>
            <label for="user_login"><?php _e('Username') ?><br/>
                <input type="text" name="user_login" id="user_login" class="input"
                       value="<?php echo esc_attr(wp_unslash($userData['username'])); ?>" size="20"/></label>
        </p>
        <?php
    }

    public function require_extra_input_email($askExtraData, $userData) {


        $askEmail = false;
        switch ($this->provider->settings->get('ask_email')) {
            case 'always':
                $askEmail = true;
                break;
            case 'when-empty':
                if (empty($userData['email'])) {
                    $askEmail = true;
                }
                break;
        }

        if ($askEmail) {
            add_filter('nsl_registration_validate_extra_input', array(
                $this,
                'validate_extra_input_email'
            ), 10, 2);

            add_action('nsl_registration_form_start', array(
                $this,
                'registration_form_email'
            ), -20);
        }

        return $askExtraData || $askEmail;
    }

    /**
     * @param array    $userData
     * @param WP_Error $errors
     *
     * @return array
     */
    public function validate_extra_input_email($userData, $errors) {

        $isPost = isset($_POST['submit']);
        if ($isPost) {
            if (isset($_POST['user_email']) && is_string($_POST['user_email'])) {
                $hasError = false;

                $email = $_POST['user_email'];

                if ($email == '') {
                    $errors->add('empty_email', '<strong>' . __('ERROR') . '</strong>: ' . __('Please enter an email address.'), array('form-field' => 'email'));
                    $hasError = true;
                } else if (!is_email($email)) {
                    $errors->add('invalid_email', '<strong>' . __('ERROR') . '</strong>: ' . __('The email address isn&#8217;t correct.'), array('form-field' => 'email'));
                    $email    = '';
                    $hasError = true;
                } else if (email_exists($email)) {
                    $errors->add('email_exists', '<strong>' . __('ERROR') . '</strong>: ' . __('This email is already registered, please choose another one.'), array('form-field' => 'email'));
                    $hasError = true;
                }
                if (!$hasError) {
                    $userData['email'] = $email;
                }
            }
        }

        return $userData;
    }

    public function registration_form_email($userData) {
        ?>
        <p>
            <label for="user_email"><?php _e('Email') ?><br/>
                <input type="email" name="user_email" id="user_email" class="input"
                       value="<?php echo esc_attr(wp_unslash($userData['email'])); ?>" size="25"/></label>
        </p>
        <?php if ($this->provider->settings->get('ask_password') != 'always'): ?>
            <p id="reg_passmail"><?php _e('Registration confirmation will be emailed to you.'); ?></p>
        <?php endif; ?>
        <?php
    }

    public function require_extra_input_password($askExtraData, $userData) {

        $askPassword = false;
        switch ($this->provider->settings->get('ask_password')) {
            case 'always':

                wp_enqueue_script('utils');
                wp_enqueue_script('user-profile');

                $askPassword = true;
                break;
        }

        if ($askPassword) {
            add_filter('nsl_registration_validate_extra_input', array(
                $this,
                'validate_extra_input_password'
            ), 10, 2);

            add_action('nsl_registration_form_start', array(
                $this,
                'registration_form_password'
            ), -10);
        }

        return $askExtraData || $askPassword;
    }

    /**
     * @param array    $userData
     * @param WP_Error $errors
     *
     * @return array
     */
    public function validate_extra_input_password($userData, $errors) {

        $isPost = isset($_POST['submit']);
        if ($isPost) {
            if (isset($_POST['pass1']) && is_string($_POST['pass1'])) {
                $hasError = false;

                $pass1 = $_POST['pass1'];
                $pass2 = $_POST['pass2'];

                // Check for blank password when adding a user.
                if (empty($pass1)) {
                    $errors->add('pass', __('<strong>ERROR</strong>: Please enter a password.'), array('form-field' => 'pass1'));
                    $hasError = true;
                }

                // Check for "\" in password.
                if (false !== strpos(wp_unslash($pass1), "\\")) {
                    $errors->add('pass', __('<strong>ERROR</strong>: Passwords may not contain the character "\\".'), array('form-field' => 'pass1'));
                    $hasError = true;
                }

                // Checking the password has been typed twice the same.
                if (!empty($pass1) && $pass1 != $pass2) {
                    $errors->add('pass', __('<strong>ERROR</strong>: Please enter the same password in both password fields.'), array('form-field' => 'pass1'));
                    $hasError = true;
                }

                if (!$hasError) {
                    $userData['password'] = $pass1;
                }
            }
        }

        return $userData;
    }

    public function registration_form_password($userData) {
        ?>
        <div class="user-pass1-wrap">
            <p>
                <label for="pass1"><?php _e('Password') ?></label>
            </p>

            <div class="wp-pwd">
                <div class="password-input-wrapper">
                    <input type="password" data-reveal="1" data-pw="<?php echo esc_attr(wp_generate_password(16)); ?>" name="pass1" id="pass1" class="input password-input" size="24" value="" autocomplete="off" aria-describedby="pass-strength-result"/>
                    <span class="button button-secondary wp-hide-pw hide-if-no-js">
                        <span class="dashicons dashicons-hidden"></span>
                    </span>
                </div>
                <div id="pass-strength-result" class="hide-if-no-js" aria-live="polite"><?php _e('Strength indicator'); ?></div>
            </div>
            <div class="pw-weak">
                <label>
                    <input type="checkbox" name="pw_weak" class="pw-checkbox"/>
                    <?php _e('Confirm use of weak password'); ?>
                </label>
            </div>
        </div>

        <p class="user-pass2-wrap">
            <label for="pass2"><?php _e('Confirm password') ?></label><br/>
            <input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off"/>
        </p>

        <p class="description indicator-hint"><?php echo wp_get_password_hint(); ?></p>
        <br class="clear"/>
        <?php
    }

    public function isAutoLinkAllowed($isAllowed) {
        if ($this->provider->settings->get('auto_link') == 'disabled') {

            Notices::addError(sprintf(__('This email is already registered, please login in to your account to link with %1$s.', 'nextend-facebook-connect'), $this->provider->getLabel()));

            return false;
        }

        return $isAllowed;
    }
}