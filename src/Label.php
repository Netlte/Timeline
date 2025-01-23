<?php declare(strict_types = 1);

namespace Netlte\Timeline;

use Netlte\UI\AbstractControl;
use Nette\HtmlStringable;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/timeline
 * @copyright    Copyright © 2025, Tomáš Holan [www.holan.dev]
 */
class Label extends AbstractControl {

    public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'time_label.latte';

	public static string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

    /** @var HtmlStringable|\Stringable|string $text */
	private $text;

	private string $color = 'red';


    /**
     * @param HtmlStringable|\Stringable|string $text
     */
	public function __construct($text) {
		$this->text = $text;
	}

	public function render(): void {
		$this->getTemplate()->text = $this->getText();
		$this->getTemplate()->color = $this->getColor();;

		$this->getTemplate()->setTranslator($this->getTranslator() ?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	public function getText() {
		return $this->text;
	}

    /**
     * @param HtmlStringable|\Stringable|string $text
     */
	public function setText($text): self {
		$this->text = $text;
		return $this;
	}

	public function getColor(): string {
		return $this->color;
	}

	public function setColor(string $color): self {
		$this->color = $color;
		return $this;
	}


}