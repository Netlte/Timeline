<?php declare(strict_types = 1);

namespace Netlte\Timeline;

use Netlte\UI\AbstractControl;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/timeline
 * @copyright    Copyright © 2025, Tomáš Holan [www.holan.dev]
 */
class TimeLabel extends AbstractControl {

    public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'time_label.latte';

	public static string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	private \DateTimeInterface $datetime;
    private string $format;
	private string $color;

	
	public function __construct(\DateTimeInterface $datetime, string $format = 'd.m.Y', string $color = 'red') {
		$this->datetime = $datetime;
        $this->format = $format;
        $this->color = $color;
	}

	public function render(): void {
		$this->getTemplate()->datetime = $this->getDatetime();
		$this->getTemplate()->format = $this->getFormat();
		$this->getTemplate()->color = $this->getColor();;

		$this->getTemplate()->setTranslator($this->getTranslator() ?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	public function getDatetime(): \DateTimeInterface {
		return $this->datetime;
	}

	public function setDatetime(\DateTimeInterface $datetime): self {
		$this->datetime = $datetime;
		return $this;
	}

    public function getFormat(): string {
        return $this->format;
    }

    public function setFormat(string $format): self {
        $this->format = $format;
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