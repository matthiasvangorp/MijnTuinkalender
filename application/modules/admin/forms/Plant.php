<?php
class Application_Form_Plant extends Zend_Form
{
    public function init()
    {
        $this->setName('plant');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $naam = new Zend_Form_Element_Text('naam');
        $naam->setLabel('Naam')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        $beschrijving = new Zend_Form_Element_Textarea('beschrijving');
        $beschrijving->setLabel('Beschrijving')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        $kiemingsduur = new Zend_Form_Element_Textarea('kiemingsduur');
        $kiemingsduur->setLabel('Kiemingsduur')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        $teeltduur = new Zend_Form_Element_Textarea('teeltduur');
        $teeltduur->setLabel('Teeltduur')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        $begieten = new Zend_Form_Element_Textarea('begieten');
        $begieten->setLabel('Begieten')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        $opbrengst = new Zend_Form_Element_Textarea('opbrengst');
        $opbrengst->setLabel('Opbrengst')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
		
        $this->addElements(array($id, $naam, $beschrijving, $kiemingsduur,$teeltduur, $begieten, $opbrengst, $submit)); }
}