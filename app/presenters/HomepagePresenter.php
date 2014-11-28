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
	use \Brabijan\Images\TImagePipe;

	/**
	 * @inject
	 * @var \Brabijan\Images\ImageStorage
	 */
	public $imageStorage;

	/**
	 * @var Nette\Http\IRequest
	 * @inject
	 */
	public $httpRequest;


	public function actionDefault()
	{

	}

	/**
	 * Prototype of save image
	 */
	public function handleSaveImage()
	{
		$this->imageStorage->setNamespace("articles");
		$onlinePath = '/data/articles/';

		$response = array();
		/*
		if (!$this->user->isAllowed('Article', 'edit')) {
			$response['error'] = 'Error access denied!';
			$this->sendJson($response);
		}
		*/

		/** @var Nette\Http\FileUpload $file */
		if($file = $this->httpRequest->getFile('file')) {
			$filename = uniqid() . '.' . (pathinfo($file->name, PATHINFO_EXTENSION) ? : 'png');
			$this->imageStorage->save($file->getContents(), $filename);
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
