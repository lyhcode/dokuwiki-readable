<?php
/**
 * Template Functions
 *
 * This file provides template specific custom functions that are
 * not provided by the DokuWiki core.
 * It is common practice to start each function with an underscore
 * to make sure it won't interfere with future core functions.
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

/**
 * Create link/button to discussion page and back
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_discussion($discussNS='discussion',$link=0,$wrapper=0,$reverse=0) {
    global $ID;

    if ($reverse) {
        $discussPage   = $ID.':'.$discussNS;
        $isDiscussPage = substr($ID,-strlen($discussNS),strlen($discussNS))==$discussNS;
        $backID        = substr($ID,0,-strlen($discussNS));
    } else {
        $discussPage   = $discussNS.':'.$ID;
        $isDiscussPage = substr($ID,0,strlen($discussNS))==$discussNS;
        $backID        = strstr($ID,':');
    }

    if ($wrapper) echo "<$wrapper>";

    if($isDiscussPage) {
        if ($link)
            tpl_pagelink($backID,tpl_getLang('back_to_article'));
        else
            echo html_btn('back2article',$backID,'',array(),0,0,tpl_getLang('back_to_article'));
    } else {
        if ($link)
            tpl_pagelink($discussPage,tpl_getLang('discussion'));
        else
            echo html_btn('discussion',$discussPage,'',array(),0,0,tpl_getLang('discussion'));
    }

    if ($wrapper) echo "</$wrapper>";
}

/**
 * Create link/button to user page
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_userpage($userNS='user',$link=0,$wrapper=false) {
    if (!$_SERVER['REMOTE_USER']) return;

    global $conf;
    $userPage = $userNS.':'.$_SERVER['REMOTE_USER'].':'.$conf['start'];

    if ($wrapper) echo "<$wrapper>";

    if ($link)
        tpl_pagelink($userPage,tpl_getLang('userpage'));
    else
        echo html_btn('userpage',$userPage,'',array(),0,0,tpl_getLang('userpage'));

    if ($wrapper) echo "</$wrapper>";
}

/**
 * Use favicon.ico from data/media root directory if it exists, otherwise use
 * the one in the template's image directory.
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_getFavicon() {
    if (file_exists(mediaFN('favicon.ico')))
        return ml('favicon.ico');
    return DOKU_TPL.'images/favicon.ico';
}

function amdy_tpl_link_as_li($url, $name, $more = '', $return = false) {
    $out = '<li><a href="' . $url . '" ';
    if ($more)
        $out .= ' ' . $more;
    $out .= ">$name</a></li>";
    if ($return)
        return $out;
    print $out;
    return true;
}
function amdy_tpl_breadcrumbs() {
    global $lang;
    global $conf;

    //check if enabled
    if (!$conf['breadcrumbs'])
        return false;

    $crumbs = breadcrumbs(); //setup crumb trace
    //render crumbs, highlight the last one
    print '<ul class="breadcrumb">';
    $last = count($crumbs);
    $i = 0;
    foreach ($crumbs as $id => $name) {
        $i++;
        echo '<li' . ($i == $last ? ' class="active"' : '') . '>';
        //echo '<a href="test.php">test</a>';
        echo ('<a href="' . wl($id) . '" title="' . $id . '"' . '>' . hsc($name) . '</a>');
        if ($i != $last) {
            echo '<span class="divider">/</span>';
        }
        echo '</li>';
    }
    print '</ul>';
    return true;
}
/**
 * Print the search form
 *
 * If the first parameter is given a div with the ID 'qsearch_out' will
 * be added which instructs the ajax pagequicksearch to kick in and place
 * its output into this div. The second parameter controls the propritary
 * attribute autocomplete. If set to false this attribute will be set with an
 * value of "off" to instruct the browser to disable it's own built in
 * autocompletion feature (MSIE and Firefox)
 *
 */
function amdy_tpl_searchform($ajax=true,$autocomplete=true){
    global $lang;
    global $ACT;
    global $QUERY;

    // don't print the search form if search action has been disabled
    if (!actionOk('search')) return false;

    print '<form action="'.wl().'" accept-charset="utf-8" class="navbar-search pull-right search" id="dw__search" method="get"><div class="no">';
    print '<input type="hidden" name="do" value="search" />';
    print '<input type="text" ';
    if($ACT == 'search') print 'value="'.htmlspecialchars($QUERY).'" ';
    if(!$autocomplete) print 'autocomplete="off" ';
    print 'id="qsearch__in" accesskey="f" name="id" class="input-medium search-query edit" title="[F]" />';
    print '<input type="submit" value="'.$lang['btn_search'].'" class="btn button" title="'.$lang['btn_search'].'" />';
    if($ajax) print '<div id="qsearch__out" class="ajax_qsearch JSpopup"></div>';
    print '</div></form>';
    return true;
}

