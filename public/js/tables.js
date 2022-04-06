
/*$(function() {

    // NOTE: $.tablesorter.themes.bootstrap is ALREADY INCLUDED in the jquery.tablesorter.widgets.js
    // file; it is included here to show how you can modify the default classes
    $.tablesorter.themes.bootstrap = {
      // these classes are added to the table. To see other table classes available,
      // look here: http://getbootstrap.com/css/#tables
      table        : 'table table-bordered',
      caption      : 'caption',
      // header class names
      header       : 'bootstrap-header', // give the header a gradient background (theme.bootstrap_2.css)
      sortNone     : '',
      sortAsc      : '',
      sortDesc     : '',
      active       : '', // applied when column is sorted
      hover        : '', // custom css required - a defined bootstrap style may not override other classes
      // icon class names
      icons        : '', // add "bootstrap-icon-white" to make them white; this icon class is added to the <i> in the header
      iconSortNone : 'bootstrap-icon-unsorted', // class name added to icon when column is not sorted
      iconSortAsc  : 'glyphicon glyphicon-chevron-up', // class name added to icon when column has ascending sort
      iconSortDesc : 'glyphicon glyphicon-chevron-down', // class name added to icon when column has descending sort
      filterRow    : '', // filter row class; use widgetOptions.filter_cssFilter for the input/select element
      footerRow    : '',
      footerCells  : '',
      even         : '', // even row zebra striping
      odd          : ''  // odd row zebra striping
    };
  
    // call the tablesorter plugin and apply the uitheme widget
    $("table").tablesorter({
      // this will apply the bootstrap theme if "uitheme" widget is included
      // the widgetOptions.uitheme is no longer required to be set
      theme : "bootstrap",
  
      widthFixed: true,
  
      headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!
  
      // widget code contained in the jquery.tablesorter.widgets.js file
      // use the zebra stripe widget if you plan on hiding any rows (filter widget)
      widgets : [ "uitheme", "filter", "columns", "zebra" ],
  
      widgetOptions : {
        // using the default zebra striping class name, so it actually isn't included in the theme variable above
        // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
        zebra : ["even", "odd"],
  
        // class names added to columns when sorted
        columns: [ "primary", "secondary", "tertiary" ],
  
        // reset filters button
        filter_reset : ".reset",
  
        // extra css class name (string or array) added to the filter element (input or select)
        filter_cssFilter: "form-control",
  
        // set the uitheme widget to use the bootstrap theme class names
        // this is no longer required, if theme is set
        uitheme : "bootstrap"
  
      }
    })
    .tablesorterPager({
  
      // target the pager markup - see the HTML block below
      container: $(".ts-pager"),
  
      // target the pager page select dropdown - choose a page
      cssGoto  : ".pagenum",
  
      // remove rows from the table to speed up the sort of large tables.
      // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
      removeRows: false,
  
      // output string - default is '{page}/{totalPages}';
      // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
      output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'
  
    });

});*/

$(function() {

  // Extend the themes to change any of the default class names
  $.extend($.tablesorter.themes.jui, {
    // change default jQuery uitheme icons - find the full list of icons at
    // http://jqueryui.com/themeroller/ (hover over them for their name)
    table        : 'ui-widget ui-widget-content ui-corner-all', // table classes
    caption      : 'ui-widget-content',
    // header class names
    header       : 'ui-widget-header ui-corner-all ui-state-default', // header classes
    sortNone     : '',
    sortAsc      : '',
    sortDesc     : '',
    active       : 'ui-state-active', // applied when column is sorted
    hover        : 'ui-state-hover',  // hover class
    // icon class names
    icons        : 'ui-icon', // icon class added to the <i> in the header
    iconSortNone : 'ui-icon-carat-2-n-s ui-icon-caret-2-n-s', // class name added to icon when column is not sorted
    iconSortAsc  : 'ui-icon-carat-1-n ui-icon-caret-1-n', // class name added to icon when column has ascending sort
    iconSortDesc : 'ui-icon-carat-1-s ui-icon-caret-1-s', // class name added to icon when column has descending sort
    filterRow    : '',
    footerRow    : '',
    footerCells  : '',
    even         : 'ui-widget-content', // even row zebra striping
    odd          : 'ui-state-default'   // odd row zebra striping
  });

  
  $("table").tablesorter({

    theme : 'jui',

    headerTemplate : '{content} {icon}',


    widgets : ['uitheme', 'filter', 'zebra'],

    widgetOptions : {
 
      zebra   : ["even", "odd"],

    }

  });

});