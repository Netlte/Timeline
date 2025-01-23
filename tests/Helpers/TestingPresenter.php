<?php declare(strict_types = 1);

namespace Netlte\Timeline\Tests\Helpers;

use Netlte\Timeline\Timeline;
use Nette\Application\UI\Presenter;

final class TestingPresenter extends Presenter {

	protected function createComponentTimeline(): Timeline {
		return new Timeline();
	}
}