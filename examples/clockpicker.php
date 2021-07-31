<?php
require('qcubed.inc.php');

use QCubed as Q;
use QCubed\Bootstrap as Bs;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase as Form;
use QCubed\Action\ActionParams;
use QCubed\Action\Ajax;
use QCubed\Event\Change;
use QCubed\Project\Application;

class ExamplesForm extends Form
{
    protected $clockpicker1;
    protected $clockpicker2;

    protected $label1;
    protected $label2;

    protected function formCreate()
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
    protected $label1;
    protected $clockpicker;
    
    protected function formCreate()
    {
        $this->label = new Bs\Label($this);
        $this->label->setCssStyle('display', 'inline;');
        
        $this->clockpicker = new Q\Plugin\ClockPicker($this);
        $this->clockpicker->ActionParameter = $this->clockpicker->ControlId;
        $this->clockpicker->addAction(new Change(), new Ajax('setTime'));
    }

    protected function setTime_1(ActionParams $params)
    {
<<<<<<< HEAD
        $objControlToLookup = $this->getControl($params->ActionParameter);
        $dttDateTime = $objControlToLookup->DateTime;

        $this->label1->Text = 'Time: ' . $dttDateTime->qFormat('hhhh:mm:ss');
    }

    protected function setTime_2(ActionParams $params)
    {
        $objControlToLookup = $this->getControl($params->ActionParameter);
        $dttDateTime = $objControlToLookup->DateTime;

        $this->label2->Text = 'Time: ' . $dttDateTime->qFormat('hhhh:mm:ss');
=======
         $objControlToLookup = $this->getControl($params->ActionParameter);
        $dttDateTime = $objControlToLookup->DateTime;
        
        $this->label->Text = $dttDateTime->qFormat('hhhh:mm:ss');
>>>>>>> 5de2f9d61b98528f0f4f444e56cdcfb1baee00f3
    }
}
ExamplesForm::Run('ExamplesForm');