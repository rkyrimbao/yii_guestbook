/* Dependencies
 * js/plugins/typeahead.js
 */
var SearchGuestWidget = (function($)
{
	var settings;

    var init = function(options) {
        settings = $.extend({
            'inputTextSelector': 'input#suggestivesearch',
            'searchSuggestions': null,
            'searchAllUrl': null,
            'searchAllLabel': null
        }, options);

        _bindSuggestiveSearch();
    }

	var _bindSuggestiveSearch = function ()
	{
		$(settings.inputTextSelector)
			.attr('autocomplete', 'off')
			.on('keydown', function (e) {
				if (e.keyCode == 13) {
					e.preventDefault();
					return false;
				}
			})
			.typeahead({
				select: function () {
					console.log('select');
                    var val = this.$menu.find('.active').attr('data-value');

                    this.$element
                        .val(this.updater(val))
                        .change();

                    try {
                        guest = JSON.parse(val);
                    } catch(err) {
                        guest = {
                            'url': settings.searchAllUrl
                        };
                    }


                    window.location.href = guest.url;
                    return this.hide();
                },
                source: function (query, process) {
                	console.log('source');
                    guests = [], map = {};

                    $.each(settings.suggestedGuestConfig.searchSuggestions.suggestions, function (i, guest) {
                        map[guest.url] = guest.name;
                        guests.push(JSON.stringify(guest));
                    });
                    process(guests);
                },
                highlighter: function(item) {
                	console.log('highlighter');
                    var guest = JSON.parse(item);

                    var regex = new RegExp( '(' + this.query + ')', 'gi' );
                    var name = guest.name.replace( regex, "<strong>$1</strong>" );

                    return '<span>'+name+'</span>';
                },
                matcher: function (item) {
                	console.log('matcher');
                    guest = JSON.parse(item);
                    return ~guest.name.toLowerCase().indexOf(this.query.toLowerCase())
                },
                nomatch: function() {
                	console.log('nomatch');
                    var guest = {
                        'url': settings.searchAllUrl
                    };
                    var that = this;

                    var searchAllLabel = settings.searchAllLabel;
                    if (searchAllLabel == null) {
                        searchAllLabel = 'No match found. Go to <b>Search Page</b> instead.';
                    }

                    var menuWidth = $(settings.inputTextSelector).css('width');

                    var items = new Array();
                    items.push(JSON.stringify(guest));
                    items = $(items).map(function (i, item) {
                        i = $(that.options.item).attr('data-value', item).css('width', menuWidth);
                        i.find('a').html(searchAllLabel);

                        return i[0];
                    });

                    this.$menu.html(items);
                    this.show();
                    return this;
                },
                updater: function(item) {
                	console.log('updater');
                    try {
                        guest = JSON.parse(item);
                    } catch(err) {
                        guest = {
                            'url': settings.searchAllUrl
                        };
                    }

                    this.$element.val(guest.name);
                    return guest.name;
                },
                render: function (items) {
                	console.log('render');
                    var that = this;
                    var menuWidth = $(settings.inputTextSelector).css('width');

                    items = $(items).map(function (i, item) {
                        i = $(that.options.item).attr('data-value', item).css('width', menuWidth);
                        i.find('a').html(that.highlighter(item));
                        return i[0];
                    });

                    var first = items.first();
                    var firstResult = first.data('value');

                    first.addClass('active');

                    this.$menu.html(items);
                    this.$menu.css('width', menuWidth);
                    return this;
                }
			});
	}

	return { init: init }

})(jQuery);