<?php
		
define('LAYOUTPATH', dirname(dirname(__FILE__)) ."/layouts/" );


class Layout {
	
	public $base_url;


	public function init() {

		$CI = get_instance();

		$this->base_url = $CI->config->slash_item('base_url');

		$output = $CI->output->get_output();
		$title = (isset($CI->title)) ? $CI->title : '';
		$css = (isset($CI->css)) ? $this->createAssets($CI->css, ".css") : '';
		$js = (isset($CI->js)) ? $this->createAssets($CI->js, ".js") : '';



		if (isset($CI->layout) && !preg_match('/(.+).php$/', $CI->layout)) {
			$CI->layout .= '.php';
		} else {
			$CI->layout = 'default.php';
		}

		$layout = LAYOUTPATH . $CI->layout;

		if ($CI->layout !== 'default.php' && !file_exists($layout)) {
			if ($CI->layout != '.php') {
				show_error("You have specified a invalid layout: " . $CI->layout);
			}
		}		

		if (file_exists($layout)) {
			$layout = $CI->load->file($layout, true);

			$view = str_replace('{content_for_layout}', $output, $layout);

			$view = str_replace('{title_for_layout}', $title, $view);

			$view = str_replace('{css_for_layout}', $css, $view);

			$view = str_replace('{js_for_layout}', $js, $view);
		} else {
			$view = $output;
		}

		echo $view;

	}


	public function createAssets($script=null, $ext=".css") {
		$html = "";

		for ($i = 0; $i < count($script); $i++) {
			if ($ext == ".css") {
				$html .= '<link rel="stylesheet" type="text/css" href="'. $this->base_url . CSSPATH . $links[$i] . '.css" media="screen" />';
			} else {
				$html .= '<script type="text/javascript" src="'. $this->base_url . JSPATH . $links[$i] . '.css" />';
			}

		}

		return $html;

	}


}