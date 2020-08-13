<?php
defined('ABSPATH') || die();
/** @var $this NextendSocialProviderAdmin */

$provider = $this->getProvider();
?>
<ol>
    <li><?php printf(__('Navigate to %s', 'nextend-facebook-connect'), '<a href="https://www.linkedin.com/developer/apps" target="_blank">https://www.linkedin.com/developer/apps</a>'); ?></li>
    <li><?php printf(__('Log in with your %s credentials if you are not logged in', 'nextend-facebook-connect'), 'LinkedIn'); ?></li>
    <li><?php _e('Click on your App and go to the "<b>Auth</b>" tab.', 'nextend-facebook-connect'); ?></li>
    <li><?php printf(__('Add the following URL to the "<b>Redirect URLs</b>" field: <b>%s</b>', 'nextend-facebook-connect'), $provider->getLoginUrl()); ?></li>
    <li><?php _e('Click on "<b>Update</b>" to save the changes', 'nextend-facebook-connect'); ?></li>
</ol>