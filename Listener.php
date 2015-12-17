<?php
 
class autocraft_Listener
{
	//Our callback signature! We are using here! Look:
    public static function template_hook ($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template)
    {
                //Swiiitch!
        switch ($hookName) //the hookname
        {
            //first template hook
            case 'member_view_tabs_heading':
                //Get our template!
                $ourTemplate = $template->create('autocraft_GameProfilesTab', $template->getParams());
                //Render
                $rendered = $ourTemplate->render();
                //Put the rendered template in the contents.
                $contents .= $rendered;
                break;
            //second template hook
            case 'member_view_tabs_content':
                //Get our template!
                $ourTemplate = $template->create('autocraft_GameProfiles', $template->getParams());
                //Render
                $rendered = $ourTemplate->render();
                //Put the rendered template in the contents.
                $contents .= $rendered;
                break;
        }
    }
	
	//Our callback signature!
	public static function template_create($templateName, array &$params, XenForo_Template_Abstract $template)
	{
		switch ($templateName) {
			case 'member_view':
				$template->preloadTemplate('autocraft_GameProfilesTab');
				$template->preloadTemplate('autocraft_GameProfiles');
				break;
		}
	}

	
	
}
	
?>