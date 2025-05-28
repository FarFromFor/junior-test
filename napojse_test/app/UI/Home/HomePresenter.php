<?php

declare(strict_types=1);

namespace App\UI\Home;

use App\Form\RegistrationForm;
use App\Service\UserService;
use Nette;
use Nette\Database\Explorer;

final class HomePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private Explorer         $explorer,
        private UserService     $userService,
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

    protected function createComponentRegistrationForm(): RegistrationForm
    {
        return new RegistrationForm($this->userService);
    }

}
