<?php

class NextendSocialLoginPROProviderExtensionGoogle extends NextendSocialLoginPROProviderExtensionWithSyncData {

    /** @var NextendSocialProviderGoogle */
    protected $provider;

    public function providerEnabled() {

        parent::providerEnabled();
        add_filter('nsl_' . $this->provider->getId() . '_sync_field_biographies', array(
            $this,
            'sync_field_biographies'
        ), 10, 2);

        add_filter('nsl_' . $this->provider->getId() . '_sync_field_birthdays', array(
            $this,
            'sync_field_birthdays'
        ), 10, 2);

        add_filter('nsl_' . $this->provider->getId() . '_sync_field_occupations', array(
            $this,
            'sync_field_occupations'
        ), 10, 2);

        add_filter('nsl_' . $this->provider->getId() . '_sync_field_organizations', array(
            $this,
            'sync_field_organizations'
        ), 10, 2);

        add_filter('nsl_' . $this->provider->getId() . '_sync_field_residences', array(
            $this,
            'sync_field_residences'
        ), 10, 2);

        add_filter('nsl_' . $this->provider->getId() . '_sync_field_taglines', array(
            $this,
            'sync_field_taglines'
        ), 10, 2);

        add_filter('nsl_' . $this->provider->getId() . '_sync_field_ageRanges', array(
            $this,
            'sync_field_ageRanges'
        ), 10, 2);

        add_filter('nsl_' . $this->provider->getId() . '_sync_field_addresses', array(
            $this,
            'sync_field_addresses'
        ), 10, 2);

        add_filter('nsl_' . $this->provider->getId() . '_sync_field_phoneNumbers', array(
            $this,
            'sync_field_phoneNumbers'
        ), 10, 2);

        //Sync data warning
        add_filter('nsl_' . $this->provider->getId() . '_sync_warning', array(
            $this,
            'google_sync_warning'
        ), 10);
    }


    public function sync_field_biographies($value, $original_value) {
        if (isset($original_value) && is_array($original_value)) {
            return $original_value[0]['value'];
        }

        return false;
    }

    public function sync_field_birthdays($value, $original_value) {
        if (isset($original_value) && is_array($original_value)) {
            $date       = $original_value[0]['date'];
            $dateString = $date['year'] . '-' . $date['month'] . '-' . $date['day'];

            return $dateString;
        }

        return false;
    }

    public function sync_field_occupations($value, $original_value) {
        if (isset($original_value) && is_array($original_value)) {
            return $original_value[0]['value'];
        }

        return false;
    }

    public function sync_field_organizations($value, $original_value) {
        if (isset($original_value) && is_array($original_value)) {
            $organizations = array();
            foreach ($original_value as $organization) {
                $organizations[] = array(
                    'name'           => $organization['name'],
                    'title'          => $organization['title'],
                    'type'           => $organization['type'],
                    'startDate'      => $organization['startDate']['year'],
                    'endDate'        => $organization['endDate']['year'],
                    'primary'        => ($organization['primary'] ? 'true' : 'false'),
                    'jobDescription' => $organization['jobDescription'],
                );
            }

            return maybe_serialize($organizations);
        }

        return false;
    }

    public function sync_field_residences($value, $original_value) {
        if (isset($original_value) && is_array($original_value)) {
            $residences = array();
            foreach ($original_value as $residence) {
                $residences[] = array(
                    'current' => ($residence['current'] ? 'true' : 'false'),
                    'value'   => $residence['value'],
                );
            }

            return maybe_serialize($residences);
        }

        return false;
    }

    public function sync_field_taglines($value, $original_value) {
        if (isset($original_value) && is_array($original_value)) {
            return $original_value[0]['value'];
        }

        return false;
    }

    public function sync_field_ageRanges($value, $original_value) {
        if (isset($original_value) && is_array($original_value)) {
            return $original_value[0]['ageRange'];
        }

        return false;
    }

    public function sync_field_addresses($value, $original_value) {
        if (isset($original_value) && is_array($original_value)) {
            $addresses = array();
            foreach ($original_value as $address) {
                $addresses[] = array(
                    'formattedValue' => $address['formattedValue'],
                );
            }

            return maybe_serialize($addresses);
        }

        return false;
    }

    public function sync_field_phoneNumbers($value, $original_value) {
        if (isset($original_value) && is_array($original_value)) {
            $phoneNumbers = array();
            foreach ($original_value as $phoneNumber) {
                $phoneNumbers[] = array(
                    'type'  => $phoneNumber['type'],
                    'value' => $phoneNumber['value'],
                );
            }

            return maybe_serialize($phoneNumbers);
        }

        return false;
    }

    public function google_sync_warning() {
        $sync_warning_message = sprintf(__('Most of these information can only be retrieved, when the field is marked as Public on the user\'s %s page!', 'nextend-facebook-connect'), '<a href="https://aboutme.google.com/" target="_blank">About Me</a>');

        return $sync_warning_message;
    }


    protected function getRemoteData($node = 'me') {
        switch ($node) {
            case 'me':
                return $this->provider->getMe();
            case 'people':
                return $this->provider->getMyPeople();
        }

        return array();
    }
}