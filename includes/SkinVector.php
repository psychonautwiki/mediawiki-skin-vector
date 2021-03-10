<?php
/**
 * Vector - Modern version of MonoBook with fresh look and many usability
 * improvements.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup Skins
 */

use MediaWiki\MediaWikiServices;
use Vector\Constants;
use Wikimedia\WrappedString;

/**
 * Skin subclass for Vector
 * @ingroup Skins
 * @final skins extending SkinVector are not supported
 * @unstable
 */
class SkinVector extends SkinTemplate {
	public $skinname = Constants::SKIN_NAME;
	public $stylename = 'Vector';
	public $template = 'VectorTemplate';

	/**
	 * @inheritDoc
	 * @return array
	 */
	public function getDefaultModules() {
		$modules = parent::getDefaultModules();

		if ( $this->isLegacy() ) {
			$modules['styles']['skin'][] = 'skins.vector.styles.legacy';
			$modules[Constants::SKIN_NAME] = 'skins.vector.legacy.js';
		} else {
			$modules['styles'] = array_merge(
				$modules['styles'],
				[ 'skins.vector.styles', 'mediawiki.ui.icon', 'skins.vector.icons' ]
			);
			$modules[Constants::SKIN_NAME][] = 'skins.vector.js';
		}

		return $modules;
	}

	/**
	 * Set up the VectorTemplate. Overrides the default behaviour of SkinTemplate allowing
	 * the safe calling of constructor with additional arguments. If dropping this method
	 * please ensure that VectorTemplate constructor arguments match those in SkinTemplate.
	 *
	 * @internal
	 * @param string $classname
	 * @return VectorTemplate
	 */
	protected function setupTemplate( $classname ) {
		$tp = new TemplateParser( __DIR__ . '/templates' );
		return new VectorTemplate( $this->getConfig(), $tp, $this->isLegacy() );
	}

	/**
	 * Whether or not the legacy version of the skin is being used.
	 *
	 * @return bool
	 */
	private function isLegacy() : bool {
		$isLatestSkinFeatureEnabled = MediaWikiServices::getInstance()
			->getService( Constants::SERVICE_FEATURE_MANAGER )
			->isFeatureEnabled( Constants::FEATURE_LATEST_SKIN );

		return !$isLatestSkinFeatureEnabled;
	}

	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

$out->addLink( array(
    'rel' => 'apple-touch-icon',
    'sizes' => '180x180',
    'href' => '/apple-touch-icon.png',
) );

$out->addLink( array(
    'rel' => 'apple-touch-icon',
    'sizes' => '32x32',
    'href' => '/favicon-32x32.png',
) );

$out->addLink( array(
    'rel' => 'apple-touch-icon',
    'sizes' => '16x16',
    'href' => '/favicon-16x16.png',
) );

$out->addLink( array(
    'rel' => 'mask-icon',
    'href' => '/safari-pinned-tab.svg',
    'color' => 'white',
) );

$out->addLink( array(
    'rel' => 'manifest',
    'href' => '/site.webmanifest',
) );

$out->addMeta( 'msapplication-TileColor', '#da532c' );
$out->addMeta( 'theme-color', '#ffffff' );

$styleFeck = <<< EOT
.nv-view, .nv-talk, .nv-edit { display: none; }

/* Content */
div#mw-content-text { font-size: 14.5px !important; color: #555555;}
p { margin: 10px 0; }
h1, h2, h3, .h1, .h2, .h3 { margin-top: 20px; margin-bottom: 10px; }
h4, h5, h6, .h4, .h5, .h6 { margin-top: 10px; margin-bottom: 10px; }
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-weight: 400; line-height: 1.2; color: #333333; }
h1 { font-size: 28px; font-family: sans-serif !important; }
h2 { font-size: 24px !important; font-family:sans-serif !important; }
h3 { font-size: 18px !important; }
h4 { font-size: 16px !important; }
h5 { font-size: 14px !important; }
h6 { font-size: 12px !important; }
a { text-decoration: none; }
a:hover { text-decoration: underline; }
a:link { color: #158cba; }
a:visited { color: #0b475e; }
a.new:link { color: #BA0000; }
a.new:visited { color: #A55858; }

.radius { border-radius: 5px; }

pre, .alert-box {
    border: 1px solid #a7a7a7;
    margin-bottom: 20px;
    background-color: #fafafa;
    border-radius: 4px;
    border-width: 1px;
	padding: 5px;
	clear: left;
	overflow: hidden;
}

.alert-box .icon {
	/*width: 100px;*/
	text-align: center;
	vertical-align: bottom;
	/*float: left;*/
}

.alert-box .icon img {
	margin: 0 10px;
}

.alert-box .title {
	padding-top: 0;
	font-size: 14px;
	font-weight: 400;
}

/* justify content of header panels when content is positioned next to higher boxes, streamlining its appearance */
.alert-box.flex table {
        align-self: center;
}

h1.firstheading { border: none; }

h2.title {
	font-size: 28px !important;
	padding: 0;
	margin: 10px 15px;
	margin-bottom: 0;
	border-bottom: none;
}
h2.title .label { background-color: #999999 !important; color: white !important; font-weight: normal; border-bottom: 2px solid #dddddd; padding: 0.2em 0.4em; top: -1em; font-size: 40%; }
.subheader { font-size: 62%;  font-weight: normal; color: #999999; }

/* User Welcome */
/*.mp-welcome-image img { width: 20px; }*/
.mp-welcome-logged-in { }
.total-points { float: left; }
.honorific-level a { float: left; }
.needed-points { float: left; width:340px; }
.mp-welcome-logged-out {
	list-style-type: none;
}
.mp-welcome-logged-out li {
	display: block;
	float:right;
	clear:right;
	margin: 5px;
}
.user-welcome td.avatar { width: 80px; }

/* Main page */
.panel {
	border: 1px solid #e5e5e5;
	margin-bottom: 20px;
	background-color: #fdfdfd;
	border-radius: 4px;
	border-width: 1px;
	padding: 0;
}

.panel h3, .panel h4.panel-header, .panel .heading {
	font-size: 16px !important;
	font-weight: normal;
	background-color: #f0f0f0;
	padding: 10px 15px;
	border-bottom: 1px solid transparent;
	border-top-right-radius: 3px;
	border-top-left-radius: 3px;
    margin-top: 0;
    margin-bottom: 0;
}
.panel h3 .floatright, .panel .heading .floatright { margin: 0 !important; }

.panel h3.red-herring {
	background-color: red;
	color: white;
	font-weight: 700;
}

.panel table.gallery-wrapper {
	border-bottom: 1px solid #dddddd;
	padding: 10px 0 !important;
	text-align: center;
	margin: 0 auto;
	width: 100%;
}
.panel ul.list {
	padding: 10px 15px;
	border-bottom: 1px solid #dddddd;
	margin: 0 !important;
	list-style-position: inside;
}
.panel ul li {
	margin-bottom: 0 !important;
}

h4.panel-subheading {
	font-size: 15px !important;
	font-weight: normal;
	background-color: #FBFBFB;
	padding: 10px 15px;
	border-bottom: 1px solid transparent;
}

p.panel-body {
	padding: 10px 15px;
	border-bottom: 1px solid #dddddd;
	margin: 0 !important;
}
p.panel-abstract {
	padding: 10px 15px;
	border-bottom: 1px solid #dddddd;
	margin: 0 !important;
	font-size: 16px;
}
p.panel-warning {
	padding: 10px 15px;
	margin: 0 !important;
	border-bottom: 1px solid #b75;
	border-top: 1px solid #b75;
	background: #fef7f5;
}
p.panel-warning img {
	padding: 5px;
}

ul.content-table {
	list-style-position: inside;
	margin: 0 !important;
	padding: 0 !important;
	list-style-type: disc !important;
}
ul.featured-table {
	margin: 0 !important;
	padding: 0 !important;
	list-style-type: none !important;
	list-style-image: none !important;
}
ul.featured-table li.featured.list-item ul li img.prestige {
	opacity: .25;
}
ul.featured-table li.featured.list-item ul li:hover img.prestige {
	opacity: .5;
}
ul.content-table li.list-item {
	border-bottom: 1px solid #dddddd;
	padding: 10px 15px;
}
ul.featured-table li.list-item {
	border-bottom: 1px solid #dddddd;
	padding: 10px 15px;
	list-style-type: none !important;
	list-style-image: none !important;
}
ul.featured-table h4 {
	padding: 0 0 5px 0;
}
ul.featured-table li.featured {
	word-wrap: break-word;
}
ul.featured-table li.featured span.right {
	margin-left: 15px;
	float: right;
}
ul.featured-table li.featured h4 {
	margin-top: 0;
}
div.panel-form { padding: 10px 15px; }

p.panel-footer {
	/*font-size: 16px;*/
	background-color: #f5f5f5;
	padding: 10px 15px;
	border-bottom: 1px solid transparent;
	border-bottom-right-radius: 3px;
	border-bottom-left-radius: 3px;
	margin: 0;
}

/* Summary Template */
.summary-panel {
	vertical-align: middle;
	background-color: #E6E6E6;
	text-align: center;
	border-radius:4px;
	/* font-size: 16px !important; */
}

.mp-welcome-logged-out li {
	float: right;
}
.user-welcome {
	margin-bottom: 0;
}

.user-welcome .avatar img {
	background-color: #FFFFFF;
	border: 1px solid #DCDCDC;
	padding: 3px;
}
.user-welcome .user-info p {
	float: left;
	clear: left;
}
.total-points {
	background-color: #CC0000;
	color: #FFFFFF;
	font-weight: bold;
	margin: 0 5px 0 0;
	padding: 1px 5px;
}
.user-level {
	padding: 1px 5px;
	margin: 0 0 0 5px;
}
.needed-points {
	color: #666666;
}
.user-requests {
	vertical-align: top;
	list-style-type: none;
}

/* Forum stuff */
div.wikiforum-avatar-image {
	padding: 10px;
}
div.wikiforum-avatar-image img {
	background-color: #FFFFFF;
	border: 1px solid #DCDCDC;
	padding: 3px;
}
td.mw-wikiforum-thread-main, td.mw-wikiforum-thread-sub {
	word-break: break-word !important;
}

/* Random replications slideshow */

/*.randomreplication  {
	margin: 0 auto;
	border-bottom: 1px solid #dddddd;
}*/
ul.gallery {
	height: auto !important;
	margin: 0 auto !important;
	text-align: center;
}
ul.gallery li.gallerybox {
	margin: 5px !important;
}
ul.gallery li.gallerybox div div.thumb {
	margin: 0 !important;
	padding: 0 !important;

	/*border: none !important;
	background: transparent;*/

	border: 1px solid #e7e7e7;
	background-color: #f5f5f5;
	border-radius: 4px;
	border-width: 0 1px 4px 1px;
}
ul.gallery li.gallerybox div div.thumb div {
	border: none !important;
	background: transparent;
	margin: 0 !important;
	padding: 0 !important;
}
ul.gallery li.gallerybox div div.thumb div a.redirecticon {
	display: none !important;
}
ul.gallery li.gallerybox div div.thumb div a img {
    max-height: 350px;
    width: auto;
}

ul.gallery li.gallerybox div div.gallerytext p {
	text-indent: 0 !important;
	font-size: 11px;
	text-align: justify;
}

div.srf-gallery-slideshow {
	display: flex;
	align-items: center;

	min-height: 470px !important;
}

.thumbinner { background: #ffffff; border: 1px solid #eeeeee; border-radius: 4px; }
.thumbcaption { padding: 9px; color: #555555; font-size: 12px; line-height: 1.5; background: #f5f5f5; }
.tright { margin-left: 20px; margin-bottom: 20px; }
.tleft { margin-right: 20px; margin-bottom: 20px; }

/*
.jcarousel-prev-horizontal, .jcarousel-next-horizontal {
	background-size: 18px 18px !important;
}
.jcarousel-prev-horizontal:hover {
	background: transparent url('/w/extensions/SemanticResultFormats/formats/gallery/resources/images/prev-horizontal.png') no-repeat 0 0 !important;
	background-position: center center !important;
}
.jcarousel-next-horizontal:hover {
	background: transparent url('/w/extensions/SemanticResultFormats/formats/gallery/resources/images/next-horizontal.png') no-repeat 0 0 !important;
	background-position: center center !important;
}
*/

/* Title */
.mp_header {
  width:100%;
  border-spacing:0;
  border: none;
  margin-top:0;
  margin-bottom:1em;
  vertical-align:middle;
}
.mp_header span {
  font-family: sans-serif !important;
}
.mp_title {
  font-size:188%;
  line-height:1.2em;
  height:1.2em;
  padding:.5em, 0, 0, 0;
  width:auto;
  text-align:left;
  padding-top:.1em;
  vertical-align: bottom;
}

.mp_title_underline {
  display:block;
  height:1px;
  background: #FFF;
  background:-moz-linear-gradient( left, #AAAAAA 0%, #FFF 100% );
  background:-o-linear-gradient( left, #AAAAAA 0%, #FFF 100% );
  background:-ms-linear-gradient( left, #AAAAAA 0%, #FFF 100% );
  background:-webkit-gradient(linear, 0% 0%, 100% 0%, from(#AAAAAA), to(#FFF));
  background: linear-gradient( left, #AAAAAA 0%, #FFF 100% );
}


/* Table of Contents */
.toc {
	border: 1px solid #e7e7e7;
	margin: 15px 20px;
	background-color: #ffffff;
	border-radius: 4px;
	border-width: 0 1px 4px 1px;
	padding: 0 !important;
}

.toc ul {
	padding-left: 3em !important;
    padding-right: 2em !important;
}

.toctitle {
	background-color: #f5f5f5;
	padding: 10px 15px;
	border-bottom: 1px solid transparent;
	border-top-right-radius: 3px;
	border-top-left-radius: 3px;
}
.toctitle h2 {
	display: inline;
	font-size: 14px !important;
	font-weight: normal;
	margin-bottom: 0;
}
.toctoggle {
	float: right;
}
.toc ul { list-style-type: none; }

/* CSS placed here will affect users of the Vector skin */

a.mw-wiki-logo { padding-top: 20px !important; }

h3#p-cactions-label { height:39px !important; }
div#mw-panel nav.portal { padding-bottom: 0; margin-bottom: 15px; }
div#mw-panel nav.portal div.body { margin: 0 0 0 0.5em !important; }

nav#p-Navigation ul li, nav#p-Development ul li, nav#p-Community ul li {
    background-position: left top;
    background-repeat: no-repeat;
    padding-top: 3px !important;
    margin-bottom: .5em !important;
}
nav#p-Navigation ul li a, nav#p-Development ul li a, nav#p-Community ul li a {
    margin-left: 25px;
}
nav#p-tb ul li a { margin-left: 0; }

h3#p-Navigation-label, h3#p-Development-label, h3#p-Community-label, h3#p-tb-label {
    margin: 10px 5px !important;
    padding: 0;
}
nav#p-Navigation { background-image: none !important; margin-top: 10px !important; }
h3#p-Navigation-label { display: none; }

li#n-Home {	background-image: url('https://psychonautwiki.org/w/images/2/25/Home.svg'); background-size: 16px auto;}
li#n-List-of-articles {	background-image: url('https://psychonautwiki.org/w/images/5/52/Sitemap.svg'); background-size: 16px auto;}

li#n-Effects {	background-image: url('https://psychonautwiki.org/w/images/0/01/Eye.svg'); background-size: 16px auto;}
li#n-EffectIndex {  background-image: url('https://psychonautwiki.org/w/images/0/01/Eye.svg'); background-size: 16px auto;}
li#n-Effect-Index {  background-image: url('https://psychonautwiki.org/w/images/0/01/Eye.svg'); background-size: 16px auto;}

li#n-Substances {	background-image: url('https://psychonautwiki.org/w/images/0/08/Flask.svg'); background-size: 16px auto;}
li#n-Experiences {	background-image: url('https://psychonautwiki.org/w/images/a/ab/Newspaper-o.svg'); background-size: 16px auto;}
li#n-Replications {	background-image: url('https://psychonautwiki.org/w/images/6/6c/Image.svg'); background-size: 16px auto;}
li#n-Tutorials {	background-image: url('https://psychonautwiki.org/w/images/3/35/List-ol.svg'); background-size: 16px auto;}
li#n-Responsible-use {	background-image: url('https://psychonautwiki.org/w/images/d/d6/Exclamation-triangle.svg'); background-size: 16px auto;}
li#n-Random-article {	background-image: url('https://psychonautwiki.org/w/images/3/37/Random.svg'); background-size: 16px auto;}

li#n-Recent-changes {	background-image: url('https://psychonautwiki.org/w/images/d/d2/History.svg'); background-size: 16px auto;}
li#n-Change-log {	background-image: url('https://psychonautwiki.org/w/images/6/65/Calendar.svg'); background-size: 16px auto;}
li#n-Guidelines {	background-image: url('https://psychonautwiki.org/w/images/3/39/Book.svg'); background-size: 16px auto;}
li#n-To-do-list {	background-image: url('https://psychonautwiki.org/w/images/c/c1/Tasks.svg'); background-size: 16px auto;}
li#n-Issues {	background-image: url('https://psychonautwiki.org/w/images/1/1d/Bug.svg'); background-size: 16px auto;}
li#n-Open-source {	background-image: url('https://psychonautwiki.org/w/images/9/91/Github.svg'); background-size: 16px auto;}
li#n-Backup {	background-image: url('https://psychonautwiki.org/w/images/0/0d/Cloud-download.svg'); background-size: 16px auto;}

li#n-Contact-us {	background-image: url('https://psychonautwiki.org/w/images/a/a4/Envelope-o.svg'); background-size: 16px auto;}
li#n-Good-vibes {	background-image: url('https://psychonautwiki.org/w/images/8/82/Heart-o.svg'); background-size: 16px auto;}
li#n-Games {	background-image: url('https://psychonautwiki.org/w/images/b/be/Gamepad.svg'); background-size: 16px auto;}
li#n-Network {	background-image: url('https://psychonautwiki.org/w/images/6/60/External-link.svg'); background-size: 16px auto;}
li#n-High-scores {	background-image: url('https://psychonautwiki.org/w/images/0/05/Bar-chart.svg'); background-size: 16px auto;}
li#n-Statistics {	background-image: url('https://psychonautwiki.org/w/images/3/39/Line-chart.svg'); background-size: 16px auto;}
li#n-Subreddit {	background-image: url('https://psychonautwiki.org/w/images/4/43/Reddit.svg'); background-size: 16px auto;}
li#n-Imageboard {	background-image: url('https://psychonautwiki.org/w/images/7/78/List-ul.svg'); background-size: 16px auto;}
li#n-Forum {	background-image: url('https://psychonautwiki.org/w/images/9/9d/List-alt.svg'); background-size: 16px auto;}
li#n-Blog {	background-image: url('https://psychonautwiki.org/w/images/4/43/Tumblr.svg'); background-size: auto 16px;}
li#n-Twitter {	background-image: url('https://psychonautwiki.org/w/images/d/db/Twitter.svg'); background-size: 16px auto;}
li#n-Facebook {	background-image: url('https://psychonautwiki.org/w/images/f/f0/Facebook-square.svg'); background-size: 16px auto;}
li#n-Meetups {	background-image: url('https://psychonautwiki.org/w/images/f/fa/Globe.svg'); background-size: 16px auto;}
li#n-Instagram {	background-image: url('https://psychonautwiki.org/w/images/9/96/Instagram.svg'); background-size: 16px auto;}
li#n-DEIS {	background-image: url('https://psychonautwiki.org/w/images/4/43/Tumblr.svg'); background-size: 10px auto;}
li#n-YouTube {	background-image: url('https://psychonautwiki.org/w/images/6/64/Yt-icon.svg'); background-size: 16px auto;}

li#n-Contact-us {
	font-weight: 900;
}

li#n-Network {
	font-weight: 900;
	font-size: 13px;
}

#p-personal ul li:not(#pt-userpage) { background: none;}
h3#p-personal-label { display: none; }

/*li#pt-userpage {	list-style-image: url('/w/images/c/c9/Fa-user.png');}
li#pt-addpersonalurls-notes {	list-style-image: url('/w/images/c/c1/Fa-file-text-o.png');}
li#pt-mytalk {	list-style-image: url('/w/images/c/cb/Fa-comments-o.png');}
li#pt-adminlinks {	list-style-image: url('/w/images/7/76/Fa-tachometer.png');}
li#pt-preferences {	list-style-image: url('/w/images/9/92/Fa-cog.png');}
li#pt-betafeatures {	display: none;}
li#pt-watchlist {	list-style-image: url('/w/images/e/e9/Fa-exclamation-circle.png');}
li#pt-mycontris {	list-style-image: url('/w/images/7/7c/Fa-pencil.png');}
li#pt-logout {	list-style-image: url('/w/images/d/d6/Fa-power-off.png'); }

li#pt-login {	list-style-image: url('/w/images/5/51/Fa-sign-in.png');}
li#pt-createaccount {	list-style-image: url('/w/images/f/f7/Fa-users.png'); }*/

body.page-Donate div.mw-parser-output:nth-child(1) p.panel-body {
    font-size: 16px;
}

/*Make donation link stand out and look less like a menu item*/
div.top-button {
	display: inline;
}

#p-support .body {
    background:none;
    background-image:none !important;
    border:none;
    height:auto;
    margin:auto !important;
    padding-top: 15px;
    padding-bottom: 15px;
    /*padding-top: 10px;
    padding-bottom: 0px;*/
    display: flex;
    width: 139px;
    /*width: 100%;
    flex-flow: column-reverse wrap;*/
}

#p-support .body div {
    flex: 1;
    margin: 0;

    /*margin: 8px auto;*/
}

#p-support .body div a {
    color:black;
    padding: 0.3em 0.75em;
    margin-right: 5px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    font-size: 14px;
    /*font-weight: bold; */

    /*padding: 5px 25px;*/
}
#p-support .body div#n-button-Donate a {
    background: #FFEFC8;
    background: -moz-linear-gradient(top, #FFDFA8 0%, #FFCE7B 2%, #EBA42D 97%, #B3802B 100%);
    background: -o-linear-gradient(top, #FFDFA8 0%, #FFCE7B 2%, #EBA42D 97%, #B3802B 100%);
    background: -ms-linear-gradient(top, #FFDFA8 0%, #FFCE7B 2%, #EBA42D 97%, #B3802B 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0.0, #FFDFA8), color-stop(0.02, #FFCE7B), color-stop(0.97, #EBA42D), color-stop(1.0, #B3802B));
    background: linear-gradient(top, #FFDFA8 0%, #FFCE7B 2%, #EBA42D 97%, #B3802B 100%);
    border: 1px solid #FFA500;

    font-weight: 800;
}

#p-support .body div#n-button-Contact a  {
    background: rgb(233,246,253); /* Old browsers */
    background: -moz-linear-gradient(top, rgba(233,246,253,1) 0%, rgba(211,238,251,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(233,246,253,1)), color-stop(100%,rgba(211,238,251,1))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, rgba(233,246,253,1) 0%,rgba(211,238,251,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, rgba(233,246,253,1) 0%,rgba(211,238,251,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, rgba(233,246,253,1) 0%,rgba(211,238,251,1) 100%); /* IE10+ */
    background: linear-gradient(to bottom, rgba(233,246,253,1) 0%,rgba(211,238,251,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e9f6fd', endColorstr='#d3eefb',GradientType=0 ); /* IE6-9 */
    border: 1px solid #CCC;
}

#p-support .body div#n-button-Donate a:focus,
#p-support .body div#n-button-Donate a:hover {
    outline: none;
    text-decoration:none;
    background: #FFDFA8;
    background: -moz-linear-gradient(top, #FFDFA8 0%, #FFD794 2%, #EBAD44 97%, #B3802B 100%);
    background: -ms-linear-gradient(top, #FFDFA8 0%, #FFD794 2%, #EBAD44 97%, #B3802B 100%);
    background: -o-linear-gradient(top, #FFDFA8 0%, #FFD794 2%, #EBAD44 97%, #B3802B 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0.0, #FFDFA8), color-stop(0.02, #FFD794), color-stop(0.97, #EBAD44), color-stop(1.0, #B3802B));
    background: linear-gradient(top, #FFDFA8 0%, #FFD794 2%, #EBAD44 97%, #B3802B 100%);
}
#p-support .body div#n-button-Contact a:focus,
#p-support .body div#n-button-Contact a:hover {
    outline: none;
    text-decoration:none;
background: rgb(237,248,253); /* Old browsers */
background: -moz-linear-gradient(top, rgba(237,248,253,1) 0%, rgba(219,242,251,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(237,248,253,1)), color-stop(100%,rgba(219,242,251,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(237,248,253,1) 0%,rgba(219,242,251,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(237,248,253,1) 0%,rgba(219,242,251,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(237,248,253,1) 0%,rgba(219,242,251,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(237,248,253,1) 0%,rgba(219,242,251,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#edf8fd', endColorstr='#dbf2fb',GradientType=0 ); /* IE6-9 */
}
#p-support .body div#n-button-Donate a:active {
    background: #FFDFA8;
    background: -moz-linear-gradient(bottom, #FFDFA8 0%, #FFCE7B 2%, #EBA42D 97%, #B3802B 100%);
    background: -ms-linear-gradient(bottom, #FFDFA8 0%, #FFCE7B 2%, #EBA42D 97%, #B3802B 100%);
    background: -o-linear-gradient(bottom, #FFDFA8 0%, #FFCE7B 2%, #EBA42D 97%, #B3802B 100%);
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0.0, #FFDFA8), color-stop(0.02, #FFCE7B), color-stop(0.97, #EBA42D), color-stop(1.0, #B3802B));
    background: linear-gradient(bottom, #FFDFA8 0%, #FFCE7B 2%, #EBA42D 97%, #B3802B 100%);
}
#p-support .body div#n-button-Contact a:active {
background: #feffff; /* Old browsers */
background: -moz-linear-gradient(top,  #feffff 0%, #d2ebf9 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#feffff), color-stop(100%,#d2ebf9)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #feffff 0%,#d2ebf9 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #feffff 0%,#d2ebf9 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #feffff 0%,#d2ebf9 100%); /* IE10+ */
background: linear-gradient(to bottom,  #feffff 0%,#d2ebf9 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#feffff', endColorstr='#d2ebf9',GradientType=0 ); /* IE6-9 */
}
#p-support h5, #p-button-Contact h5 {
    display:none !important;
}

/* Tabs */
div#left-navigation ul li a, div#right-navigation ul li a { color: #158cba; }
div#left-navigation ul li a:visited, div#right-navigation ul li a:visited { color: #0b475e; }

div#left-navigation ul li.new a, div#right-navigation ul li.new a { color: #BA0000; }
div#left-navigation ul li.new a:visited, div#right-navigation ul li.new a:visited { color: #A55858; }

/* Interwiki favicons */
#bodyContent a[href *="drugs-forum.com"] {
	background: url("https://psychonautwiki.org/w/images/2/2f/Drugs-forum.bmp") center right no-repeat;
	background-size: 16px;
	padding-right: 18px;
}
#bodyContent a[href *="erowid.org"] {
	background: url("https://psychonautwiki.org/w/images/a/a8/Erowid.png") center right no-repeat;
	background-size: 16px;
	padding-right: 18px;
}
#bodyContent a[href *="wikipedia.org"] {
	background: url("https://psychonautwiki.org/w/images/2/28/Wikipedia.svg") center right no-repeat;
	background-size: 16px;
	padding-right: 18px;
}
#bodyContent a[href *="bluelight.org"] {
	background: url("https://psychonautwiki.org/w/images/e/eb/Bluelighticon.png") center right no-repeat;
	background-size: 16px;
	padding-right: 18px;
}
#bodyContent a[href *="tripsit.me"] {
	background: url("https://psychonautwiki.org/w/images/a/a1/Tripsit.png") center right no-repeat;
	background-size: 16px;
	padding-right: 18px;
}
#bodyContent a[href *="isomerdesign.com"] {
	background: url("https://psychonautwiki.org/w/images/9/9d/Isomerdesign.ico") center right no-repeat;
	background-size: 16px;
	padding-right: 18px;
}
#bodyContent a[href *="disregardeverythingisay.com"] {
	background: url("https://psychonautwiki.org/w/images/8/8d/Deislogo.png") center right no-repeat;
	background-size: 16px;
	padding-right: 18px;
}

#bodyContent a[href *=".onion"] {
	background: url("https://psychonautwiki.org/w/images/d/d4/Onion.ico") center right no-repeat;
	background-size: 16px;
	padding-right: 18px;
}

/* Event calendar help class */
.fc-view-basicWeek {
  width:100%;
  height:200px;
}

/* Random Quote */
#mw-data-after-content {
	float: right;
	font-size: 10px;
	font-style: italic;
	font-family: serif;
	clear: both;
}

/*Media queries*/
/*Full screen*/
@media all and (min-width: 1200px) {
  .adk_mp_right {
  width:60%;
  padding-left:0.2em;
  float:right;
  }

  .adk_mp_left {
  width:40%;
  padding-right:0.2em;
  }

  .adk_mp_portal_right {
  width:50%;
  float:right;
  }

  .adk_mp_portal_left {
  width:50%;
  }
}

/*Medium screen*/
@media all and (min-width: 901px) and (max-width: 1199px) {
  .adk_mp_right {
  width:50%;
  padding-left:0.2em;
  float:right;
  }

  .adk_mp_left {
  width:50%;
  padding-right:0.2em;
  }

  .adk_mp_portal_right {
  	margin-left:0;
  }

  .adk_mp_portal_left {
  margin-right:0;
  }
}
/*Mobile screen*/
@media all and (max-width: 900px) {
  .adk_mp_right {
  }

  .adk_mp_left {
  }

  .adk_wigo_icon {
  float:left;
  }

  .adk_wigo_blurb {
  display:none;
  }

  .adk_portal_list {
  display:none;
  }
}

.user-board-message-body img {
	max-width: 100%;
}

.wikiEditor-ui-buttons {
	display: none !important;
}

.ContactPage {
    line-height: 1;
}
.ContactPage *,
.ContactPage *:before,
.ContactPage *:after {
    box-sizing: border-box;
}

.ContactPage .container {
    display: block;

    padding: 0 20px;
    margin: 0 auto;
}

@media screen and (max-width: 1020px) {
    .ContactPage .container {
        width: auto;
    }
}

@media screen and (max-width: 735px) {
    .ContactPage .container {
        padding: 0 20px;
    }
}

.ContactPage * {
    -webkit-text-size-adjust: 100%;
    vertical-align: top;
}

.ContactPage {
    font-family: helvetica;
    font-weight: normal;
    font-size: 14px;
    line-height: 1.3;
    text-align: center;
    margin: 0 auto;
    color: #333;
}

.ContactPage h3 {
    color: #205081;
    font-weight: normal;
    /*text-align: left;*/
    text-rendering: optimizelegibility;

    z-index: 100;
}

.ContactPage a {
    color: #5e8ec0;
    cursor: pointer;
    outline: none;
    text-align: inherit;
    text-decoration: none;
    line-height: inherit;
}

.ContactPage img {
    text-align: inherit;
    vertical-align: top;
    border: none;
    max-width: 100%;
    height: auto;
}

.ContactPage .PaneContent {
    text-align: left;
}

.ContactPage .PaneContent a {
    color: #3271B3;
    outline: medium none;
    text-decoration: none;
}

.ContactPage ::-webkit-input-placeholder {
    color: #aaa;
    font-weight: normal;
}

.ContactPage :-moz-placeholder {
    color: #aaa;
    font-weight: normal;
}

.ContactPage ::-moz-placeholder {
    color: #aaa;
    font-weight: normal;
}

.ContactPage :-ms-input-placeholder {
    color: #aaa;
    font-weight: normal;
}

.ContactPage .PaneContent {
    float: left;

    min-height: 450px;
}

@media screen and (max-width: 800px) {
    .ContactPage .PaneContent {
        width: 70%;
    }
}

@media screen and (max-width: 670px) {
    .ContactPage .PaneContent {
        width: 65%;
    }
}

@media screen and (max-width: 640px) {
    .ContactPage .PaneContent {
        float: none;
        width: 100%;
    }
}

.ContactPage {
    position: relative;
}

.ContactPage > .container {
    padding: 20px 20px 40px 20px;
}

@media screen and (max-width: 640px) {
    .ContactPage .PaneContent {
        margin-left: 0px;
    }
}

.ContactPage .PersonContainer {
    position: relative;
    padding-top: 160px;
    width: 33.33333%;
    float: left;
    margin-bottom: 50px;
    margin-top: 0px;

    min-width: 220px;
}

@media only screen and (max-width: 950px) {
    .ContactPage .PersonContainer {
        width: 50%;
        padding-left: 20px;
    }
}

@media only screen and (max-width: 440px) {
    .ContactPage .PersonContainer {
        width: 100%;
        padding-left: 50px;
    }
}

.ContactPage .PersonContainer h3 {
    margin: 0;
    position: relative;
    color: #205081;
    font-size: 20px;
}

@media only screen and (max-width: 680px) {
    .ContactPage .PersonContainer h3 {
        font-size: 16px;
    }
}

.ContactPage .PersonContainer .PersonJob {
    text-transform: none;
    color: #707070;
    display: block;
    margin-top: -5px;
}

.ContactPage .PersonContainer .PersonTitle {
    display: block;
    text-transform: none;
    font-size: 16px;
    color: #707070;
    line-height: 20px;
}

.ContactPage .PersonContainer.placeholder {
    min-width: 33.33333%;
}

@media only screen and (max-width: 680px) {
    .ContactPage .PersonContainer .PersonTitle {
        font-size: 14px;
    }
}

@media only screen and (max-width: 740px) {
    .ContactPage .PersonContainer h3 {
        font-size: 15px;
    }

    .ContactPage .PersonContainer .PersonTitle {
        font-size: 14px;
    }
}

.ContactPage .PersonName2 {
    color: #205081;
    font-weight: 700;
}

.ContactPage .PersonDetailsContainer {
    overflow: hidden;
}

.ContactPage .PersonPhoto {
    display: block;
    float: left;
    padding-top: 0px;
    width: 100%;
    margin-right: 20px;
    padding-bottom: 20px;
    position: absolute;
    top: 0;
    left: 0;
}

.ContactPage .PersonPhoto {
    border: none;
}

@media only screen and (max-width: 950px) {
    .ContactPage .PersonPhoto {
        padding-left: 20px;
    }
}

@media only screen and (max-width: 440px) {
    .ContactPage .PersonPhoto {
        padding-left: 50px;
    }
}

.ContactPage .PersonPhoto pre {
	background-color: transparent;
}

.ContactPage .PersonPhoto img {
    width: 120px;
    border-radius: 50%;
}

.ContactPage .PersonGenericContainer {
	display: flex;
	flex-flow: row wrap;
	padding-top: 25px;

	max-width: 600px;

	justify-content: center;
	align-self: center;
}

.ContactPage pre {
    border-radius: inherit;
    border-width: inherit;
    padding: inherit;
    clear: none;
    overflow: inherit;
}

.ContactPage pre:hover {
    -webkit-box-shadow: none;
    -moz-box-shadow: initial;
    box-shadow: none;
}

/* THIS WILL BREAK THE CONTACT PAGE IF A NEW HEADER IS INTENTIONALLY ADDED, REMOVE THIS IF NEEDED  */

body.page-Contact_us #mw-content-text > h2:nth-child(1) {
    display: none !important;
}

body.page-Contact_us div.mw-content-text p.panel-body {
    font-size: 15px;
    text-rendering: optimizelegibility;
}

/* Design improvements to patrol page */

/*.diff .patrollink, #mw-diff-ntitle4 {
    display: none;
}*/

.diff .patrollink, .diff .approvelink, .diff .ext-approved-revs-approval-span {
	color: transparent;
}

.diff .ext-approved-revs-approval-span {
        display: block;
}

.diff a.ext-approved-revs-approval-link {
        margin: 20px;
}

.diff .patrollink a, .diff .approvelink a, .diff a.ext-approved-revs-approval-link, input[name=wpPatrolEndorse], input[name=wpPatrolRevert], input[name=wpPatrolSkip] {
    background: transparent;
    border-radius: 4px;
    border: 1px solid #e85d00;
    color: #e85d00;
    display: inline-block;
    font-family: "SF Pro Text","SF Pro Icons","Helvetica Neue","Helvetica","Arial",sans-serif;
    font-size: 17px;
    font-weight: 400;
    letter-spacing: -.021em;
    line-height: 1.52947;
    margin-top: 15px;
    padding-bottom: 4px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 3px;
    white-space: nowrap;
}

/* katharsis dashboard (visitor information) */

.rx-katharsis-container .panel.radius {
    border: 0;
}

.rx-katharsis-container .panel-header {
    margin-bottom: 0;
    padding: 0.5em;
    margin: 0;
    line-height: 1;
    font-size: 20px !important;
    border: 0;
    text-align: center;
}

.rx-katharsis-container .panel-header .value-item {
    font-weight: 700;
    display: block;
    font-size: 28px;
}

.rx-katharsis-container .panel-header .value-label {
    display: block;
    font-size: 15px;
}

.rx-katharsis-container iframe {
	width: 100%;
	border: none;
	margin: 10px;
}

/* ROATable: readability enhancements */

.mw-collapsed > tbody > .ROAHeaderRow {
	border-color: gray;
}

:not(.mw-collapsed) > tbody > .ROAHeaderRow {
	border-color: green;
}

.ROAHeaderRow {
	border-top: 1px solid;
	border-left: 3px solid;
	border-radius: 2px;
}

.ROASubHeaderRow, .ROASectionRow, .ROATable tr.dosechart {
	border-left: 2px solid;
}

EOT;

$pwCommonCSS = file_get_contents( '/var/www/public/w/skins/pw-common.css' );

$unifiedCSS = $styleFeck . $pwCommonCSS;

		$out->addInlineStyle( $unifiedCSS );

//		$out->addModules( 'skins.vector.js' );
	}

	/**
	 * @internal only for use inside VectorTemplate
	 * @return array of data for a Mustache template
	 */
	public function getTemplateData() {
		$out = $this->getOutput();
		$title = $out->getTitle();

		$indicators = [];
		foreach ( $out->getIndicators() as $id => $content ) {
			$indicators[] = [
				'id' => Sanitizer::escapeIdForAttribute( "mw-indicator-$id" ),
				'class' => 'mw-indicator',
				'html' => $content,
			];
		}

		$printFooter = Html::rawElement(
			'div',
			[ 'class' => 'printfooter' ],
			$this->printSource()
		);

		return [
			// Data objects:
			'array-indicators' => $indicators,
			// HTML strings:
			'html-printtail' => WrappedString::join( "\n", [
				MWDebug::getHTMLDebugLog(),
				MWDebug::getDebugHTML( $this->getContext() ),
				$this->bottomScripts(),
				wfReportTime( $out->getCSP()->getNonce() )
			] ) . '</body></html>',
			'html-site-notice' => $this->getSiteNotice(),
			'html-userlangattributes' => $this->prepareUserLanguageAttributes(),
			'html-subtitle' => $this->prepareSubtitle(),
			// Always returns string, cast to null if empty.
			'html-undelete-link' => $this->prepareUndeleteLink() ?: null,
			// Result of OutputPage::addHTML calls
			'html-body-content' => $this->wrapHTML( $title, $out->mBodytext )
				. $printFooter,
			'html-after-content' => $this->afterContentHook(),
		];
	}

	/**
	 * @internal only for use inside VectorTemplate
	 * @return array
	 */
	public function getMenuProps() {
		return $this->buildContentNavigationUrls();
	}
}
