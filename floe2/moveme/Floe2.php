<?php
/**
 * Floe2
 *
 * @file
 * @ingroup Skins
 */

if( !defined( 'MEDIAWIKI' ) )
	die( -1 );

/** */
require_once( dirname(__FILE__) . '/MonoBook.php' );

class Floe2Template extends QuickTemplate {
	/**
	 * Template filter callback for this skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 */
	public function execute() {
		global $wgUser, $wgSitename;
        $skin = $wgUser->getSkin();

		// suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();
 
		$this->html( 'headelement' );
?>

        <div id="out-of-the-box" class="fl-uiOptions-fatPanel">        
            <div id="myUIOptions" class="flc-slidingPanel-panel flc-uiOptions-iframe"></div>     
            <div class="fl-panelBar">
                <button class="flc-slidingPanel-toggleButton fl-toggleButton">Show/Hide</button>
            </div>
        </div> 	
 
        
        <!-- This div tell the page enhancer where to place a Table of Contents -->
        <div class="flc-toc-tocContainer"> </div>

	<div id="jump-links">
		<?php if( $this->data['showjumplinks'] ) { ?><?php $this->msg('jumpto') ?> <a href="#site-toc">Table of Contents</a>, <a href="#tocontent">Content</a><?php } ?>
	</div>
	<div id="header">
		<h1><?php $this->msg('tagline') ?></h1>
		<div id="top-links">
			<a href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href']); ?>" id="logo"><img src="<?php echo htmlspecialchars($this->data['logopath']); ?>" alt="floe logo" /></a>
			
			<span class="links-header">User Links:</span>
			<ul id="user-links">
			<?php foreach($this->data['personal_urls'] as $key => $item) { ?>
				<li id="<?php echo Sanitizer::escapeId( "pt-$key" ) ?>"<?php if ($item['active']) { ?> class="active"<?php } ?>>
				<a href="<?php echo htmlspecialchars( $item['href'] ) ?>"<?php echo $skin->tooltipAndAccesskey('pt-'.$key) ?>
				<?php if( !empty( $item['class'] ) ) { ?> class="<?php echo htmlspecialchars( $item['class'] ) ?>"<?php } ?>><?php echo htmlspecialchars( $item['text'] ) ?></a></li>
			<?php } ?>

			</ul>

		</div>	

	</div>
		
	<div id="site-toc">
		<h2>Table of Contents</h2>
		<a name="site-toc"></a><ul>
		<?php 
		//$pages = array("Introduction", "Why is this important?", "Who is this for?", "What is the approach?", "Techniques", "Your answers and input", "Evolving research" );
		foreach($pages as $page) { 
			echo "<li><a href='/index.php?title=".str_replace(' ','_',$page)."'>".$page."</a></li>";
		} ?>
		</ul>
	</div>

	<div id="container">		
		
		<div id="content">
			<span class="links-header">Page Links:</span>
			<ul id="page-links"><?php
			foreach( $this->data['content_actions'] as $key => $tab ) { 
				echo '<li id="', Sanitizer::escapeId( "ca-$key" ), '"';
				if ( $tab['class'] ) {
					echo ' class="', htmlspecialchars($tab['class']), '"';
				}
				echo '><a href="', htmlspecialchars($tab['href']), '"', $skin->tooltipAndAccesskey('ca-'.$key), '>', htmlspecialchars($tab['text']), '</a></li>';
			}?>
			</ul>
		
			<h2><?php $this->html('title'); ?></h2>
			<?php $this->html('bodytext') ?>
		</div>
		
		<div id="footer">         
           FLOE is funded by a grant from <a href="http://www.hewlett.org" class="external text" rel="nofollow">The William and Flora Hewlett Foundation</a>.
        </div>
	</div>


        <script type="text/javascript" src="<?php global $wgScriptPath; echo $wgScriptPath; ?>/skins/floe2/infusion/lib/jquery/core/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/lib/jquery/ui/js/jquery.ui.core.js"></script>   
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/lib/jquery/ui/js/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/lib/jquery/ui/js/jquery.ui.mouse.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/lib/jquery/ui/js/jquery.ui.slider.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/lib/json/js/json2.js"></script>
 
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/framework/core/js/Fluid.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/framework/core/js/FluidRequests.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/framework/core/js/FluidDOMUtilities.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/framework/core/js/DataBinding.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/framework/core/js/FluidIoC.js"></script>
		<script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/lib/fastXmlPull/js/fastXmlPull.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/framework/renderer/js/fluidParser.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/framework/renderer/js/fluidRenderer.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/framework/renderer/js/RendererUtilities.js"></script>

		<script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/components/uiOptions/js/URLUtilities.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/components/uiOptions/js/Store.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/components/uiOptions/js/UIEnhancer.js"></script>
		<script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/components/uiOptions/js/UIOptions.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/components/uiOptions/js/FatPanelUIOptions.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/components/uiOptions/js/SlidingPanel.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/components/tabs/js/Tabs.js"></script>
        <script type="text/javascript" src="<?php echo $wgScriptPath; ?>/skins/floe2/infusion/components/tableOfContents/js/TableOfContents.js"></script>


       <script type="text/javascript">
			var demo = demo || {};

			// Define the functions that will be used by the demo
			(function ($, fluid) {
				demo.initPageEnhancer = function () {
					fluid.pageEnhancer({
						// Tell UIEnhancer where to find the table of contents' template URL
						tocTemplate: "<?php  global $wgScriptPath; echo $wgScriptPath; ?>/skins/floe2/infusion/components/tableOfContents/html/TableOfContents.html"
					});
				};
				
				demo.initUIOptions = function () {
					fluid.uiOptions.fatPanel("#out-of-the-box", {
						// Tell UIOptions where to find all the templates, relative to this file
						prefix: "<?php global $wgScriptPath; echo $wgScriptPath; ?>/skins/floe2/infusion/components/uiOptions/html/"
						
					});
				};    
			})(jQuery, fluid);
        </script>


		<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>

        <script type="text/javascript">
            // Initialize the page enhancer right away
            demo.initPageEnhancer();
        </script>
        <script type="text/javascript">
            demo.initUIOptions();
        </script>
		</body>
		</html>
		<?php
		wfRestoreWarnings();
	} // end of execute() method
} // end of class


/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @ingroup Skins
 */
class SkinFloe2 extends SkinTemplate {
	var $skinname = 'floe2', $stylename = 'floe2',
	$template = 'Floe2Template', $useHeadElement = true;

	function setupSkinUserCss( OutputPage $out ){
		parent::setupSkinUserCss( $out );
	$out->addStyle( 'floe2/main.css', 'screen' );
		$out->addStyle( 'floe2/rtl.css', '', '', 'rtl' );

		$out->addStyle( 'floe2/IE50Fixes.css', 'screen', 'lt IE 5.5000' );
		$out->addStyle( 'floe2/IE55Fixes.css', 'screen', 'IE 5.5000' );
		$out->addStyle( 'floe2/IE60Fixes.css', 'screen', 'IE 6' );
		$out->addStyle( 'floe2/IE70Fixes.css', 'screen', 'IE 7' );

		$out->addStyle( 'floe2/rtl.css', 'screen', '', 'rtl' );

        $out->addStyle( 'floe2/infusion/framework/fss/css/fss-layout.css');
        $out->addStyle( 'floe2/infusion/framework/fss/css/fss-text.css');
        $out->addStyle( 'floe2/infusion/components/uiOptions/css/fss/fss-theme-bw-uio.css');
        $out->addStyle( 'floe2/infusion/components/uiOptions/css/fss/fss-theme-wb-uio.css');
        $out->addStyle( 'floe2/infusion/components/uiOptions/css/fss/fss-theme-by-uio.css');
        $out->addStyle( 'floe2/infusion/components/uiOptions/css/fss/fss-theme-yb-uio.css');
        $out->addStyle( 'floe2/infusion/components/uiOptions/css/fss/fss-text-uio.css');
        $out->addStyle( 'floe2/infusion/lib/jquery/ui/css/fl-theme-by/by.css');
        $out->addStyle( 'floe2/infusion/lib/jquery/ui/css/fl-theme-yb/yb.css');
        $out->addStyle( 'floe2/infusion/lib/jquery/ui/css/fl-theme-bw/bw.css');
        $out->addStyle( 'floe2/infusion/lib/jquery/ui/css/fl-theme-wb/wb.css');
        $out->addStyle( 'floe2/infusion/components/uiOptions/css/UIOptions.css');
        $out->addStyle( 'floe2/infusion/components/uiOptions/css/FatPanelUIOptions.css');

	}

	function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$this->skinname  = 'floe2';
		$this->stylename = 'floe2';
		$this->template  = 'Floe2Template';
	}

	function tocList($toc) {
		global $wgJsMimeType;

		return "<div id='toc'><h3>Contents</h3>".$toc."</ul></div><a name='tocontent'></a>";
	}
	
	function prevNextLink($dir) {
		$title = $this->mTitle;
		
		$pages = array("Introduction", "Why is this important?", "Who is this for?", "What is the approach?", "Techniques" );
		
		/* get list of high level pages from db */
		$dbr = &wfGetDB(DB_SLAVE);
        $pageTable = $dbr->tableName('page');			
		
		$loc = array_search($title, $pages);
		
		if ($title=="Table of Contents") {
			if ($dir=="previous")
				return false;
			else
				return "<a href='/index.php?title=Introduction'>Introduction</a>";
				
		} else if ($dir == "previous" && $loc>0) {
			return "<a href='/index.php?title=".str_replace(' ','_',$pages[$loc-1])."'>".$pages[$loc-1]."</a>";
			
		} else if ($dir == "next" && $loc+1<count($pages)) {
			return "<a href='/index.php?title=".str_replace(' ','_',$pages[$loc+1])."'>".$pages[$loc+1]."</a>";
			
		} else if ($dir == "current") {
			return "<a href='/index.php?title=".str_replace(' ','_',$pages[$loc])."'>".$pages[$loc]."</a>";
			
		} else {
			return false;
		}
	}
	
}
?>