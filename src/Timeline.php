<?php declare(strict_types = 1);

namespace Netlte\Timeline;

use Netlte\UI\AbstractControl;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/timeline
 * @copyright    Copyright © 2025, Tomáš Holan [www.holan.dev]
 *
 * TODO: Finish all TODOs
 * TODO: Write Docs
 * TODO: Finish CI/CD
 */
class Timeline extends AbstractControl {

    public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'timeline.latte';
    public const DEFAULT_ICON_PREFIX = 'fa fa-';

	public static string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

    public static string $ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	public function __construct() {
	}

	public function render(): void {
        $this->getTemplate()->icon_prefix = self::$ICON_PREFIX;

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile() ?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}
}