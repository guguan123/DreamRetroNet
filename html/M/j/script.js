// 核心工具模块
// 类css选择器选择工具 - by BOOK_思义
var closeWelcomeMessage = "close BOOKsy\'s Js-App Welcome Message";
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(m(b,c){n a={o:"\\4\\1\\1\\8\\g\\h\\i",5:{o:"\\I \\4\\1\\1\\8\\g\\h\\i \\p\\q\\r \\s\\t\\j\\u\\9\\9 ",J:" \\K \\k\\L\\9\\v\\M\\N\\w\\O\\x \\l\\P\\l\\l \\4\\v \\4\\1\\1\\8\\g\\h\\i"}};a.5.$3=m(d,e){n f=y==z?A:y;Q e&&"R"==e.B()?f.S(d):f.T(d)};a.5.$3.U="2.0";a.5.$3.C=" \\V\\W\\X\\Y\\4\\1\\1\\8\\g\\h\\i\\p\\q\\r \\s\\t\\j\\u\\9\\9\\Z \\10\\11\\12\\13\\14\\15\\16\\17 \\j \\18\\w\\19\\x\\6";b.$3=b.A.$3=b.1a.1b.$3=a.5.$3;b.$3.1c=a;(c&&"\\k\\D\\1\\7\\6 \\4\\1\\1\\8\\7\\1d\\1e\\7 \\1f\\7\\j\\E\\F\\F \\1g\\6\\D\\k\\1\\G\\6 \\G\\6\\7\\7\\E\\1h\\6"==c.B())||1i.1j(a.5.$3.C)})(z,H?H:1k 0);',62,83,'|x4f||getE|x42|APPs|x45|x53|x4b|x70|||||||x5f|u601d|u4e49|x2d|x43|x32|function|var|name|u5f00|u53d1|u7684|x6a|x73|x61|x79|x67|x74|this|window|document|toUpperCase|welcome|x4c|x41|x50|x4d|closeWelcomeMessage|u7531|info|xa9|x6f|x72|x69|x68|x30|return|ALL|querySelectorAll|querySelector|version|u6b22|u8fce|u4f7f|u7528|x3a|u94fe|u5f0f|u5feb|u901f|u9009|u62e9|u5de5|u5177|x24|x65|HTMLElement|prototype|about|x59|x27|x4a|x57|x47|console|log|void'.split('|'),0,{}));



// Header Module
(function(winObj) {
	// Global
	var all = "all";
	
	
	
	// Menu Module
	// - menu close control func
	function closeMenu() {
		var bgCover = $getE(".bg-cover");
		bgCover.style.display = "none";
		bgCover.removeEventListener("click", closeMenu);
		$getE(".header").classList.remove("hide-in-top");
		$getE(".menu").style.right = "-286px";
	}
	// - menu open control
	$getE(".menu-btn-open").addEventListener("click", function(){
		$getE(".bg-cover").style.display = "block";
		$getE(".header").classList.add("hide-in-top");
		$getE(".menu").style.right = "0px";
		$getE(".bg-cover").addEventListener("click", closeMenu);
	});
	// - menu close control
	$getE(".menu .menu-btn-close").addEventListener("click", closeMenu);
	
	
	
	// Search Module
	// - search close control func
	function closeSearch() {
		// funcMark1 - 可选开启的功能
		// var bgCover = $getE(".bg-cover");
		// bgCover.style.display = "none";
		// bgCover.removeEventListener("click", closeSearch);
		$getE(".header").classList.remove("hide-in-top");
		$getE(".search").classList.remove("show-on-top");
	}
	// - search open control
	$getE(".search-btn-open").addEventListener("click", function() {
		// funcMark1 - 可选开启的功能
		// $getE(".bg-cover").style.display = "block";
		$getE(".header").classList.add("hide-in-top");
		$getE(".search").classList.add("show-on-top");
		$getE(".bg-cover").addEventListener("click", closeSearch);
	});
	// - search close control
	$getE(".search .search-btn-close").addEventListener("click", closeSearch);
	
	
	
	// Media Response Event
	// - search event
	$getE(".search form input[type=text]").addEventListener("focusin", function() {
		this.parentNode.parentNode.classList.add("focusin");
	});
	$getE(".search form input[type=text]").addEventListener("focusout", function() {
		this.parentNode.parentNode.classList.remove("focusin");
	});
	
})(window);



// Main Module - 暂无js操控
// (function(winObj) {
// 	// Global
// 	var all = "all";
	
// })(window);