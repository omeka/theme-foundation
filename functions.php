<?php 

function use_foundation_navigation($ulClass) {
    $view = get_view();
    $nav = new Omeka_Navigation;
    $nav->loadAsOption(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_OPTION_NAME);
    $nav->addPagesFromFilter(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_FILTER_NAME);
    $html = $view->navigation()->menu($nav)->setPartial('common/foundation-nav.php')->setUlClass($ulClass)->render();
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

function foundation_random_featured_records_html($recordType)
{
    $html = '';

    $recordSinglePartial = [
        'exhibit' => 'exhibit-builder/exhibits/single.php',
        'collection' => 'collections/single.php',
        'item' => 'items/single.php',
    ];

    $featuredRecords =  get_records(ucfirst($recordType), array('featured' => 1,
                                     'sort_field' => 'random'), 1);

    if ($featuredRecords) {
        foreach ($featuredRecords as $featuredRecord) {
            $html .= get_view()->partial($recordSinglePartial[$recordType], array(
                $recordType => $featuredRecord,
                'thumbnailSize' => 'fullsize',
                'featured' => 'featured',
            ));
        }
    }
    
    if ($recordType == 'exhibit') {
        $html = apply_filters('exhibit_builder_display_random_featured_exhibit', $html);
    }
    
    return $html;
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

function foundation_display_attached_media($item, $layout) {
    $html = '';
    $view = get_view();
    switch ($layout) {
        case 'lightgallery':
            $html .= lightgallery($item->Files);
            break;
        case 'lightgallery-list':
            $html .= lightgallery_other_files($item->Files);
            break;
        case 'list':
            $html .= $view->partial('common/media-list.php', [
                'files' => $item->Files,
            ]);
            break;
        case 'grid':
            $html .= item_image_gallery(array(
                'wrapper' => array(
                    'class' => 'media-grid'
                ),
                'linkWrapper' => array(
                    'class' => 'item-file',
                ),
                'link' => array(
                    'class' => 'thumbnail',
                ),
            ));
            break;
        case 'embed':
            $html .= '<div id="item-images" class="media-embed">';
            $html .= files_for_item(array(
                        'imageSize' => 'fullsize',
                    )); 
            $html .= '</div>';
            break;
    }
    return $html;
}

function foundation_mobile_theme_logo() {
    $logo = get_theme_option('mobile_logo');
    if ($logo) {
        $storage = Zend_Registry::get('storage');
        $uri = $storage->getUri($storage->getPathByType($logo, 'theme_uploads'));
        return '<img src="' . $uri . '" alt="' . option('site_title') . '" />';
    }
}

function foundation_theme_banner()
{
    $banner = get_theme_option('Banner');
    $view = get_view();
    $storage = Zend_Registry::get('storage');
    $uri = $storage->getUri($storage->getPathByType($banner, 'theme_uploads'));
    return $uri;
}

add_translation_source(dirname(__FILE__) . '/languages');