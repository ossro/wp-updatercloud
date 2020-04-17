<?php
if (!class_exists('Updatr_v1p0_Update', false)) :

    /**
     * A simple container class for holding information about an available update.
     *
     * @author Janis Elsts
     * @access public
     */
    abstract class Updatr_v1p0_Update extends Updatr_v1p0_Metadata
    {
        public $slug;
        public $version;
        public $download_url;
        public $translations = array();

        /**
         * @return string
         */
        protected function getFieldNames()
        {
            return array('slug', 'version', 'download_url', 'translations');
        }

        public function toWpFormat()
        {
            $update = new stdClass();

            $update->slug = $this->slug;
            $update->new_version = $this->version;
            $update->package = $this->download_url;

            return $update;
        }
    }

endif;
