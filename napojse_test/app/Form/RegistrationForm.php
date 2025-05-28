<?php

namespace App\Form;

use App\Service\UserService;
use Nette\Application\UI\Form;
use Nette\Application\UI\Control;

class RegistrationForm extends Control
{
    public function __construct(
        private UserService $userService
    )
    {
    }

    public function render(): void
    {
        $this->template->render(__DIR__ . '/registrationForm.latte');
    }

    public function createComponentForm(): Form
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

        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    public function formSucceeded(Form $form, UserFormData $data): void
    {
        $this->userService->save($data);
        $this->getPresenter()->redirect('default');
    }
}