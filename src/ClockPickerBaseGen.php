<?php

namespace QCubed\Plugin;

use QCubed\Bootstrap as Bs;
use QCubed\Exception\Caller;
use QCubed\Exception\InvalidCast;
use QCubed\ModelConnector\Param as QModelConnectorParam;
use QCubed\Project\Application;
use QCubed\ApplicationBase;
use QCubed\Type;

/**
 * Class ClockPickerGen
 *
 * @see ClockPickerBase
 * @package QCubed\Plugin
 */

/**
 * @property string $Default	Default: '' (default time, 'now' or '13:14' e.g.)
 * @property string $Placement Default: 'bottom'	(popover placement)
 * @property string $Align Default: 'left' (popover arrow align)
 * @property string $DoneText For example, type 'Done' (done a button text)
 * @property boolean $AutoClose Default: false (auto close when minute is selected)
 * @property boolean $Vibrate Default: true (vibrate the device when dragging clock hand)
 * @property string $FromNow Default: 0 Set the default time to * milliseconds from now (using with default = 'now')
 * @property boolean $TwelveHour Default: false Enables twelve-hour mode with AM & PM buttons
 *
 * @see https://weareoutman.github.io/clockpicker/ or https://github.com/weareoutman/clockpicker
 * @package QCubed\Plugin
 */

class ClockPickerBaseGen extends Bs\TextBox
{
    /** @var string|null */
    protected ?string $strDefault = null;
    /** @var string|null */
    protected ?string $strPlacement = null;
    /** @var string|null */
    protected ?string $strAlign = null;
    /** @var string|null */
    protected ?string $strDoneText = null;
    /** @var boolean */
    protected ?bool $blnAutoClose = null;
    /** @var boolean */
    protected ?bool $blnVibrate = null;
    /** @var string|null */
    protected ?string $strFromNow = null;
    /** @var boolean */
    protected ?bool $blnTwelveHour = null;

    /**
     * Generate and return the jQuery options for the clockpicker.
     *
     * This method compiles the settings for the clockpicker based on the current
     * object properties. The options include default value, placement, alignment,
     * text for the 'done' button, autoclose behavior, vibrate functionality,
     * offset time, and 12-hour/24-hour format.
     *
     * @return array The compiled array of jQuery options for customization.
     */
    protected function makeJqOptions(): array
    {
        $jqOptions = parent::MakeJqOptions();
        if (!is_null($val = $this->Default)) {$jqOptions['default'] = $val;}
        if (!is_null($val = $this->Placement)) {$jqOptions['placement'] = $val;}
        if (!is_null($val = $this->Align)) {$jqOptions['align'] = $val;}
        if (!is_null($val = $this->DoneText)) {$jqOptions['donetext'] = $val;}
        if (!is_null($val = $this->AutoClose)) {$jqOptions['autoclose'] = $val;}
        if (!is_null($val = $this->Vibrate)) {$jqOptions['vibrate'] = $val;}
        if (!is_null($val = $this->FromNow)) {$jqOptions['fromnow'] = $val;}
        if (!is_null($val = $this->TwelveHour)) {$jqOptions['twelvehour'] = $val;}
        return $jqOptions;
    }

    /**
     * Retrieve the jQuery setup function name for the clockpicker.
     *
     * This method returns the name of the jQuery function used to initialize the clockpicker component.
     *
     * @return string The name of the jQuery setup function, which is "clockpicker".
     */
    public function getJqSetupFunction(): string
    {
        return 'clockpicker';
    }

    /**
     * Show the clockpicker.
     *
     * This method does not accept any arguments.
     */
    public function show(): void
    {
        Application::executeControlCommand($this->getJqControlId(), $this->getJqSetupFunction(), "show", ApplicationBase::PRIORITY_LOW);
    }

    /**
     * Hide the clockpicker.
     *
     * This method does not accept any arguments.
     */
    public function hide(): void
    {
        Application::executeControlCommand($this->getJqControlId(), $this->getJqSetupFunction(), "hide", ApplicationBase::PRIORITY_LOW);
    }

    /**
     * Remove the clockpicker (and event listeners).
     *
     * This method does not accept any arguments.
     */
    public function remove(): void
    {
        Application::executeControlCommand($this->getJqControlId(), $this->getJqSetupFunction(), "remove", ApplicationBase::PRIORITY_LOW);
    }

    /**
     * Magic method to get the value of a property dynamically.
     *
     * This method allows access to specific properties of the object.
     * If the requested property does not exist, it delegates the call to the parent class.
     *
     * @param string $strName The name of the property to retrieve.
     *
     * @return mixed The value of the requested property, or it will throw an exception if the property does not exist.
     * @throws Caller Exception thrown if the property cannot be found.
     */
    public function __get(string $strName): mixed
    {
        switch ($strName) {
            case 'Default': return $this->strDefault;
            case 'Placement': return $this->strPlacement;
            case 'Align': return $this->strAlign;
            case 'DoneText': return $this->strDoneText;
            case 'AutoClose': return $this->blnAutoClose;
            case 'Vibrate': return $this->blnVibrate;
            case 'FromNow': return $this->strFromNow;
            case 'TwelveHour': return $this->blnTwelveHour;

            default:
                try {
                    return parent::__get($strName);
                } catch (Caller $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
        }
    }

    /**
     * Sets the value of a property dynamically.
     *
     * This method allows setting specific properties of the object, such as
     * Default, Placement, Align, DoneText, AutoClose, Vibrate, FromNow, or TwelveHour.
     * If the property name does not match any predefined options, it attempts
     * to set it using the parent class's __set method.
     *
     * @param string $strName The name of the property to set.
     * @param mixed $mixValue The value to assign to the property. The type
     *                        of value is validated and cast based on the property.
     *
     * @return void
     *
     * @throws InvalidCast Thrown when the value cannot be cast to the expected type.
     * @throws Caller Thrown when the property is not recognized by the parent class.
     */
    public function __set(string $strName, mixed $mixValue): void
    {
        switch ($strName) {
            case 'Default':
                try {
                    $this->strDefault = Type::cast($mixValue, Type::STRING);
                    $this->addAttributeScript($this->getJqSetupFunction(), 'option', 'default', $this->strDefault);
                    break;
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }

            case 'Placement':
                try {
                    $this->strPlacement = Type::cast($mixValue, Type::STRING);
                    $this->addAttributeScript($this->getJqSetupFunction(), 'option', 'placement', $this->strPlacement);
                    break;
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }

            case 'Align':
                try {
                    $this->strAlign = Type::cast($mixValue, Type::STRING);
                    $this->addAttributeScript($this->getJqSetupFunction(), 'option', 'align', $this->strAlign);
                    break;
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }

            case 'DoneText':
                try {
                    $this->strDoneText = Type::cast($mixValue, Type::STRING);
                    $this->addAttributeScript($this->getJqSetupFunction(), 'option', 'donetext', $this->strDoneText);
                    break;
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }

            case 'AutoClose':
                try {
                    $this->blnAutoClose = Type::cast($mixValue, Type::BOOLEAN);
                    $this->addAttributeScript($this->getJqSetupFunction(), 'option', 'autoclose', $this->blnAutoClose);
                    break;
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }

            case 'Vibrate':
                try {
                    $this->blnVibrate = Type::cast($mixValue, Type::INTEGER);
                    $this->addAttributeScript($this->getJqSetupFunction(), 'option', 'vibrate', $this->blnVibrate);
                    break;
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }

            case 'FromNow':
                try {
                    $this->strFromNow = Type::cast($mixValue, Type::STRING);
                    $this->addAttributeScript($this->getJqSetupFunction(), 'option', 'fromnow', $this->strFromNow);
                    break;
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }

            case 'TwelveHour':
                try {
                    $this->blnTwelveHour = Type::cast($mixValue, Type::BOOLEAN);
                    $this->addAttributeScript($this->getJqSetupFunction(), 'option', 'twelvehour', $this->blnTwelveHour);
                    break;
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }


            default:
                try {
                    parent::__set($strName, $mixValue);
                    break;
                } catch (Caller $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
        }
    }

    /**
     * If this control is attachable to a codegenerated control in a ModelConnector, this function will be
     * used by the ModelConnector designer dialog to display a list of options for the control.
     * @return QModelConnectorParam[]
     * @throws Caller
     */
    public static function getModelConnectorParams(): array
    {
        return array_merge(parent::GetModelConnectorParams(), array());
    }
}


