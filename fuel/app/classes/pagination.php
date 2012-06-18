<?php
/**
 * Part of the Fuel framework.
 * Core クラスの拡張です。
 *
 * @package		Fuel
 * @version		1.0
 * @author		Dan Horrigan <http://dhorrigan.com>
 * @license		MIT License
 * @copyright	2010 - 2011 Fuel Development Team
 */

class Pagination extends Fuel\Core\Pagination
{

	/**
	 * @var array The HTML for the display
	 */
	public static $template = array(
		'wrapper_start'           => '<div class="pagination"> ',
		'wrapper_end'             => ' </div>',
		'page_start'              => '<span class="page-links"> ',
		'page_end'                => ' </span>',
		'previous_start'          => '<span class="previous"> ',
		'previous_end'            => ' </span>',
		'previous_inactive_start' => ' <span class="previous-inactive">',
		'previous_inactive_end'   => ' </span>',
		'previous_mark'           => '&lt; ',
		'next_start'              => '<span class="next"> ',
		'next_end'                => ' </span>',
		'next_inactive_start'     => ' <span class="next-inactive">',
		'next_inactive_end'       => ' </span>',
		'next_mark'               => ' &gt;',
		'first_start'             => '<span class="first"> ',
		'first_end'               => ' </span>',
		'first_inactive_start'    => '<span class="first-inactive">',
		'first_inactive_end'      => ' </span>',
		'first_mark'              => '&laquo; ',
		'last_start'              => '<span class="last"> ',
		'last_end'                => ' </span>',
		'last_inactive_start'     => '<span class="last-inactive">',
		'last_inactive_end'       => ' </span>',
		'last_mark'               => ' &raquo;',
		'active_start'            => '<span class="active"> ',
		'active_end'              => ' </span>',
		'regular_start'           => '',
		'regular_end'             => '',
	);

	// --------------------------------------------------------------------

	/**
	 * Creates the pagination links
	 *
	 * @access public
	 * @return mixed    The pagination links
	 */
	public static function create_links()
	{
		if (static::$total_pages == 1)
		{
			return '';
		}

		\Lang::load('pagination', true);

		$pagination  = static::$template['wrapper_start'];
		$pagination .= static::first_link(\Lang::get('pagination.first'));		// 「最初」リンクを拡張
		$pagination .= static::prev_link(\Lang::get('pagination.previous'));
		$pagination .= static::page_links();
		$pagination .= static::next_link(\Lang::get('pagination.next'));
		$pagination .= static::last_link(\Lang::get('pagination.last'));		// 「最後」リンクを拡張
		$pagination .= static::$template['wrapper_end'];

		return $pagination;
	}

	// --------------------------------------------------------------------

	/**
	 * Pagination "First" link
	 *
	 * @access public
	 * @param string $value The text displayed in link
	 * @return mixed    The first link
	 */
	public static function first_link($value)
	{
		if (static::$total_pages == 1)
		{
			return '';
		}

		return (static::$current_page != 1) ?
			static::$template['first_start'].\Html::anchor(rtrim(static::$pagination_url, '/'). '/', static::$template['first_mark'].$value).static::$template['first_end'] : '';
	}

// --------------------------------------------------------------------

	/**
	 * Pagination "Last" link
	 *
	 * @access public
	 * @param string $value The text displayed in link
	 * @return mixed    The last link
	 */
	public static function last_link($value)
	{
		if (static::$total_pages == 1)
		{
			return '';
		}

		return (static::$current_page < static::$total_pages) ?
			static::$template['last_start'].\Html::anchor(rtrim(static::$pagination_url, '/'). '/'.static::$total_pages, $value.static::$template['last_mark']).static::$template['last_end'] : '';
	}
}
/* End of pagination.php */