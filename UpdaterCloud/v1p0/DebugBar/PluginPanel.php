<?php

if (!class_exists('UpdaterCloud_v1p0_DebugBar_PluginPanel', false)) :

    class UpdaterCloud_v1p0_DebugBar_PluginPanel extends UpdaterCloud_v1p0_DebugBar_Panel
    {
        /**
         * @var UpdaterCloud_v1p0_Plugin_UpdateChecker
         */
        protected $updateChecker;

        protected function displayConfigHeader()
        {
            $this->row('Plugin file', htmlentities($this->updateChecker->pluginFile));
            parent::displayConfigHeader();
        }

        protected function getMetadataButton()
        {
            $requestInfoButton = '';
            if (function_exists('get_submit_button')) {
                $requestInfoButton = get_submit_button(
                    'Request Info',
                    'secondary',
                    'updatercloud-request-info-button',
                    false,
                    array('id' => $this->updateChecker->getUniqueName('request-info-button'))
                );
            }
            return $requestInfoButton;
        }

        protected function getUpdateFields()
        {
            return array_merge(
                parent::getUpdateFields(),
                array('homepage', 'upgrade_notice', 'tested',)
            );
        }
    }

endif;
