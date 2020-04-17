<?php

require dirname(__FILE__) . '/Updatr/v1p0/Autoloader.php';

new Updatr_v1p0_Autoloader();

require dirname(__FILE__) . '/Updatr/v1p0/Factory.php';
require dirname(__FILE__) . '/Updatr/v1/Factory.php';

//Register classes defined in this version with the factory.
foreach (array(
        'Plugin_UpdateChecker' => 'Updatr_v1p0_Plugin_UpdateChecker',
        'Theme_UpdateChecker'  => 'Updatr_v1p0_Theme_UpdateChecker',
    )
    as $updatrGeneralClass => $updatrVersionedClass) {
    Updatr_v1_Factory::addVersion($updatrGeneralClass, $updatrVersionedClass, '4.9');
    //Also add it to the minor-version factory in case the major-version factory
    //was already defined by another, older version of the update checker.
    Updatr_v1p0_Factory::addVersion($updatrGeneralClass, $updatrVersionedClass, '4.9');
}
