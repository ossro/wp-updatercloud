<?php

if (!class_exists('UpdaterCloud_v1p0_DebugBar_ThemePanel', false)) :

    class UpdaterCloud_v1p0_DebugBar_ThemePanel extends UpdaterCloud_v1p0_DebugBar_Panel
    {
        /**
         * @var UpdaterCloud_v1p0_Theme_UpdateChecker
         */
        protected $updateChecker;

        protected function displayConfigHeader()
        {
            $this->row('Theme directory', htmlentities($this->updateChecker->directoryName));
            parent::displayConfigHeader();
        }

        protected function getUpdateFields()
        {
            return array_merge(parent::getUpdateFields(), array('details_url'));
        }
    }

endif;
