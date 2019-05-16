const hook = wp.hooks.createHooks()
const POST_LOCK = "CCTD_Lock";
let triggered = false;
let hasBeenOpened = false;
const TIMEOUT = 3000;
let isLocked = false;
const FEATURED_NOTICE_ID = 'featured_notice';


//https://riad.blog/2018/06/07/efficient-client-data-management-for-wordpress-plugins/

//https://github.com/WordPress/gutenberg/issues/4674#issuecomment-404587928

//https://wordpress.stackexchange.com/questions/319054/trigger-javascript-on-gutenberg-block-editor-save
wp.data.subscribe(function () {
    var isSavingPost = wp.data.select('core/editor').isSavingPost();
    var isAutosavingPost = wp.data.select('core/editor').isAutosavingPost();
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

    if (isPublishable && !triggered) {
        triggered = true;
        //hasBeenOpened = false;
        checkFeaturedmediaAndShow();
        setInterval(() => {
            triggered = false;
        }, TIMEOUT);
    }

    if (isSavingPost && !isAutosavingPost && !triggered) { // Make sure regular save and only trigger once
        // Here goes your AJAX code ......
        //triggered = true; // makes sure only triggered once
        //checkFeaturedmediaAndShow();
        //wp.data.dispatch('core/editor').lockPostSaving(POST_LOCK);


    }
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

    if (featuredImageId === 0 || featuredImageId === undefined) {
        lock();

    } else {
        unlock();
        removeMessage();
    }

}


/*


const POST_LOCK = "CCTD_Lock";
let isLocked = false;

//https://developer.wordpress.org/block-editor/tutorials/notice
(function (wp) {
    wp.data.dispatch('core/notices').createNotice(
        'success', // Can be one of: success, info, warning, error.
        'Post published.', // Text string to display.
        {
            isDismissible: true, // Whether the user can dismiss the notice.
            // Any actions the user can perform.
            actions: [
                {
                    url: '#',
                    label: 'Du skal vælge et udvalgt billede inden forløbet kan udgives'
                }
            ]
        }
    );
})(window.wp);



const {subscribe} = wp.data.on;

const isPostPublishable = wp.data.select('core/editor').isEditedPostPublishable();

const initialFeaturedImage = wp.data.select('core/editor').getEditedPostAttribute('featured_media');

//https://riad.blog/2018/06/07/efficient-client-data-management-for-wordpress-plugins/

//https://github.com/WordPress/gutenberg/issues/4674#issuecomment-404587928
const unssubscribe = subscribe(() => {
    const contentChanged = wp.data.select('core/editor').hasChangedContent();
    //console.log("grelo" + wp.data.select( 'core/editor' ).ispublishsidebaropened());
    if (true === contentChanged) {
        console.log("FIRE");


        const featuredImageId = wp.data.select('core/editor').getEditedPostAttribute('featured_media');
        console.log(featuredImageId)
        if (featuredImageId !== undefined) { // Featured image exists

            if (featuredImageId === 0) {
                //lock();

            } else {

               // unlock();
            }
        }

        // ...do something here - the post has been published
    }
});


function lock() {
    console.log(isLocked)
    if (!isLocked) {
        wp.data.dispatch('core/editor').lockPostSaving(POST_LOCK);
        isLocked = true;
        console.log("LOCK"); 
    }
}

function unlock() {
    if(isLocked) {
        console.log("UNLOCK");
        wp.data.dispatch( 'core/editor' ).unlockPostSaving(POST_LOCK);
        isLocked = false;
    }
}

*/

// Check Featured
// wp.data.select( 'core/editor' ).getEditedPostAttribute('featured_media')

/*
const initialPostStatus = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'status' );


if ( 'publish' !== initialPostStatus ) {
    // Watch for the publish event.
    const unssubscribe = subscribe( () => {
        const currentPostStatus = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'status' );
        //console.log("grelo" + wp.data.select( 'core/editor' ).ispublishsidebaropened());
        if ( 'publish' === currentPostStatus ) {
            //console.log("THIS IS PUBLISH");


            // ...do something here - the post has been published
        }
    } );
}
wp.hooks.addAction('pre_post_update', 'CCTD_Library/checkpic', () => {

    console.log("IRAN");


});


 */

//wp.data.dispatch( 'core/editor' ).lockPostSaving( 'mylock' );
