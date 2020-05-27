<?php

require dirname(__FILE__) . '/UpdaterCloud/v1p0/Autoloader.php';

new UpdaterCloud_v1p0_Autoloader();

require dirname(__FILE__) . '/UpdaterCloud/v1p0/Factory.php';
require dirname(__FILE__) . '/UpdaterCloud/v1/Factory.php';

//Register classes defined in this version with the factory.
foreach (array(
        'Plugin_UpdateChecker' => 'UpdaterCloud_v1p0_Plugin_UpdateChecker',
        'Theme_UpdateChecker'  => 'UpdaterCloud_v1p0_Theme_UpdateChecker',
    )
    as $updaterCloudGeneralClass => $updaterCloudVersionedClass) {
    UpdaterCloud_v1_Factory::addVersion($updaterCloudGeneralClass, $updaterCloudVersionedClass, '1.0');
    //Also add it to the minor-version factory in case the major-version factory
    //was already defined by another, older version of the update checker.
    UpdaterCloud_v1p0_Factory::addVersion($updaterCloudGeneralClass, $updaterCloudVersionedClass, '1.0');
}
