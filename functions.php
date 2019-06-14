<?php 


function use_foundation_navigation() {
    $view = get_view();
    $nav = new Omeka_Navigation;
    $nav->loadAsOption(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_OPTION_NAME);
    $nav->addPagesFromFilter(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_FILTER_NAME);
    return $view->navigation()->menu($nav)->setPartial('common/foundation-nav.php')->render();
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