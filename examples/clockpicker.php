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
    protected $clockpicker;

    protected $label1;

    protected function formCreate()
    {
        $this->label = new Bs\Label($this);
        $this->label->setCssStyle('display', 'inline;');
        
        $this->clockpicker = new Q\Plugin\ClockPicker($this);
        $this->clockpicker->ActionParameter = $this->clockpicker->ControlId;
        $this->clockpicker->addAction(new Change(), new Ajax('setTime'));
    }

    protected function setTime(ActionParams $params)
    {
         $objControlToLookup = $this->getControl($params->ActionParameter);
        $dttDateTime = $objControlToLookup->DateTime;
        
        $this->label->Text = $dttDateTime->qFormat('hhhh:mm:ss');
    }



}
ExamplesForm::Run('ExamplesForm');
