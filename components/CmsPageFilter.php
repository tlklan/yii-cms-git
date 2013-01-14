<?php
/**
 * CmsPageFilter class file.
 * @author Christoffer Niska <christoffer.niska@nordsoftware.com>
 * @copyright Copyright &copy; 2011, Nord Software Ltd
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package cms.components
 */

/**
 * Filter class that validates the page URL and redirects the request with status 301
 * in case an incorrect URL was requested.
 */
class CmsPageFilter extends CFilter
{
	/**
	 * Performs the pre-action filtering.
	 * @param CFilterChain $filterChain the filter chain that the filter is on
	 * @return boolean whether the filtering process should continue and the action
	 * should be executed
	 */
	protected function preFilter($filterChain)
	{
		$controller = $filterChain->controller;

		if (isset($_GET['id']) && method_exists($controller, 'loadModel'))
		{
			$model = $controller->loadModel($_GET['id']);

			// Prevent accessing of unpublished and block-level nodes.
			if (!$model->published || $model->level !== CmsNode::LEVEL_PAGE)
				throw new CHttpException(404, Yii::t('CmsModule.core', 'The requested page does not exist.'));
		}

		return parent::preFilter($filterChain);
	}
}
