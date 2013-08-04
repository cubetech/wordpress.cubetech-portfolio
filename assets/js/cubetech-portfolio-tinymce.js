tinymce.create( 
	'tinymce.plugins.cubetech_portfolio', 
	{
	    /**
	     * @param tinymce.Editor editor
	     * @param string url
	     */
	    init : function( editor, url ) {
			/**
			*  register a new button
			*/
			editor.addButton(
				'cubetech_portfolio_button', 
				{
					cmd   : 'cubetech_portfolio_button_cmd',
					title : editor.getLang( 'cubetech_portfolio.buttonTitle', 'cubetech Blöcke' ),
					image : url + '/../img/toolbar-icon.png'
				}
			);
			/**
			* and a new command
			*/
			editor.addCommand(
				'cubetech_portfolio_button_cmd',
				function() {
					/**
					* @param Object Popup settings
					* @param Object Arguments to pass to the Popup
					*/
					editor.windowManager.open(
						{
							// this is the ID of the popups parent element
							id       : 'cubetech_portfolio_dialog',
							width    : 480,
							title    : editor.getLang( 'cubetech_portfolio.popupTitle', 'cubetech Blöcke' ),
							height   : 'auto',
							wpDialog : true,
							display  : 'block',
						},
						{
							plugin_url : url
						}
					);
				}
			);
		}
	}
);

// register plugin
tinymce.PluginManager.add( 'cubetech_portfolio', tinymce.plugins.cubetech_portfolio );