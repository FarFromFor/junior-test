<?php

namespace App\Form;

use Nette\Application\UI\Form;
use Nette\Database\Explorer;

class FormFactory
{
    public function __construct(
        private Explorer $explorer,
    )
    {
    }

    public function createForm(): Form
    {
        $form = new Form;

        $form->addText('fullName', 'Full Name:')
            ->setRequired('Insert name')
            ->setHtmlAttribute('placeholder', 'Aleksandr...');

        $form->addEmail('email', 'E-mail:')
            ->setRequired('Insert email')
            ->addRule(function ($email) {
                return !$this->explorer->table('user')->where('email', $email->value)->fetch();
            }, 'User with such e-mail already exists.')
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