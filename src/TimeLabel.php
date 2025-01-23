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

	public \DateTimeInterface $datetime;
    public string $format;
    public string $color;

	
	public function __construct(\DateTimeInterface $datetime, string $format = 'd.m.Y', string $color = 'red') {
		$this->datetime = $datetime;
        $this->format = $format;
        $this->color = $color;
	}

	public function render(): void {
		$this->getTemplate()->datetime = $this->datetime;
		$this->getTemplate()->format = $this->format;
		$this->getTemplate()->color = $this->color;

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile()?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}


}