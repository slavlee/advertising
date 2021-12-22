/**
 * Advertisement Delivered Tracker jQuery Plugin
 * @project advertisement TYPO3 Extension
 * @author Kevin Chileong Lee
 */
// Create closure.
(function( $ ) {

    $.fn.advertisement_delivered_tracker = function( options ) {
        
    	return $(this).each(function(){
    		if (typeof $.fn.advertisement_delivered_tracker.defaultsCustom == "undefined")
			{
    			this.opts = $.extend( {}, $.fn.advertisement_delivered_tracker.defaults, options );
			}else
			{
				this.opts = $.extend( {}, $.fn.advertisement_delivered_tracker.defaults, options, $.fn.advertisement_delivered_tracker.defaultsCustom );
			}
    		
    		console.debug($.fn.advertisement_delivered_tracker.defaultsCustom);
    		
    		// Skip if we dont have an endpoint
    		if (this.opts.endpoint == "")
			{
    			return this;
			}
    		
    		// Call endpoint
    		$.get(getEndpoint(this)).always((response) => {
    			if(response.state == "error")
				{
    				console.error(response);
				}
    		});
        });
    };
    
    /**
     * Create the endpoint url part except the domain itself
     * @param jQuery link
     * @return string
     */
    function getEndpoint(link)
    {
    	return "?" + link.opts.endpoint.replace("###BANNER###", $(link).attr("data-ad-banner")).replace("###TYPE###", $(link).attr("data-ad-typeNum-delivered"));
    }
    
    $.fn.advertisement_delivered_tracker.defaults = {
		endpoint: "tx_advertisement_deliveredtracking%5Bbanner%5D=###BANNER###&type=###TYPE###",
    	classes: {},
    	selectors: {
    		ads: ".link-advertisement"
    	}
    };
 
    
    //Autostart Plugin
    $(document).ready(function(){
    	$($.fn.advertisement_delivered_tracker.defaults.selectors.ads).advertisement_delivered_tracker();
    });
})( jQuery );