<?php

if (!class_exists('Updatr_v1p0_DebugBar_ThemePanel', false)) :

    class Updatr_v1p0_DebugBar_ThemePanel extends Updatr_v1p0_DebugBar_Panel
    {
        /**
         * @var Updatr_v1p0_Theme_UpdateChecker
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
