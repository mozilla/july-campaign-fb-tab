<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/. */

require_once 'l10n_moz.class.php';

define('LOCALE_DIR', 'locales');
define('LANG_FILE', 'olympics.lang');
define('REGION_DIR', 'regions');

// Build a list of valid locales.
$locales = array_diff(scandir(LOCALE_DIR), array('.', '..'));

// Retrieve the requested locale, defaulting to en-US.
$lang = (array_key_exists('lang', $_GET) ? $_GET['lang'] : 'en-US');
if (!in_array($lang, $locales)) {
    $lang = 'en-US';
}

// Read in locale data and set up translation function.
$l10n = new l10n_moz();
l10n_moz::load(sprintf('%s/%s/%s', LOCALE_DIR, $lang, LANG_FILE));
function ___($key) {
    global $l10n;
    return $l10n->get($key);
}

// Load region name JSON file.
$json = file_get_contents(sprintf('%s/%s.json', REGION_DIR, $lang));
$region_names = json_decode($json, true);
function get_region_name($region_code) {
    global $region_names;
    if (array_key_exists($region_code, $region_names)) {
        return $region_names[$region_code];
    } else {
        return $region_code;
    }
}

$personas = array(
    'ar' => array('persona' => '{&quot;id&quot;:&quot;474681&quot;,&quot;name&quot;:&quot;Flag Argentina&quot;,&quot;category&quot;:null,&quot;description&quot;:&quot;&quot;,&quot;author&quot;:&quot;MozThemes&quot;,&quot;username&quot;:&quot;mozthemes&quot;,&quot;headerURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/8\/1\/474681\/Persona_argentina1a.jpg?1341599107&quot;,&quot;footerURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/8\/1\/474681\/footer_persona_argentina.jpg?1341599107&quot;,&quot;detailURL&quot;:&quot;http:\/\/www.getpersonas.com\/persona\/474681&quot;,&quot;previewURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/8\/1\/474681\/preview.jpg?1341599107&quot;,&quot;iconURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/8\/1\/474681\/preview_small.jpg?1341599107&quot;,&quot;dataurl&quot;:&quot;data:image\/png;base64,\/9j\/4AAQSkZJRgABAQEASABIAAD\/2wBDAAMCAgICAgMCAgIDAwMDBAYEBAQEBAgGBgUGCQgKCgkICQkKDA8MCgsOCwkJDRENDg8QEBEQCgwSExIQEw8QEBD\/2wBDAQMDAwQDBAgEBAgQCwkLEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBD\/wAARCAAQABADAREAAhEBAxEB\/8QAFgABAQEAAAAAAAAAAAAAAAAABAUI\/8QAJBAAAQMEAQMFAAAAAAAAAAAAAQIEEQADBQYhBxIxEyIjQaL\/xAAYAQACAwAAAAAAAAAAAAAAAAAEBgMFB\/\/EACQRAAEEAQIGAwAAAAAAAAAAAAEAAgMEERIxBQYHISLwgZHh\/9oADAMBAAIRAxEAPwDX2sstQvul3c\/k77MeZb9xJEfYANJPTNvEWV3uYzwO3vZWvNhpOcBK7DkDcG3Tm1dQGeyZXtMz8J5\/FasZLw3YPv8AUlCKidnn34R7TX0Ux7VBQ8r5JFG1qkFOMRQNwAgJ7Mtl+uU5U5\/iWjlUqShUHgQYonTlQasFf\/\/Z&quot;,&quot;accentcolor&quot;:null,&quot;textcolor&quot;:null,&quot;updateURL&quot;:&quot;https:\/\/www.getpersonas.com\/en-US\/update_check\/474681&quot;,&quot;version&quot;:&quot;1341599107&quot;}'),
    'br' => array('persona' => '{&quot;id&quot;:&quot;474692&quot;,&quot;name&quot;:&quot;Flag Brazil&quot;,&quot;category&quot;:null,&quot;description&quot;:&quot;&quot;,&quot;author&quot;:&quot;MozThemes&quot;,&quot;username&quot;:&quot;mozthemes&quot;,&quot;headerURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/9\/2\/474692\/Persona_brazil1c.jpg?1341604936&quot;,&quot;footerURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/9\/2\/474692\/footer_persona_brazil.jpg?1341604936&quot;,&quot;detailURL&quot;:&quot;http:\/\/www.getpersonas.com\/persona\/474692&quot;,&quot;previewURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/9\/2\/474692\/preview.jpg?1341604936&quot;,&quot;iconURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/9\/2\/474692\/preview_small.jpg?1341604936&quot;,&quot;dataurl&quot;:&quot;data:image\/png;base64,\/9j\/4AAQSkZJRgABAQEASABIAAD\/2wBDAAMCAgICAgMCAgIDAwMDBAYEBAQEBAgGBgUGCQgKCgkICQkKDA8MCgsOCwkJDRENDg8QEBEQCgwSExIQEw8QEBD\/2wBDAQMDAwQDBAgEBAgQCwkLEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBD\/wAARCAAQABADAREAAhEBAxEB\/8QAFgABAQEAAAAAAAAAAAAAAAAABwUG\/8QAJRAAAQMDAwMFAAAAAAAAAAAAAQIDBAUGEQASIQcTQSIyYXGB\/8QAGAEAAgMAAAAAAAAAAAAAAAAABgcBBAX\/xAAmEQABAwIGAgIDAAAAAAAAAAABAgMRAAQFBhIhMUFhgQhRFCJx\/9oADAMBAAIRAxEAPwC90IitRbZrtehRHaVAlPtFURbpXHbeSk73G3DztKSkEK5Tgeo+F98gH2F4nY2iiHLhKVyQP20KI0BQHchREciTAqrkROm1efSChskbE7AgGSCeoiZ4+zQr1pqXTydUHXLfaLtVKz3JELCY6jnnf4WflP6TqMlWuYLdpIvjpZjZK5K\/EdpHhXoUG5yusu3ClfhCXp3UjZHmeifKfZNae+L7ua8GEU2S5HgUdlO2NSoDXYiNJ8AIT7vtWdEOD5YscIdVdDU7cK3U64dbij96jx6ilzi2b8UxwBDyghkcNoGlAH8HPsmjOVRmlOkpCVc8DBxoirJF4U1\/\/9k=&quot;,&quot;accentcolor&quot;:null,&quot;textcolor&quot;:null,&quot;updateURL&quot;:&quot;https:\/\/www.getpersonas.com\/en-US\/update_check\/474692&quot;,&quot;version&quot;:&quot;1341604936&quot;}'),
    'it' => array('persona' => '{&quot;id&quot;:&quot;475015&quot;,&quot;name&quot;:&quot;Flag Italy&quot;,&quot;category&quot;:null,&quot;description&quot;:&quot;&quot;,&quot;author&quot;:&quot;MozThemes&quot;,&quot;username&quot;:&quot;mozthemes&quot;,&quot;headerURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/5\/475015\/Persona_Italy.jpg?1341943165&quot;,&quot;footerURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/5\/475015\/footer_persona_italy.jpg?1341943165&quot;,&quot;detailURL&quot;:&quot;http:\/\/www.getpersonas.com\/persona\/475015&quot;,&quot;previewURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/5\/475015\/preview.jpg?1341943165&quot;,&quot;iconURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/5\/475015\/preview_small.jpg?1341943165&quot;,&quot;dataurl&quot;:&quot;data:image\/png;base64,\/9j\/4AAQSkZJRgABAQEASABIAAD\/2wBDAAMCAgICAgMCAgIDAwMDBAYEBAQEBAgGBgUGCQgKCgkICQkKDA8MCgsOCwkJDRENDg8QEBEQCgwSExIQEw8QEBD\/2wBDAQMDAwQDBAgEBAgQCwkLEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBD\/wAARCAAQABADAREAAhEBAxEB\/8QAFwAAAwEAAAAAAAAAAAAAAAAAAwUGB\/\/EACQQAAEDAwMEAwAAAAAAAAAAAAECBBEAAwYFEhMHMmFxkZLh\/8QAGAEAAwEBAAAAAAAAAAAAAAAAAAYIAgT\/xAAnEQABAwEGBgMAAAAAAAAAAAABAAIDEQQFBhJBUQcTIjGRoYGi0v\/aAAwDAQACEQMRAD8AgNd6p5rlV0rznPtRep3duov1L+qCSB8UkGWac9RJ8lWDM24MLsrJJDZvljD+j7SR\/nOLtLnE2c3nh2wE2m5ifBVAHut8mQ6USVeHFzBt3Ag2l0zto2Od9nZW+1nJY8RF3YlJIkEJj9rqqSolc4yOznvvr5RTYFhaYlZUJkJooihov\/\/Z&quot;,&quot;accentcolor&quot;:null,&quot;textcolor&quot;:null,&quot;updateURL&quot;:&quot;https:\/\/www.getpersonas.com\/en-US\/update_check\/475015&quot;,&quot;version&quot;:&quot;1341943165&quot;}'),
    'mx' => array('persona' => '{&quot;id&quot;:&quot;475115&quot;,&quot;name&quot;:&quot;Flag of Mexico&quot;,&quot;category&quot;:null,&quot;description&quot;:&quot;&quot;,&quot;author&quot;:&quot;MozThemes&quot;,&quot;username&quot;:&quot;mozthemes&quot;,&quot;headerURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/5\/475115\/Persona_mexico-1.jpg?1342039329&quot;,&quot;footerURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/5\/475115\/footer_persona_mexico.jpg?1342039329&quot;,&quot;detailURL&quot;:&quot;http:\/\/www.getpersonas.com\/persona\/475115&quot;,&quot;previewURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/5\/475115\/preview.jpg?1342039329&quot;,&quot;iconURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/5\/475115\/preview_small.jpg?1342039329&quot;,&quot;dataurl&quot;:&quot;data:image\/png;base64,\/9j\/4AAQSkZJRgABAQEASABIAAD\/2wBDAAMCAgICAgMCAgIDAwMDBAYEBAQEBAgGBgUGCQgKCgkICQkKDA8MCgsOCwkJDRENDg8QEBEQCgwSExIQEw8QEBD\/2wBDAQMDAwQDBAgEBAgQCwkLEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBD\/wAARCAAQABADAREAAhEBAxEB\/8QAFQABAQAAAAAAAAAAAAAAAAAABwb\/xAAgEAABBAMAAgMAAAAAAAAAAAABAgMEEQAFIRIxQXGB\/8QAFwEAAwEAAAAAAAAAAAAAAAAAAwUGCP\/EACERAAICAQIHAAAAAAAAAAAAAAECABEDBBIFEyIxQVHh\/9oADAMBAAIRAxEAPwAs3m20qYz7UmCpbrh8kOtyFUn8JFj7GRaMvmbM1mnzhg6NQ9UPsJ56ll4rAqyfV9w4qooyF93eIcyK45ZWQoKHPL5xepIlzqsaP0gSelaloukpCFd4KNYfm1E54dvM\/9k=&quot;,&quot;accentcolor&quot;:null,&quot;textcolor&quot;:null,&quot;updateURL&quot;:&quot;https:\/\/www.getpersonas.com\/en-US\/update_check\/475115&quot;,&quot;version&quot;:&quot;1342039329&quot;}'),
    'gb' => array('persona' => '{&quot;id&quot;:&quot;475013&quot;,&quot;name&quot;:&quot;Great Britain Flag&quot;,&quot;category&quot;:null,&quot;description&quot;:&quot;&quot;,&quot;author&quot;:&quot;MozThemes&quot;,&quot;username&quot;:&quot;mozthemes&quot;,&quot;headerURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/3\/475013\/Persona_GB1a.jpg?1341942981&quot;,&quot;footerURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/3\/475013\/footer_persona_gb.jpg?1341942981&quot;,&quot;detailURL&quot;:&quot;http:\/\/www.getpersonas.com\/persona\/475013&quot;,&quot;previewURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/3\/475013\/preview.jpg?1341942981&quot;,&quot;iconURL&quot;:&quot;http:\/\/getpersonas-cdn.mozilla.net\/static\/1\/3\/475013\/preview_small.jpg?1341942981&quot;,&quot;dataurl&quot;:&quot;data:image\/png;base64,\/9j\/4AAQSkZJRgABAQEASABIAAD\/2wBDAAMCAgICAgMCAgIDAwMDBAYEBAQEBAgGBgUGCQgKCgkICQkKDA8MCgsOCwkJDRENDg8QEBEQCgwSExIQEw8QEBD\/2wBDAQMDAwQDBAgEBAgQCwkLEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBD\/wAARCAAQABADAREAAhEBAxEB\/8QAFgABAQEAAAAAAAAAAAAAAAAABwAD\/8QAJhAAAAUDAwMFAAAAAAAAAAAAAQIDBAUGBxEAEiEIIkETI1Jykf\/EABYBAQEBAAAAAAAAAAAAAAAAAAUHBP\/EAC8RAAECAwYEAwkAAAAAAAAAAAECAwQFEQAGEhRBYQchcbETMUIWIiU0Q4GCkcH\/2gAMAwEAAhEDEQA\/AEuuZSvTNIyQq+31pqNjoVMWEeWcepHTZBwJkwRUVUAqg8Cb2t4+c6xSly8byCxKkYRqE0qOutq7PILhvCRGcn0W7EOL51IVRW6aJSCOhpp5CxfVNy5FJMrZx1MMmjbAgZjR0WqmmYPjkpGyY\/ohpP2RvLGnFGO06qJ7WHVxG4eSf3ZPLMZGqgkd8dqF6kJdZVWPvTRzCqNxTN1pZqBY+Z2lHaIHUIT0XQBgexZMQHnI6ocfcqBiV5mAUWXNCkn+GvcbWjkqv\/NZcxkYuj8Pq24AtP2B5A7pwne2ziy9lbyLmPZ2r2J5ZXuJCOiFjpDOR4BqqcG7nHkW6qX1HR6o+8cgHxBrMND1CgV+\/I\/kEneyqYK595vknTAvn0qq4yTt9RA6eIBb\/9k=&quot;,&quot;accentcolor&quot;:null,&quot;textcolor&quot;:null,&quot;updateURL&quot;:&quot;https:\/\/www.getpersonas.com\/en-US\/update_check\/475013&quot;,&quot;version&quot;:&quot;1341942981&quot;}'),
    'cn' => array('persona' => ''),
    'us' => array('persona' => ''),
    'in' => array('persona' => ''),
    'jp' => array('persona' => ''),
    'de' => array('persona' => ''),
    'ru' => array('persona' => ''),
    'id' => array('persona' => ''),
    'fr' => array('persona' => ''),
    'ng' => array('persona' => ''),
    'kr' => array('persona' => ''),
    'ir' => array('persona' => ''),
    'tr' => array('persona' => ''),
    'vn' => array('persona' => ''),
    'ph' => array('persona' => ''),
    'pk' => array('persona' => ''),
    'es' => array('persona' => ''),
    'ca' => array('persona' => ''),
    'co' => array('persona' => ''),
    'pl' => array('persona' => ''),
    'eg' => array('persona' => ''),
    'au' => array('persona' => ''),
    'th' => array('persona' => ''),
    'my' => array('persona' => ''),
    'tw' => array('persona' => ''),
    'ma' => array('persona' => ''),
    'ua' => array('persona' => ''),
    'nl' => array('persona' => ''),
    'sa' => array('persona' => ''),
    've' => array('persona' => ''),
    'cl' => array('persona' => ''),
    'pe' => array('persona' => ''),
    'se' => array('persona' => ''),
    'be' => array('persona' => ''),
    'ro' => array('persona' => ''),
    'cz' => array('persona' => ''),
    'hu' => array('persona' => ''),
    'ch' => array('persona' => ''),
    'at' => array('persona' => ''),
    'kz' => array('persona' => ''),
    'il' => array('persona' => ''),
    'pt' => array('persona' => ''),
    'gr' => array('persona' => ''),
    'hk' => array('persona' => ''),
    'fi' => array('persona' => ''),
    'dk' => array('persona' => '')
);

// Sort by key
ksort($personas);

// Detect if the user is viewing the page with Firefox.
// TODO: Detect Firefox version?
$is_firefox = strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false;
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">

    <!-- Use style tag due to css file issues on getpersonas. -->
    <style>
/* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
    display: block;
}
body {
    line-height: 1;
}
ol, ul {
    list-style: none;
}
blockquote, q {
    quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
    content: '';
    content: none;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}

/* For modern browsers */
.clearfix:before,
.clearfix:after {
    content:"";
    display:table;
}
.clearfix:after {
    clear:both;
}
/* For IE 6/7 (trigger hasLayout) */
.clearfix {
    zoom:1;
}


@font-face {
    font-family: 'Open Sans';
    src: url('fonts/OpenSans-Italic-webfont.eot');
    src: url('fonts/OpenSans-Italic-webfont.eot?#iefix') format('embedded-opentype'),
         url('fonts/OpenSans-Italic-webfont.woff') format('woff'),
         url('fonts/OpenSans-Italic-webfont.ttf') format('truetype'),
         url('fonts/OpenSans-Italic-webfont.svg#OpenSansRegular') format('svg');
    font-weight: normal;
    font-style: italic;
}

@font-face {
    font-family: 'Open Sans Light';
    src: url('fonts/OpenSans-Light-webfont.eot');
    src: url('fonts/OpenSans-Light-webfont.eot?#iefix') format('embedded-opentype'),
         url('fonts/OpenSans-Light-webfont.woff') format('woff'),
         url('fonts/OpenSans-Light-webfont.ttf') format('truetype'),
         url('fonts/OpenSans-Light-webfont.svg#OpenSansLight') format('svg');
    font-weight: normal;
    font-style: normal;
}

body {
    background: url("images/bg.png") #e3e9ee repeat;
    color: #484848;
}

#container {
    background: url("images/header-bg.jpg") no-repeat;
    min-height: 670px;
}

#show-us-msg,
#customize-msg,
#callout-msg {
    text-shadow: #fafafa 1px 1px 1px;
}

#show-us-msg {
    font-family: 'Open Sans Light', sans-serif;
    font-weight: normal;
    font-size: 68px;
    letter-spacing: -1px;
    margin: 0 auto;
    padding-top: 40px;
    text-align: center;
    width: 580px;
}

#cauldron {
    background: url('images/cauldron.png') no-repeat;
    float: right;
    height: 441px;
    margin: 0 50px -150px -50px;
    width: 403px;
}

#customize-msg {
    font-family: 'Open Sans Light', sans-serif;
    font-weight: normal;
    font-size: 28px;
    margin: 60px 0 0 80px;
    position: relative;
    width: 340px;
}

#callout-msg {
    font-family: 'Open Sans', sans-serif;
    font-size: 18px;
    font-style: italic;
    font-weight: normal;
    margin: 30px 0 0 80px;
    position: relative;
}

.arrow {
    background: url('images/arrow.png');
    display: inline-block;
    height: 14px;
    vertical-align: bottom;
    width: 17px;
}

#personas {
    background: transparent;
    background: rgba(197, 197, 197, 0.24);
    box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.9), inset 0px 0px 3px rgba(0, 0, 0, 0.01), inset 0px 0px 3px rgba(0, 0, 0, 0.03);
    clear: both;
    margin: 50px auto 0;
    padding: 20px 15px;
    position: relative;
    width: 740px;
}

#personas li {
    float: left;
    height: 100px;
    margin: 0 10px;
    width: 165px;
}

#personas img {
    cursor: pointer;
    width: 165px;
}

#personas span {
    font-family: 'Open Sans Light', sans-serif;
    font-size: 16px;
}

#fan-box {
    background: #FFFFFF;
    box-shadow: 1px 1px rgba(0, 0, 0, 0.05);
    margin: 50px auto 20px;
    min-height: 90px;
    position: relative;
    width: 770px;
}

#fan-box img {
    bottom: 0;
    position: absolute;
    left: 0;
}

#see-all-msg {
    bottom: 20px;
    font-family: 'Open Sans', sans-serif;
    font-size: 18px;
    font-style: italic;
    font-weight: normal;
    position: absolute;
    right: 20px;
    text-align: right;
    width: 210px;
}

#see-all-msg a {
    color: #2983c8;
    text-decoration: none;
}
    </style>
  </head>
  <body>
    <div id="container">
      <div id="show-us-msg"><?php echo ___('Show your support!'); ?></div>
      <div id="cauldron"></div>
      <div id="customize-msg"><?php echo ___('Customize Firefox with your nation\'s flag and join us in celebrating the global spirit of community.'); ?></div>
      <div id="callout-msg"><?php echo ___('Roll over to try, click to apply.'); ?> <i class="arrow"></i></div>

      <div id="personas">
        <ol class="clearfix">
          <?php foreach ($personas as $id => $data): ?>
            <li>
              <?php
              // Placeholder code, remove when the rest of the personas are in
              if (file_exists("images/previews/${id}.jpg")) {
                  $img_src = "images/previews/${id}.jpg";
              } else {
                  $img_src = 'http://placehold.it/200x67';
              }
              ?>
              <!--<img src="images/previews/<?php echo $id; ?>.jpg" persona="<?php echo $data['persona']; ?>"> -->
              <img src="<?php echo $img_src; ?>" persona="<?php echo $data['persona'] ?>">
              <span><?php echo get_region_name($id); ?></span>
            </li>
          <?php endforeach; ?>
        </ol>
      </div>

      <div id="fan-box">
        <img src="images/browser-stack.png">
        <div id="see-all-msg">
          <a href="http://www.getpersonas.com/gallery/Designer/mozthemes" target="_parent"><?php echo ___('See more Firefox Themes »'); ?></a>
        </div>
      </div>
    </div>
    <script>
(function() {
  var aliases = {'PreviewPersona': 'PreviewBrowserTheme',
           'ResetPersona': 'ResetBrowserThemePreview',
           'SelectPersona': 'InstallBrowserTheme'};
  var persona_previews = document.querySelectorAll('#personas img');

  for (var k = 0; k < persona_previews.length; k++) {
    var item = persona_previews[k];
    item.setAttribute('data-browsertheme', item.getAttribute('persona'));

    item.addEventListener('mouseover', preview_mouseover, false);
    item.addEventListener('mouseout', preview_mouseout, false);
    item.addEventListener('click', preview_click, false);
  }

  function preview_mouseover(e) {
    dispatch_persona_event('PreviewPersona', e.target);
  }

  function preview_mouseout(e) {
    dispatch_persona_event('ResetPersona', e.target);
  }

  function preview_click(e) {
    dispatch_persona_event('SelectPersona', e.target);
  }

  function dispatch_persona_event(event, preview_node) {
    dispatch_event(event, preview_node);
    if (event in aliases) {
      dispatch_event(aliases[event], preview_node);
    }
  }

  function dispatch_event(event, aNode) {
    var eventObject = document.createEvent("Events");
    eventObject.initEvent(event, true, false);
    aNode.dispatchEvent(eventObject);
  }
})();
    </script>
  </body>
</html>