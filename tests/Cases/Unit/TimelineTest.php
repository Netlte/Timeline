<?php declare(strict_types = 1);

namespace Netlte\Timeline\Tests\Cases\Unit;

use Netlte\Boxes\Tests\Helpers\PresenterFactory;
use Netlte\Boxes\Tests\Helpers\TestingTemplateFactory;
use Netlte\Timeline\Exceptions\InvalidArgumentException;
use Netlte\Timeline\Item;
use Netlte\Timeline\Timeline;
use Nette\ComponentModel\IComponent;
use Nette\HtmlStringable;
use Nette\Utils\Html;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class TimelineTest extends TestCase {

	/** @var Timeline|IComponent|null */
	private $timeline;

	public function setUp(): void {
		$factory = new PresenterFactory();
		$presenter = $factory->create();
		$this->timeline = $presenter->getComponent('timeline');
	}

	public function testRender(): void {
		/** @var Timeline $timeline */
		$timeline = $this->timeline;

		$timeline->setTemplateFactory(new TestingTemplateFactory());

		\ob_start();
		$timeline->render();
		$result = \ob_get_clean();

		Assert::equal('TestingTemplate', $result);
	}

    public function testItem(): void {
        /** @var Timeline $timeline */
        $timeline = $this->timeline;

        $item = new Item();
        $item->setTitle('test');
        Assert::equal('test', $item->getTitle());

        $item->setTitle(null);
        Assert::null($item->getTitle());

        $title = new class implements \Stringable {
            public function __toString(): string {
                return 'stringable';
            }
        };

        $item->setTitle($title);
        Assert::true($item->getTitle() instanceof \Stringable);
        Assert::equal('stringable', (string) $item->getTitle());

        $item->setTitle(Html::el('span')->setText('test'));
        Assert::true($item->getTitle() instanceof HtmlStringable);
        Assert::equal('<span>test</test>', (string) $item->getTitle());

        $e = null;
        try {
            $item->setTitle(new \stdClass()); // @phpstan-ignore-line(
        } catch (InvalidArgumentException $e) {
        }

        Assert::notNull($e);

    }

}

(new TimelineTest())->run();