<?php

namespace App\Form;

use Nette\Application\UI\Form;

class FormFactory
{
    public function __construct(
    )
    {
    }

    public function createUserForm(): Form
    {
        $form = new Form;

        $form->addText('fullName', 'Full Name:')
            ->setRequired('Insert name')
            ->setHtmlAttribute('placeholder', 'Aleksandr...');

        $form->addEmail('email', 'E-mail:')
            ->setRequired('Insert email')
            ->setHtmlAttribute('placeholder', 'myemail@example.com...');

        $form->addPassword('password', 'Password:')
            ->setRequired('Insert password');

        $form->addPassword('passwordVerify', 'Repeat password:')
            ->setRequired('Insert password again')
            ->addRule($form::Equal, 'Passwords are not the same', $form['password'])
            ->setOmitted();

        $form->addSubmit('send', 'Register');

        return $form;
    }
}