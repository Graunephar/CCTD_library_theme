const POST_LOCK = "CCTD_Lock";
let publishableTriggered = false;
let hasBeenOpened = false;
const TIMEOUT = 3000;
let isLocked = false;
const FEATURED_NOTICE_ID = 'featured_notice';
let initalstartuptimepassed = false;
const INITIAL_STARTUP_TIME = 1000;


//https://riad.blog/2018/06/07/efficient-client-data-management-for-wordpress-plugins/

//https://github.com/WordPress/gutenberg/issues/4674#issuecomment-404587928

//https://wordpress.stackexchange.com/questions/319054/trigger-javascript-on-gutenberg-block-editor-save
wp.data.subscribe(function () {
    var isPublishable = wp.data.select('core/editor').isEditedPostPublishable();
    var isPublisSidebarOpened = wp.data.select('core/edit-post').isPublishSidebarOpened();

    if (isPublisSidebarOpened && !hasBeenOpened) {
        hasBeenOpened = true;
        checkFeaturedmediaAndShow();
        toggleMessage();
        setInterval(() => {
            hasBeenOpened = false;
        }, TIMEOUT);

    } // Retrigger

    if ((isPublishable && !publishableTriggered) && initalstartuptimepassed) {
        publishableTriggered = true;
        //hasBeenOpened = false;
        checkFeaturedmediaAndShow();
        setInterval(() => {
            publishableTriggered = false;
        }, TIMEOUT);
    }

    setTimeout(() => {
        initalstartuptimepassed = true;
    }, INITIAL_STARTUP_TIME);
});

function removeMessage() {
    wp.data.dispatch('core/notices').removeNotice(FEATURED_NOTICE_ID);
}


function createMessage() {
    //https://developer.wordpress.org/block-editor/tutorials/notice
    wp.data.dispatch('core/notices').createNotice(
        'warning', // Can be one of: success, info, warning, error.
        'Vælg et udvalgt billede.', // Text string to display.
        {
            isDismissible: false, // Whether the user can dismiss the notice.
            // Any actions the user can perform.
            id: FEATURED_NOTICE_ID,
            actions: [
                {
                    url: 'https://en.support.wordpress.com/featured-images/',
                    label: 'Du skal vælge et udvalgt billede inden forløbet kan udgives',
                }
            ]
        }
    );
}

function toggleMessage() {
    if (isLocked) {

        createMessage();

    } else {
        removeMessage();
    }

}

function lock() {
    if (isLocked === false) {
        wp.data.dispatch('core/editor').lockPostSaving(POST_LOCK);
        isLocked = !isLocked;
    }
}

function unlock() {
    if (isLocked === true) {
        wp.data.dispatch('core/editor').unlockPostSaving(POST_LOCK);
        isLocked = !isLocked;
    }
}

function checkFeaturedmediaAndShow() {
    let featuredImageId = wp.data.select('core/editor').getEditedPostAttribute('featured_media');
    let posttype = wp.data.select('core/editor').getCurrentPostType();

    console.log(featuredImageId);

    if ((featuredImageId === 0 || featuredImageId === undefined) && posttype !== 'page') { // no featured media
        lock();

    } else {
        unlock();
        removeMessage();
    }

}

//Change text on file upload button

$(function () { // on document ready, the recommended way

    //.first().attr('class', 'lolol');
    rename_all_buttons();
    $('.add-clone').click(rename_all_buttons);




});

function rename_all_buttons() {
    setTimeout(() => {
        $('.rwmb-media-add a').text("Upload fil til forløb");
    }, 500);

}