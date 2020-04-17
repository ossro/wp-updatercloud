<?php
if (!class_exists('Updatr_v1p0_Analytics', false)) :

    /**
     * This class gathers the analytics data.
     */
    class Updatr_v1p0_Analytics
    {
        /**
         * @var Updatr_v1p0_UpdateChecker
         */
        protected $updateChecker;

        public function __construct($updateChecker)
        {
            $this->updateChecker = $updateChecker;
        }

        /**
         * Gather analytics data.
         *
         * @return array
         */
        public function gather()
        {
            return [
                'installed_version' => urlencode($this->updateChecker->getInstalledVersion()),
                'platform_vendor' => urlencode($this->getPlatformVendor()),
                'platform_version' => urlencode($this->getPlatformVersion()),
                'db_vendor' => urlencode($this->getDBVendor()),
                'db_version' => urlencode($this->getDBVersion()),
                'domain' => urlencode($this->getInstalledDomain()),
                'php_version' => urlencode($this->getPHPVersion()),
                'locale' => urlencode($this->getWPLang()),
            ];
        }

        /**
         * Get the domain name where WP is installed.
         *
         * @return string
         */
        protected function getInstalledDomain()
        {
            try {
                $parts = parse_url(get_site_url());

                return $parts['host'];
            } catch (Exception $e) {
                return '';
            }
        }

        /**
         * Get the PHP version.
         *
         * @return string
         */
        protected function getPHPVersion()
        {
            try {
                return phpversion();
            } catch (Exception $e) {
                return '';
            }
        }

        /**
         * Get the WP lang.
         *
         * @return string
         */
        protected function getWPLang()
        {
            try {
                return get_bloginfo('language');
            } catch (Exception $e) {
                return '';
            }
        }

        /**
         * Get CMS/Platform vendor, obviously WordPress in this case.
         *
         * @return string
         */
        protected function getPlatformVendor()
        {
            return 'WordPress';
        }

        /**
         * Get CMS/Platform version.
         *
         * @return string
         */
        protected function getPlatformVersion()
        {
            try {
                return get_bloginfo('version');
            } catch (Exception $e) {
                return '';
            }
        }

        /**
         * Get DB Vendor.
         *
         * @return string
         */
        protected function getDBVendor()
        {
            $vendor = 'MySQL';

            try {
                $version = $this->getRealDBVersion();

                // Check if we have a MariaDB version string
                if (stripos($version, 'mariadb') !== false) {
                    $vendor = 'MariaDB';
                }

                return $vendor;
            } catch (Exception $e) {
                return '';
            }
        }

        /**
         * Get DB Version.
         *
         * @return string
         */
        protected function getDBVersion()
        {
            try {
                $version = $this->getRealDBVersion();

                // Check if we have a MariaDB version string and extract the proper version from it
                if (preg_match('/^(?:5\.5\.5-)?(mariadb-)?(?P<major>\d+)\.(?P<minor>\d+)\.(?P<patch>\d+)/i', $version, $versionParts)) {
                    $version = $versionParts['major'] . '.' . $versionParts['minor'] . '.' . $versionParts['patch'];
                }

                return preg_replace('/[^0-9.].*/', '', $version);
            } catch (Exception $e) {
                return '';
            }
        }

        /**
         * Get real db version.
         *
         * @return string|null
         */
        protected function getRealDBVersion()
        {
            global $wpdb;

            if (! $wpdb->use_mysqli) {
                return mysql_get_server_info($wpdb->dbh);
            }

            return mysqli_get_server_info($wpdb->dbh);
        }
    }
endif;
