<?php
/**
 * @package WordPress
 * @subpackage Pressabl
 * @since Pressabl 1.0
 *
 */


/**
 * Breadcrumbs class
 * Adapted from the Breadcrumb Navigation XT plugin
 * @since 0.1
 */
/*	----------------------------------------------------------------------------
         ____________________________________________________
        |                                                    |
        |             Breadcrumb Navigation XT               |
        |                  Michael Woehrer                   |
        |                    John Havlik                     |
        |____________________________________________________|

	Copyright 2006-2007 Michael Woehrer (michael dot woehrer at gmail dot com)
	Portions Copyright 2007 John Havlik (mtekkmonkey at gmail dot com)

    --------------------------------------------------------------------------*/
class breadcrumb_navigation_xt {

/*==============================================================================
    					=== VARIABLES ===
  ============================================================================*/

	var $opt;	// array containing the options


/*==============================================================================
    					=== CONSTRUCTOR ===
  ============================================================================*/
	function breadcrumb_navigation_xt() {
		$this->opt = array(
			// Assuming your Wordpress URL is http://www.site.com:
			//  a) If you have a standard WP installation (www.site.com displays latest 10 posts)
			//     then use FALSE
			//  b) If you have a static front page by using a WordPress page on http://www.site.com and
			//     your blog is available at http://www.site.com/blog/, then use TRUE
			'static_frontpage' => false,

				//*** only used if 'static_frontpage' => true
					// Relative URL for your blog\'s address that is used for the Weblog link.
					// Use it if your blog is available at http://www.site.com/myweblog/,
					// and at http://www.site.com/ a Wordpress page is being displayed:
					// In this case apply '/myweblog/'.
						'url_blog' => '',

					// Display HOME? If set to false, HOME is not being displayed.
						'home_display' => true,
					// URL for the home link
						'url_home' => home_url(),
					// Apply a link to HOME? If set to false, only plain text is being displayed.
						'home_link' => true,
					// Text displayed for the home link, if you don\'t want to call it home then just change this.
					// Also, it is being checked if the current page title = this variable. If yes, only the Home link is being displayed,
					// but not a weird "Home / Home" breadcrumb.
						'title_home' => 'Home',

			// Text displayed for the weblog. If "\'static_frontpage\' => false", you
			// might want to change this value to "Home"
				'title_blog' => 'Weblog',

			// Separator that is placed between each item in the breadcrumb navigation, but not placed before
			// the first and not after the last element. You also can use images here,
			// e.g. '<img src="separator.gif" title="separator" width="10" height="8" />'
				'separator' => ' / ',
			// Text displayed for the search page.
				'title_search' => 'Search',
			// Prefix for a author page
				'author_prefix' => 'Posts by ',
			// Suffix for a author page
				'author_suffix' => '',
			// Name format to display for author (e.g., nickname, first_name, last_name, display_name)
				'author_display' => 'display_name',
			// Prefix for a single blog article.
				'singleblogpost_prefix' => '',
			// Suffix for a single blog article.
				'singleblogpost_suffix' => '',
			// Prefix for a page.
				'page_prefix' => '',
			// Suffix for a page.
				'page_suffix' => '',
			// The prefix that is used for mouseover link (e.g.: "Browse to: Archive")
				'urltitle_prefix' => 'Browse to: ',
			// The suffix that is used for mouseover link
				'urltitle_suffix' => '',
			// Prefix for categories.
				'archive_category_prefix' => 'Archive by category &#39;',
			// Suffix for categories.
				'archive_category_suffix' => '&#39;',
			// Prefix for archive by year/month/day
				'archive_date_prefix' => 'Archive: ',
			// Suffix for archive by year/month/day
				'archive_date_suffix' => '',
			// Prefix for tags (Simple Tagging Plugin)
				'tag_page_prefix' => 'Tag: ',
			// Prefix for tags (Simple Tagging Plugin)
				'tag_page_suffix' => '',
			// Text displayed for a 404 error page, , only being used if 'use404' => true
				'title_404' => '404',
			// Display current item as link?
				'link_current_item' => false,
			// URL title of current item, only being used if 'link_current_item' => true
				'current_item_urltitle' => 'Link of current page (click to refresh)',
			// Style or prefix being applied as prefix to current item. E.g. <span class="bc_current">
				'current_item_style_prefix' => '',
			// Style or prefix being applied as suffix to current item. E.g. </span>
				'current_item_style_suffix' => '',
			// Maximum number of characters of post title to be displayed? 0 means no limit.
				'posttitle_maxlen' => 0,
			// Display category when displaying single blog post
				'singleblogpost_category_display' => false,
			// Maximum number of categories to display in the breadcrumb. O means no limit.
				'singleblogpost_category_maxdisp' => 0,
			// Prefix for single blog post category, only being used if 'singleblogpost_category_display' => true
				'singleblogpost_category_prefix' => '',
			// Suffix for single blog post category, only being used if 'singleblogpost_category_display' => true
				'singleblogpost_category_suffix' => '',

		);
	} // END function breadcrumb (constructor)

/*==============================================================================
    				=== DISPLAY BREADCRUMB ===
  ============================================================================*/
	function display() {

		global $wpdb, $post, $wp_query;

		////////////////////////////////////////////////////////////////////////
		// Needed links
		////////////////////////////////////////////////////////////////////////
		/* -------- HOME LINK -------- */
		$bcn_homelink = '';
		if ( ( $this->opt['static_frontpage'] === true ) AND ( $this->opt['home_display'] === true ) ) {		// Hide HOME if it is disabled in the options
			if ( $this->opt['home_link'] === true )			// Link home or just display text
				$bcn_homelink = '<a href="' . $this->opt['url_home'] . '" title="' . $this->opt['urltitle_prefix'] . $this->opt['title_home'] . $this->opt['urltitle_suffix'] . '">' . $this->opt['title_home'] . '</a>';
			else
				$bcn_homelink = $this->opt['title_home'];
		}

		/* -------- BLOG LINK -------- */
		$bcn_bloglink = '<a href="' . home_url() . $this->opt['url_blog'] . '" title="' . $this->opt['urltitle_prefix'] . $this->opt['title_blog'] . $this->opt['urltitle_suffix'] . '">' . $this->opt['title_blog'] . '</a>';

		/* -------- CURRENT ITEM -------- */
		$curitem_urlprefix = '';
		$curitem_urlsuffix = '';
		if ( $this->opt['link_current_item'] ) {
			$curitem_urlprefix = '<a title="' . $this->opt['current_item_urltitle'] . '" href="' . esc_url( $_SERVER['REQUEST_URI'] ) . '">';
			$curitem_urlsuffix = '</a>';
		}

		////////////////////////////////////////////////////////////////////////
		// Get the different types
		////////////////////////////////////////////////////////////////////////
		if ( is_search() )                        $swg_type = 'search';      // Search
		elseif ( is_page() )                      $swg_type = 'page';        // Page
		elseif ( is_single() )                    $swg_type = 'singlepost';  // Single post page
		elseif ( is_author() )                    $swg_type = 'author';      // Author page
		elseif ( is_archive() && is_category() )  $swg_type = 'categories';  // Weblog Categories
		elseif ( is_archive() && !is_category() ) $swg_type = 'blogarchive'; // Weblog Archive
		elseif ( is_404() )                       $swg_type = '404';         // 404
		elseif ( class_exists( 'SimpleTagging' ) ) {
			if ( STP_IsTagView() )                 $swg_type = 'tag';
		}
		else                                      $swg_type = 'else';      // Everything else (should be weblog article list only)


		/* *************************************************
			Here we set the initial array $result_array. We use this for being able
			to apply styles, anchors etc. to each element.
			Default is set to false.
		************************************************* */
		$result_array = array(
			'middle' => false,	// The part between "Home" and the last element of the breadcrumb.
			'last' => array(	// The last element of the breadcrumb
					'prefix' => false,	// prefix
					'title' => false,	// text
					'suffix' => false	// suffix
				  )
			);


		switch ( $swg_type ) {

		case 'page':
			////////////////////////////////////////////////////////////////////
			// Get Pages
			////////////////////////////////////////////////////////////////////
			$bcn_pagetitle = trim( wp_title( '', false ) );	// page title, we do not use "$post->post_title" since it could display
														// 	wrong title if theme uses more than one LOOP.
			$bcn_theparentid = $post->post_parent;	// id of the parent page

			$bcn_loopcount = 0;	// counter for the array
			while( 0 != $bcn_theparentid ) {
				// Get the row of the parent\'s page;
				// 	*** Regarding performance this is not a perfect solution since this query is inside a loop ! ***
				//		However, the number of queries is reduced to the number of parents.
				$mylink = $wpdb->get_row( "SELECT post_title, post_parent FROM $wpdb->posts WHERE ID = '$bcn_theparentid;'" );

				// Title of parent into array incl. current permalink (via $bcn_theparentid,
				// since we set this variable below we can use it here as current id!)
				$bcn_titlearray[$bcn_loopcount] = '<a href="' . get_permalink( $bcn_theparentid ) . '" title="' . $this->opt['urltitle_prefix'] . $mylink->post_title . $this->opt['urltitle_suffix'] . '">' . $mylink->post_title . '</a>';

				// New parent ID of parent
				$bcn_theparentid = $mylink->post_parent;

				$bcn_loopcount++;
			}	// while

			if (is_array( $bcn_titlearray ) ) {
				// Reverse the array since it is in a reverse order
				$bcn_titlearray = array_reverse( $bcn_titlearray );

				// Prepare the output by looping thru the array. We use $sep for not adding the separator before the first element
				$count = 0;
				foreach ( $bcn_titlearray as $val ) {
					$sep = '';
					if (0 != $count)
						$sep = $this->opt['separator'];

					$page_result = $page_result . $sep . $val;

					$count++;
				}
			}

			// Result
			// If we have a front page named \'Home\' (or similar), we do not want to display the Breadcrumb like this: Home / Home
			// Therefore do not display the Home Link if such certain page is being displayed.
			if ( strtolower( $bcn_pagetitle ) != strtolower( $this->opt['title_home'] ) ) {  // Check if we are not on home
				if ($page_result != '') $result_array['middle'] = $page_result;
				$result_array['last']['prefix'] = $this->opt['page_prefix'];
				$result_array['last']['title'] = $bcn_pagetitle;
				$result_array['last']['suffix'] = $this->opt['page_suffix'];
			}

			break; // end of case \'page\'

		case 'search':
			////////////////////////////////////////////////////////////////////
			// Get Search
			////////////////////////////////////////////////////////////////////

			$result_array['last']['title'] = $this->opt['title_search'];

			break; // end of case \'search\'

		case 'author':
			////////////////////////////////////////////////////////////////////
			// Get author page
			////////////////////////////////////////////////////////////////////

			// Blog link
			$result_array['middle'] = $bcn_bloglink;
			// Author test
			$result_array['last']['prefix'] = $this->opt['author_prefix'];
			// Get the Author name, note it is an array
			$curauth = ( get_query_var( 'author_name' ) ) ? get_userdatabylogin( get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
			// Get the Author display type
			$authdisp = $this->opt['author_display'];
			// Make sure user picks only safe values
			if ( $authdisp == 'nickname' || $authdisp == 'nickname' || $authdisp == 'first_name' || $authdisp == 'last_name' || $authdisp == 'display_name' )
				$result_array['last']['title'] = $curauth->$authdisp;
			$result_array['last']['suffix'] = $this->opt['author_suffix'];
			break; // end of case \'author\'

		case 'singlepost':
			////////////////////////////////////////////////////////////////////
			// Get single blog post
			////////////////////////////////////////////////////////////////////

			$bcn_pagetitle = trim( wp_title('', false ) );	// page title, we do not use "$post->post_title" since it could display
														// 	wrong title if theme uses more than one LOOP.

			$result_array['middle'] = $bcn_bloglink;

			// Add category
			if($this->opt['singleblogpost_category_display'] === true) {
				// Apply limit to category if set
				if($this->opt['singleblogpost_category_maxdisp'] > 0)
				{
					$category_temp = explode( ",", get_the_category_list( ', ' ) );
					$category_list = $category_temp[0];
					for( $i = 1; $i < $this->opt['singleblogpost_category_maxdisp']; $i++ ) {
						// Only go through if there is a category, else exit loop
						if ( $category_temp[$i] )
							$category_list .= ',' . $category_temp[$i];
						else
							$i = $this->opt['singleblogpost_category_maxdisp'] + 2;
					}
				}
				else
					$category_list = get_the_category_list( ', ');
				$category_temp = explode( ',', get_the_category_list( ', ' ) );
				$result_array['middle'] .= $this->opt['separator'] . $this->opt['singleblogpost_category_prefix'] . $category_list . $this->opt['singleblogpost_category_suffix'];
			}

			$result_array['last']['prefix'] = $this->opt['singleblogpost_prefix'];

			// Restrict the length of the title...
			$bcn_post_title = $bcn_pagetitle;
			if ( ( $this->opt['posttitle_maxlen'] >= 1 ) and ( strlen( $bcn_post_title ) > $this->opt['posttitle_maxlen'] ) )
				$bcn_post_title = substr( $bcn_post_title, 0, $this->opt['posttitle_maxlen'] -1 ) . '...';
			$result_array['last']['title'] = $bcn_post_title;

			$result_array['last']['suffix'] = $this->opt['singleblogpost_suffix'];

			break;

		case 'categories':
			////////////////////////////////////////////////////////////////////
			// Get Category and Parent Categories
			////////////////////////////////////////////////////////////////////
			$result_array['middle'] = $bcn_bloglink;

			$object = $wp_query->get_queried_object();

			// Get parents of current category
			$parent_id  = $object->category_parent;
			$cat_breadcrumbs = '';
			while ( $parent_id ) {
				$category   = get_category( $parent_id );
				$cat_breadcrumbs = '<a href="' . get_category_link( $category->cat_ID ) . '" title="' . $this->opt['urltitle_prefix'] . $category->cat_name . $this->opt['urltitle_suffix'] . '">' . $category->cat_name . '</a>' . $this->opt['separator'] . $cat_breadcrumbs;
				$parent_id  = $category->category_parent;
			}

			$result_array['last']['prefix'] = $this->opt['archive_category_prefix'];
			$result_array['last']['prefix'] .= $cat_breadcrumbs;

			// Current Category
			$result_array['last']['title'] = $object->cat_name;


			$result_array['last']['suffix'] = $this->opt['archive_category_suffix'];
			break;


		case 'blogarchive':
			////////////////////////////////////////////////////////////////////
			// Get Blog archive
			////////////////////////////////////////////////////////////////////

			$result_array['middle'] = $bcn_bloglink;

			if ( is_day() ) {
				// -- Archive by day
				$result_array['last']['prefix'] = $this->opt['archive_date_prefix'];
				$result_array['last']['title'] = get_the_time( 'd') . '. ' . get_the_time( 'F') . ' ' . get_the_time( 'Y' );
				$result_array['last']['suffix'] = $this->opt['archive_date_suffix'];

			}
			elseif (is_month()) {
				// -- Archive by month
				$result_array['last']['prefix'] = $this->opt['archive_date_prefix'];
				$result_array['last']['title'] = get_the_time( 'F') . ' ' . get_the_time( 'Y');
				$result_array['last']['suffix'] = $this->opt['archive_date_suffix'];
			} else if (is_year()) {
				// -- Archive by year
				$result_array['last']['prefix'] = $this->opt['archive_date_prefix'];
				$result_array['last']['title'] = get_the_time( 'Y' );
				$result_array['last']['suffix'] = $this->opt['archive_date_suffix'];
			}

			break;

		case '404':
			////////////////////////////////////////////////////////////////////
			// Get 404 error page
			////////////////////////////////////////////////////////////////////

			$result_array['last']['title'] = $this->opt['title_404'];

			break;

		case 'tag':
			/////////////////////////////////////////////
			// Get Tag Page
			/////////////////////////////////////////////
			$result_array['middle'] = $bcn_bloglink;
			$result_array['last']['prefix'] = $this->opt['tag_page_prefix'];
			$result_array['last']['title'] = STP_GetCurrentTagSet();
			$result_array['last']['suffix'] = $this->opt['tag_page_suffix'];

			break;


		case 'else':
			////////////////////////////////////////////////////////////////////
			// Get weblog article list (which is very often the front page of the blog)
			////////////////////////////////////////////////////////////////////

			$result_array['last']['title'] = $this->opt['title_blog'];

		} // switch


		////////////////////////////////////////////////////////////////////////////
		// Echo the result
		////////////////////////////////////////////////////////////////////////////

		// MIDDLE PART

		//		The first separator between HOME and the first entry
		$first_sep = '';	// display first separator only if HOME is disabled in the options AND it is a static front page
		if ( ($this->opt['static_frontpage'] === true) && ( $this->opt['home_display'] === true ) )
			$first_sep = $this->opt['separator'];


		//		get middle part and add separator(s)
		$middle_part = '';
		if ($result_array['middle'] === false) {
			// there is no middle part...

			if ($result_array['last']['title'] === false)
				$first_sep = ''; // we are on home.

		}
		else // There is a middle part...
			$middle_part = $result_array['middle'] . $this->opt['separator'];


		// LAST PART
		$last_part = '';
		if ( $result_array['last']['prefix'] !== false )
			$last_part .= $result_array['last']['prefix'];

		if ( $result_array['last']['title'] !== false )
			$last_part .= $curitem_urlprefix . $result_array['last']['title'] . $curitem_urlsuffix;

		if ( $result_array['last']['suffix'] !== false )
			$last_part .= $result_array['last']['suffix'];

		// ECHO
		$result = "\n" . '<!-- Breadcrumb, generated by "Breadcrumb Nav XT" - http://mtekk.weblogs.us/code -->' . "\n"; // Please do not remove this line.

		if ( $this->opt['static_frontpage'] === false ) {
			if ( ( $swg_type === 'page') || ( $swg_type === 'search' ) || ( $swg_type === '404') )
				$result .= $bcn_bloglink . $this->opt['separator'];
		}

		$result .= $bcn_homelink . $first_sep . $middle_part . $this->opt['current_item_style_prefix'] . $last_part . $this->opt['current_item_style_suffix'] . "\n";
		echo $result;

	} // END function display


} // END class breadcrumb_navigation_xt

