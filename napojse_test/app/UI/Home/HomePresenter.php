<?php

declare(strict_types=1);

namespace App\UI\Home;

use App\Form\FormData;
use App\Form\FormFactory;
use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;
use Nette\Security\Passwords;

final class HomePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private Explorer    $explorer,
        private FormFactory $formFactory,
        private Passwords   $passwords,
    )
    {
        parent::__construct();
    }

    public function renderDefault(): void
    {
        $this->template->users = $this->explorer->table('user')->fetchAll();
    }

    public function renderCreate(): void
    {
    }

    protected function createComponentRegistrationForm(): Form
    {
        $form = $this->formFactory->createForm();
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    public function formSucceeded(Form $form, FormData $data): void
    {
        $this->explorer->table('user')->insert([
            'full_name' => $data->fullName,
            'email' => $data->email,
            'password' => $this->passwords->hash($data->password),
        ]);

        $this->redirect('default');
    }
}
