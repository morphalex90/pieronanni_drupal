jQuery('document').ready(function() {
    initialize_timelines();
    
    setTimeout(function(){ 
        jQuery('.timeline:first-child').trigger('click');
     }, 500);
    
});

jQuery(window).on('resize', function(){
    initialize_timelines();
});

function initialize_timelines(){
    var timeline = jQuery('.timelines');

    var x = document.getElementsByClassName("timeline"); // get all the current timelines
    for (let e of x) { e.removeEventListener('click', handler); } // remove the click event
    
    timeline.html(''); // empty the timeline block

    var timelines_width = timeline.width();

    var timeline_years = '';
    var timeline_start_year = 2011;
    var timeline_current_year = new Date().getFullYear();

    var year_width = timelines_width / (timeline_current_year - timeline_start_year + 1);
    
    for( i=timeline_start_year; i<=timeline_current_year; i++ ) {
        timeline_years = timeline_years + '<div class="timeline-year" style="width: '+year_width+'px">'+i+'</div>';
    }

    jQuery('.timeline-support').each(function() {
        var company = jQuery(this).data('company');
        var start_date = jQuery(this).data('start');
        var end_date = jQuery(this).data('end');
        var timeline_id = jQuery(this).data('timelineid');

        start_date = start_date.substring(0, 4); // convert to full year
        end_date = end_date.substring(0, 4);


        if( end_date == '' ) { // no finish year
            end_date = timeline_current_year; // save the current year
        }

        var start_line = (start_date-timeline_start_year)*year_width;
        var finish_line = (end_date-start_date+1)*year_width;

        timeline.append('<div class="timeline" data-tid="'+timeline_id+'" style="margin-left:'+start_line+'px; width: '+finish_line+'px">'+company+'</div>');
    });

    timeline.append('<div class="timeline-years">'+timeline_years+'</div>'); // add all the years at the bottom

    var x = document.getElementsByClassName("timeline"); // get all the current timelines
    for (let e of x) { e.addEventListener('click', handler); } // add the click event
};

var handler = function click_timeline() {

    if( jQuery(this).hasClass('active') ) {
        jQuery(this).removeClass('active');
    } else {
        jQuery('.timeline.active').removeClass('active');
        jQuery(this).addClass('active');
    }

    var tid = jQuery(this).data('tid');
    if( !jQuery('.job-wrapper[data-jobid="'+tid+'"]').hasClass('active') ) {
        jQuery('.job-wrapper.active').slideUp().removeClass('active');
        jQuery('.job-wrapper[data-jobid="'+tid+'"]').addClass('active').slideToggle();
    } else {
        jQuery('.job-wrapper[data-jobid="'+tid+'"]').slideUp().removeClass('active');
    }
}