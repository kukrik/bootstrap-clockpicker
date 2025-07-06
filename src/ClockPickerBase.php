<?php

namespace QCubed\Plugin;

use QCubed\Exception\Caller;
use QCubed\Exception\InvalidCast;
use DateMalformedStringException;
use QCubed\QDateTime;
use QCubed\Type;

/**
 * Class ClockPickerBase
 *
 * @property null|QDateTime $DateTime
 *
 * @package QCubed\Plugin
 */

class ClockPickerBase extends ClockPickerBaseGen
{

    protected ?string $strLabelForInvalid = 'Invalid Time';

    protected ?string $strText = null;

    /**
     * Parses a given text to extract and return a time value, if present. The method attempts to clean
     * and normalize the input string before parsing it into a QDateTime object. If no time value can
     * be identified, the method returns null.
     *
     * @param string $strText The input text to be parsed for a time value. It is cleaned and normalized
     *                        before being processed.
     *
     * @return QDateTime|null Returns a QDateTime object if a valid time value is found;
     *                        otherwise, returns null.
     * @throws DateMalformedStringException
     * @throws Caller
     */
    public static function ParseForTimeValue(string $strText): ?QDateTime
    {
        // Trim and Clean

        $strText = strtolower(trim($strText));
        while(str_contains($strText, '  '))
            $strText = str_replace('  ', ' ', $strText);
        $strText = str_replace('.', '', $strText);
        $strText = str_replace('@', ' ', $strText);

        // Are we ATTEMPTING to parse a Time value?
        if ((!str_contains($strText, ':')) &&
            (!str_contains($strText, 'am')) &&
            (!str_contains($strText, 'pm'))) {
            // There is NO TIME VALUE
            return null;
        }

        // Add ':00' if it doesn't exist AND if 'am' or 'pm' exists
        if (str_contains($strText, 'pm')) {
            if (!str_contains($strText, ' pm')) {
                $strText = str_replace('pm', ' pm', $strText);
            }

            if (!str_contains($strText, ':')) {
                $strText = str_replace(' pm', ':00 pm', $strText, $intCount);
            }
        } else if ((str_contains($strText, 'am'))) {
            if (!str_contains($strText, ' am')) {
                $strText = str_replace('am', ' am', $strText);
            }
            if ((!str_contains($strText, ':'))) {
                $strText = str_replace(' am', ':00 am', $strText);
            }
        }

        return new QDateTime($strText);
    }

    /**
     * Validates the current state and ensures the text input can be correctly parsed into a time value.
     *
     * @return bool Returns true if validation is successful, false otherwise.
     * @throws DateMalformedStringException
     * @throws Caller
     */
    public function validate(): bool
    {
        if (parent::validate()) {
            if ($this->strText != "") {
                $dttTest = self::ParseForTimeValue($this->strText);
                if (!$dttTest) {
                    $this->ValidationError = $this->strLabelForInvalid;
                    return false;
                }
            }
        } else
            return false;

        $this->strValidationError = '';
        return true;
    }

    /**
     * Magic method to get the value of a property.
     *
     * @param string $strName The name of the property to retrieve.
     *
     * @return mixed The value of the requested property.
     * @throws DateMalformedStringException
     * @throws Caller If the requested property does not exist or cannot be accessed.
     */
    public function __get(string $strName): mixed
    {
        switch ($strName) {
            case 'DateTime': return self::ParseForTimeValue($this->Text);
            case 'LabelForInvalid': return $this->strLabelForInvalid;

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
     * Magic method to set the value of a property.
     *
     * @param string $strName The name of the property to set.
     * @param mixed $mixValue The value to assign to the property.
     *
     * @return void The set value of the property, if applicable.
     * @throws Caller If the requested property does not exist or cannot be set.
     * @throws InvalidCast If the provided value cannot be cast to the required type.
     */
    public function __set(string $strName, mixed $mixValue): void
    {
        switch ($strName) {
            case 'DateTime':
                try {
                    $dtt = Type::cast($mixValue, Type::DATE_TIME);
                    if ($dtt) {
                        $this->Text = $dtt->qFormat ("h:mm z");
                    } else {
                        $this->Text = '';
                    }
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

            case 'LabelForInvalid':
                try {
                    $this->strLabelForInvalid = Type::Cast($mixValue, Type::STRING);
                } catch (InvalidCast $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
                break;

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
}