var EventCreatePageJs = (function($)
{
	var init = function(params)
    {
        $('#event-event_date').datetimepicker({
        	format: 'L',
        	format: 'DD.MM.YYYY',
		    extraFormats: [ 'DD.MM.YYYY', 'DD.MM.YY' ]
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
