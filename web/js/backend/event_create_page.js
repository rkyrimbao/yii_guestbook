var EventCreatePageJs = (function($)
{
	var init = function(params)
    {
        $('#event-event_date').datetimepicker({
            default: 'YYYY-MM-DD',
        	format: 'L',
        	format: 'YYYY-MM-DD',
        });

        $('#event-time').datetimepicker({
        	format: 'LT'
        });
    }

    return {
    	init: init
	}
})(jQuery);

EventCreatePageJs.init();
