<?php

declare(strict_types=1);

namespace App\UI\Home;

use App\Form\UserFormData;
use App\Form\FormFactory;
use App\Service\UserService;
use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;

final class HomePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private Explorer    $explorer,
        private FormFactory $formFactory,
        private UserService $userService
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
        $form = $this->formFactory->createUserForm();
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    public function formSucceeded(Form $form, UserFormData $data): void
    {
        $this->userService->save($data);
//        $this->flashMessage('Success');
        $this->redirect('default');
    }
}
