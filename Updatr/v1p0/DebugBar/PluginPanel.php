<?php

if (!class_exists('Updatr_v1p0_DebugBar_PluginPanel', false)) :

    class Updatr_v1p0_DebugBar_PluginPanel extends Updatr_v1p0_DebugBar_Panel
    {
        /**
         * @var Updatr_v1p0_Plugin_UpdateChecker
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
                    'updatr-request-info-button',
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
