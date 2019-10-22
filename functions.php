<?php 

function revolution_build_search_array() {
    $request = Zend_Controller_Front::getInstance()->getRequest();
    $requestArray = $request->getParams();
    
    return $requestArray;
}

function revolution_get_current_tags() {
    if (isset($_GET['tags'])) {
      $tags = $_GET['tags'];
    } else {
      $tags = '';
    }
    
    return $tags;
}

function revolution_display_item_type_icons($item) {
    $tags = $item->Tags;
    $itemTypes = revolution_get_item_type_icons();
    $tagStrings = array();
    $html = '';

    foreach ($tags as $tag) {
        $name = $tag['name'];
        $tagStrings[] = html_escape($name);
    }

    $foundTags = array_intersect($tagStrings, array_flip($itemTypes));

    foreach ($foundTags as $foundTagName) {
        $html .= '<i class="' . $itemTypes[$foundTagName] . '"></i>';
    }
    return $html;
}

function revolution_get_item_type_icons() {
    $itemTypes = array(
        'Text' => 'far fa-file-alt',
        'Image' => 'far fa-file-image',
        'Map' => 'far fa-map',
        'Timeline' => 'far fa-calendar-alt',
        'Song' => 'fas fa-music',
        'Glossary' => 'fas fa-book',  
    );
    return $itemTypes;
}

function revolution_get_sorted_tags() {
    $tags = get_records('Tag', array(), 0);
    $sortedTags = array();
    $itemTypes = revolution_get_item_type_icons();
    foreach ($tags as $tag) {
      $name = $tag['name'];
      if (strpos($name, 'Chapter') !== false) {
        $sortedTags['chapters'][] = $tag;
        natcasesort($sortedTags['chapters']);
      } else if (array_key_exists($name, $itemTypes)) {
        $sortedTags['item-types'][] = $tag;
      } else {
        $sortedTags['topics'][] = $tag;
        natcasesort($sortedTags['topics']);
      } 
    }
    return $sortedTags;
}

function use_foundation_navigation() {
    $view = get_view();
    $nav = new Omeka_Navigation;
    $nav->loadAsOption(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_OPTION_NAME);
    $nav->addPagesFromFilter(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_FILTER_NAME);
    $html = $view->navigation()->menu($nav)->setPartial('common/foundation-nav.php')->render();
    $view->navigation()->menu($nav)->setPartial(null);
    return $html;
}

function foundation_exhibit_page_tree($exhibit, $currentPage = null) {
    $view = get_view();
    $pages = $exhibit->PagesByParent;
    if (!($pages && isset($pages[0]))) {
        return '';
    }

    $view->_exhibit = $exhibit;
    $view->_pages = $pages;

    $ancestorIds = array();
    if ($currentPage) {
        $pagesById = $view->_exhibit->PagesById;
        $currentId = $currentPage->parent_id;
        while ($currentId) {
            $currentPage = $pagesById[$currentId];
            $ancestorIds[$currentPage->id] = $currentPage->id;
            $currentId = $currentPage->parent_id;
        }
    }
        
    $html = '<ul class="vertical menu"';
    foreach ($pages[0] as $topPage) {
        if ($currentPage && $topPage->id === $currentPage->id) {
            $html = '<li class="current">';
        } else if ($ancestorIds && isset($ancestorIds[$topPage->id])) {
            $html = '<li class="parent">';
        } else {
            $html = '<li>';
        }

        $html .= '<a href="' . exhibit_builder_exhibit_uri($view->_exhibit, $topPage) . '">'
              . metadata($topPage, 'menu_title') .'</a>';
        if (isset($view->_pages[$page->id])) {
            $html .= '<ul>';
            foreach ($view->_pages[$page->id] as $childPage) {
                $html .= $view->_renderPageBranch($childPage, $currentPage, $ancestorIds);
            }
            $html .= '</ul>';
        }
        $html .= '</li>';    }
    $html .= '</ul>';
    return $html;
}

function foundation_homepage_intro_background() {
    $backgroundImage = get_theme_option('Homepage Intro Background');
    if ($backgroundImage) {
        $storage = Zend_Registry::get('storage');
        $backgroundImage = $storage->getUri($storage->getPathByType($backgroundImage, 'theme_uploads'));
        return $backgroundImage;
    }
}

/**
 * Returns a breadcrumb for a given page.
 *
 * @uses public_url(), html_escape()
 * @param integer|null The id of the page.  If null, it uses the current simple page.
 * @param string $separator The string used to separate each section of the breadcrumb.
 * @param boolean $includePage Whether to include the title of the current page.
 */

function foundation_breadcrumbs($pageId = null, $seperator=null, $includePage=true)
{
    $html = '';
    
    if ($seperator) {
      $html .= '<style>.breadcrumbs li:not(:last-child)::after { content: "' . $seperator . '"; }</style>';
    }
  
    $html .= '<nav aria-label="You are here:" role="navigation"><ul class="breadcrumbs">';

    if ($pageId === null) {
        $page = get_current_record('simple_pages_page', false);
    } else {
        $page = get_db()->getTable('SimplePagesPage')->find($pageId);
    }

    if ($page) {
        $ancestorPages = get_db()->getTable('SimplePagesPage')->findAncestorPages($page->id);
        $bPages = array_merge(array($page), $ancestorPages);

        // make sure all of the ancestors and the current page are published
        foreach($bPages as $bPage) {
            if (!$bPage->is_published) {
                $html = '';
                return $html;
            }
        }

        // find the page links
        $pageLinks = array();
        foreach($bPages as $bPage) {
            if ($bPage->id == $page->id) {
                if ($includePage) {
                    $pageLinks[] = '<li><span class="current">' . html_escape($bPage->title) . '</span></li>';
                }
            } else {
                $pageLinks[] = '<li><a href="' . public_url($bPage->slug) .  '">' . html_escape($bPage->title) . '</a></li>';
            }
        }
        $pageLinks[] = '<li><a href="'. public_url('') . '">' . __('Home') . '</a></li>';

        // create the bread crumb
        $html .= implode('', array_reverse($pageLinks));
    }
    $html .= '</ul></nav>';
    return $html;
}