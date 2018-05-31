<?php
class bbcode {
	public static function nl2br($var) {
		return str_replace(['\\r\\n','\r\\n','r\\n','\r\n', '\n', '\r'], '<br>', nl2br($var));
	}

	public static function tohtml($text, $charset = 'UTF-8') {
		$bbcode = [
			"#\[b\](.*?)\[/b\]#si",
			"#\[i\](.*?)\[/i\]#si",
			"#\[u\](.*?)\[/u\]#si",
			"#\[u\](.*?)\[/u\]#si",
			"#\[ul\](.*?)\[/ul\]#si",
			"#\[li\](.*?)\[/li\]#si",
			"#\[ol\](.*?)\[/ol\]#si",
			"#\[center\](.*?)\[/center\]#si",
			"#\[left\](.*?)\[/left\]#si",
			"#\[right\](.*?)\[/right\]#si",

			'#\[color=([a-zA-Z]*|\#?[0-9a-fA-F]{3,6})](.+)\[/color\]#Usi',
			'#\[size=([0-9][0-9]?)](.+)\[/size\]#Usi',
			'#\[quote](\r\n)?(.+?)\[/quote]#si',
			'#\[quote=(.*?)](\r\n)?(.+?)\[/quote]#si',
			'#\[url](.+)\[/url]#Usi',
			'#\[url=(.+)](.+)\[/url\]#Usi',
			'#\[email]([\w\.\-]+@[a-zA-Z0-9\-]+\.?[a-zA-Z0-9\-]*\.\w{1,4})\[/email]#Usi',
			'#\[email=([\w\.\-]+@[a-zA-Z0-9\-]+\.?[a-zA-Z0-9\-]*\.\w{1,4})](.+)\[/email]#Usi',
			'#\[img](.+)\[/img]#Usi',
			'#\[img=(.+)](.+)\[/img]#Usi',
			'#\[code](\r\n)?(.+?)(\r\n)?\[/code]#si',
			'#\[youtube]http://[a-z]{0,3}.youtube.com/watch\?v=([0-9a-zA-Z]{1,11})\[/youtube]#Usi',
			'#\[youtube]([0-9a-zA-Z]{1,11})\[/youtube]#Usi'
		];

		$html = [
			'<b>\\1</b>',
			'<i>\\1</i>',
			'<u>\\1</u>',
			'<s>\\1</s>',
			'<ul>\\1</ul>',
			'<li>\\1</li>',
			'<ol>\\1</ol>',
			'<div style="text-align: center;">\\1</div>',
			'<div style="text-align: left;">\\1</div>',
			'<div style="text-align: right;">\\1</div>',

			'<span class="bb-color" style="color: $1;">$2</span>',
			'<span class="bb-size" style="font-size: $1px;">$2</span>',
			'<div class="bb-quote" style="font-style:italic"><span class="bb-quoteby">Cytat</span>\r\n$2</div>',
			'<div class="bb-quote" style="font-style:italic"><span class="bb-quoteby">Cytat <b>$1</b>:</span>\r\n$3</div>',
			'<a class="bb-link" rel="nofollow" target="_blank" href="$1">$1</a>',
			'<a class="bb-link" rel="nofollow" target="_blank" href="$1">$2</a>',
			'<a class="bb-link" href="mailto:$1">$1</a>',
			'<a class="bb-link" href="mailto:$1">$2</a>',
			'<img class="bb-img" src="$1" alt="$1">',
			'<img class="bb-img" src="$1" alt="$2">',
			'<code class="bb-code">$2</code>',
			'<iframe class="bb-ytplayer" width="640" height="360" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen>',
			'<iframe class="bb-ytplayer" width="640" height="360" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen>'
		];

		if(count($bbcode) != count($html)) return false;

		$text  = htmlspecialchars($text, ENT_QUOTES, $charset);
		$text = preg_replace($bbcode, $html, $text);

		return BBCode::nl2br($text);
	}

	public static function remove($text) {
		return strip_tags(str_replace(array('[',']'), array('<','>'), $text));
	}
}
