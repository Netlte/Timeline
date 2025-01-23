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
class Label extends AbstractControl {

    public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'time_label.latte';

	public static string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

    /** @var HtmlStringable|\Stringable|string $text */
	private $text;

	public string $color = 'red';


    /**
     * @param HtmlStringable|\Stringable|string $text
     */
	public function __construct($text, string $color = 'red') {
		$this->text = $text;
        $this->color = $color;
	}

	public function render(): void {
		$this->getTemplate()->text = $this->getText();
		$this->getTemplate()->color = $this->color;

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile() ?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}

	public function getText() {
		return $this->text;
	}

    /**
     * @param HtmlStringable|\Stringable|string $text
     */
	public function setText($text): self {
        if ($text instanceof HtmlStringable || $text instanceof \Stringable || $text === null) {
            $this->text = $text;
        } elseif (\is_scalar($text)) {
            $this->text = (string) $text;
        } else {
            throw new InvalidArgumentException(
                \sprintf(
                    'Method %s expect Argument 1 as NULL, scalar or %s, %s given.',
                    __METHOD__,
                    Html::class,
                    \is_object($text) ? \get_class($text) : \gettype($text)
                )
            );
        }

        return $this;
	}


}