<?php

namespace App\Presenters;

use Nette,
	App\Model;

use Nette\Application\BadRequestException;
use Nette\Application\ForbiddenRequestException;
use Nette\Application\UI\Form;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	public function renderDefault()
	{
	}

	/**
	 * TODO: use Nette way
	 * Prototype of save image
	 */
	public function actionSaveimage()
	{
		$response = array();
		/*
		if (!$this->user->isAllowed('Article', 'edit')) {
			$response['error'] = 'Error access denied!';
			$this->sendJson($response);
		}
		*/

		$uploadFolder = __DIR__ . '/../../www/data/articles/';
		$onlinePath = '/data/articles/';

		if (isset($_FILES['file'])) {
			$file = $_FILES['file'];
			$filename = uniqid() . '.' . (pathinfo($file['name'], PATHINFO_EXTENSION) ? : 'png');

			move_uploaded_file($file['tmp_name'], $uploadFolder . $filename);

			$response['filename'] = $onlinePath . $filename;
		} else {
			$response['error'] = 'Error while uploading file';
		}

		$this->sendJson($response);
	}


	/**
	 * Article form factory.
	 *
	 * @return \Nette\Application\UI\Form
	 */
	protected function createComponentArticleForm()
	{
		$form = new Form;

		$form->addTextArea('content', 'Content:')
			->setRequired('Please enter content.');

		$form->addSubmit('send', 'Add article');

		$form->onSuccess[] = $this->articleFormSucceeded;

		return $form;
	}


	/**
	 * @param Form $form
	 * @throws ForbiddenRequestException
	 */
	public function articleFormSucceeded(Form $form, $values)
	{
		/*
		if (!$this->user->isAllowed('Article', 'edit')) {
			throw new ForbiddenRequestException();
		}
		*/

		dump($values);
		exit();

	}

}
