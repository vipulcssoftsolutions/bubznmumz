<?php

namespace ElementsKit\Modules\Widget_Builder\Controls;

defined('ABSPATH') || exit;

class Control_Type_Border extends CT_Base {

	public function start_writing_conf($file_handler, $conf) {

		$ret = '';

		if(!empty($conf->label)) {
			$ret .= "\t\t\t\t" . '\'label\' => esc_html( \'' . esc_html($conf->label) . '\' ),' . PHP_EOL;
		}

		if(!empty($conf->description)) {
			$ret .= "\t\t\t\t" . '\'description\' =>  esc_html( \'' . esc_html($conf->description) . '\' ),' . PHP_EOL;
		}

		if(!empty($conf->separator)) {
			$ret .= "\t\t\t\t" . '\'separator\' => \'' . esc_html($conf->separator) . '\' ,' . PHP_EOL;
		}

		if(!empty($conf->selector)) {
			$selectorProperty = str_replace(',', ', {{WRAPPER}} ', esc_html($conf->selector));
			$ret .= "\t\t\t\t" . '\'selector\' => \'{{WRAPPER}} ' . $selectorProperty . '\' ,' . PHP_EOL;
		}

		if(!empty($conf->classes)) {
			$ret .= "\t\t\t\t" . '\'classes\' => \'' . esc_html($conf->classes) . '\' ,' . PHP_EOL;
		}

		if(isset($conf->show_label)) {
			$ret .= "\t\t\t\t" . '\'show_label\' => ' . ($conf->show_label == 1 ? 'true' : 'false') . ' ,' . PHP_EOL;
		}

		if(isset($conf->label_block)) {
			$ret .= "\t\t\t\t" . '\'label_block\' => ' . ($conf->label_block == 1 ? 'true' : 'false') . ' ,' . PHP_EOL;
		}

		$ret .= "\t\t\t\t" . '\'exclude\' => [],' . PHP_EOL;

		return $ret;
	}
}
