<?php
require('qcubed.inc.php');

use QCubed as Q;
use QCubed\Bootstrap as Bs;
use QCubed\Exception\Caller;
use QCubed\Project\Control\FormBase as Form;
use QCubed\Action\ActionParams;
use QCubed\Action\Ajax;
use QCubed\Event\Change;

class ExamplesForm extends Form
{
    protected Q\Plugin\ClockPicker $clockpicker1;
    protected Q\Plugin\ClockPicker $clockpicker2;

    protected Bs\Label $label1;
    protected Bs\Label $label2;

    /**
     * Initializes the form by creating and configuring UI elements such as labels
     * and clock pickers. The labels are styled for inline display, and two clock
     * pickers are added with different configurations, including actions triggered
     * on value changes.
     *
     * @return void
     * @throws Caller
     */
    protected function formCreate(): void
    {
        $this->label1 = new Bs\Label($this);
        $this->label1->setCssStyle('display', 'inline;');

        $this->label2 = new Bs\Label($this);
        $this->label2->setCssStyle('display', 'inline;');

        $this->clockpicker1 = new Q\Plugin\ClockPicker($this);
        $this->clockpicker1->AutoClose = true;
        $this->clockpicker1->Default = 'now';
        //$this->clockpicker1->Text = '17:35';
        $this->clockpicker1->addAction(new Change(), new Ajax('setTime_1'));
        $this->clockpicker1->ActionParameter = $this->clockpicker1->ControlId;

        $this->clockpicker2 = new Q\Plugin\ClockPicker($this);
        $this->clockpicker2->DoneText = t('Done');
        $this->clockpicker2->AutoClose = false;
        $this->clockpicker2->TwelveHour = true;
        $this->clockpicker2->addAction(new Change(), new Ajax('setTime_2'));
        $this->clockpicker2->ActionParameter = $this->clockpicker2->ControlId;
    }

    /**
     * Updates the text of a label with a formatted time string based on the DateTime value
     * retrieved from a control determined by the action parameters.
     *
     * @param ActionParams $params The action parameters containing information to identify the control.
     *
     * @return void
     */
    protected function setTime_1(ActionParams $params): void
    {
        $objControlToLookup = $this->getControl($params->ActionParameter);
        $dttDateTime = $objControlToLookup->DateTime;

        $this->label1->Text = 'Time: ' . $dttDateTime->qFormat('hhhh:mm:ss');
    }

    /**
     * Updates the text of the label to display the formatted time based on the DateTime value
     * of the control referenced by the provided action parameter.
     *
     * @param ActionParams $params Collection of parameters including the action parameter
     *                              used to identify the target control.
     *
     * @return void
     */
    protected function setTime_2(ActionParams $params): void
    {
        $objControlToLookup = $this->getControl($params->ActionParameter);
        $dttDateTime = $objControlToLookup->DateTime;

        $this->label2->Text = 'Time: ' . $dttDateTime->qFormat('hhhh:mm:ss');
    }
}
ExamplesForm::run('ExamplesForm');