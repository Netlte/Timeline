<?php declare(strict_types = 1);

namespace Netlte\Timeline;

use Netlte\Timeline\Exceptions\InvalidArgumentException;
use Netlte\UI\AbstractControl;
use Nette\HtmlStringable;
use Nette\Utils\Html;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/timeline
 * @copyright    Copyright © 2025, Tomáš Holan [www.holan.dev]
 */
class Item extends AbstractControl {

    public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'item.latte';
    public const DEFAULT_ICON_PREFIX = 'fa fa-';

    public static string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

    public static string $ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

    public string $icon = 'circle';

    public string $color = 'blue';

    public ?\DateTime $datetime = null;

	/** @var HtmlStringable|\Stringable|string|null */
	private $title = null;

	
	public function __construct(string $icon = 'circle', string $color = 'blue', ?\DateTime $datetime = null) {
		$this->icon = $icon;
		$this->color = $color;
		$this->datetime = $datetime;
	}

	public function render(): void {
		$this->getTemplate()->datetime = $this->getDatetime();
		$this->getTemplate()->icon = $this->getIcon();
		$this->getTemplate()->color = $this->getColor();
		$this->getTemplate()->title = $this->getTitle();
		$this->getTemplate()->icon_prefix = self::$ICON_PREFIX;

		$this->getTemplate()->setTranslator($this->getTranslator() ?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	/**
	 * @return HtmlStringable|\Stringable|null|string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param HtmlStringable|\Stringable|null|string $title
	 */
	public function setTitle($title): self {
		if ($title instanceof HtmlStringable || $title instanceof \Stringable || $title === null) {
			$this->title = $title;
		} elseif (\is_scalar($title)) {
			$this->title = (string) $title;
		} else {
			throw new InvalidArgumentException(
				\sprintf(
					'Method %s expect Argument 1 as NULL, scalar or %s, %s given.',
					__METHOD__,
					Html::class,
					\is_object($title) ? \get_class($title) : \gettype($title)
				)
			);
		}

		return $this;
	}


}