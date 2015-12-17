<?php
class autocraft_Route_PrefixAdmin_Game implements XenForo_Route_Interface{
	
	public function formatMessage($message)
	{
		if ( ! is_string($message))
		{
			$message = serialize($message);
		}

		return date('F j H:i:s') . ':' . substr((string) microtime(true),-2) . ' - : ' . $message;
	}
		/**
	 * Match a specific route for an already matched prefix.
	 *
	 * @see XenForo_Route_Interface::match()
	 */
	public function match($routePath, Zend_Controller_Request_Http $request, XenForo_Router $router)
	{
		
		$controller='';
		$action = $router->resolveActionWithStringParam($routePath, $request, 'game_title');
		$action = $router->resolveActionWithIntegerParam($routePath, $request, 'game_id');
		$actions = array_filter(explode('/', $action));
		
		switch(count($actions)){
			case 4:
				$controller='_Field';
				$request->setParam('profile_id', intval($actions[1]));
				$request->setParam('field_id', intval($actions[3]));
				$action='index';
				break;
			case 3:
				$controller='_Field';
				$request->setParam('profile_id', intval($actions[1]));
				$action='index';
				break;
			case 2:
				if($actions[0]=='profiles'){
					$controller='_Profile';
					$request->setParam('profile_id', intval($actions[1]));
				}
				if($actions[0]=='users'){
					$controller='_User';
					$request->setParam('user_id', intval($actions[1]));
				}
				$action = 'edit';
				break;
			case 1:
				if($actions[0]=='profiles'){
					$controller='_Profile';
					$action='index';
				}else if($actions[0]=='users'){
					$controller='_User';
					$action='index';
				}
				break;
			default:
				$action='index';
		}
		return $router->getRouteMatch('autocraft_ControllerAdmin_Game'.$controller, $action, 'autocraft');
		 
	}

	/**
	 * Method to build a link to the specified page/action with the provided
	 * data and params.
	 *
	 * @see XenForo_Route_BuilderInterface
	 */
	public function buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, array &$extraParams)
	{
		        $components = explode('/', $action);
        $subPrefix = strtolower(array_shift($components));

        $intParams = '';
        $strParams = '';
        $title = '';
        $slice = false;

        switch ($subPrefix)
        {
            case 'comment':        
				$intParams = 'comment_id';
				$slice = true;
				break;
            case 'playlist':    
				$intParams = 'playlist_id';
				$title = 'playlist_name';
				$slice = true;
				break;
            case 'category':
				$intParams = 'category_id';
				$title = 'category_name';
				$slice = true;
				break;
            case 'user':
				$intParams = 'user_id';
				$title = 'username';
				$slice = true;
				break;
            case 'keyword':
				$strParams = 'keyword_text';
				$slice = true;
				break;
            case 'service':
				$strParams = 'service_slug';
				$slice = true;
				break;
            default:
				$intParams = 'media_id';
				$title = 'media_title';
        }

        if ($slice)
        {
            $outputPrefix .= '/'.$subPrefix;
            $action = implode('/', $components);
        }

        $action = XenForo_Link::getPageNumberAsAction($action, $extraParams);

        if ($strParams)
        {
            return XenForo_Link::buildBasicLinkWithStringParam($outputPrefix, $action, $extension, $data, $strParams);
        }
        else
        {
            return XenForo_Link::buildBasicLinkWithIntegerParam($outputPrefix, $action, $extension, $data, $intParams, $title);
        }

	}
	
	
} 
?>