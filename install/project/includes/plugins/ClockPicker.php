<?php

/**
 * The ClockPicker override file. This file gets installed into project/includes/plugins during the initial installation
 * of the plugin. After that, it is not touched. Feel free to modify this file as needed.
 */

namespace QCubed\Plugin;

use QCubed\Exception\Caller;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;

/**
 * ClockPickerBase constructor
 *
 * @param ControlBase|FormBase|null $objParentObject
 * @param null|string $strControlId
 */

class ClockPicker extends ClockPickerBase
{
    public function  __construct(ControlBase|FormBase $objParentObject, ?string $strControlId = null) {
        parent::__construct($objParentObject, $strControlId);
        $this->registerFiles();
        $this->setHtmlAttribute('autocomplete', 'off');
    }

    /**
     * Registers necessary JavaScript and CSS files for the component.
     *
     * @return void
     * @throws Caller
     */

    protected function registerFiles(): void
    {
        $this->AddJavascriptFile(QCUBED_CLOCKPICKER_ASSETS_URL . "/js/bootstrap-clockpicker.min.js");
        $this->addCssFile(QCUBED_CLOCKPICKER_ASSETS_URL . "/css/bootstrap-clockpicker.min.css");
        $this->AddCssFile(QCUBED_BOOTSTRAP_CSS); // make sure they know
        $this->AddCssFile(QCUBED_FONT_AWESOME_CSS); // make sure they know
    }

}